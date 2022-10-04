<?php

namespace App\Http\Controllers;

use App\Models\A2zDatabase;
use App\Models\A2ZSubject;
use App\Models\A2ZType;
use App\Models\A2zVendor;
use App\Models\Author;
use App\Models\Category;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemView;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;
use Session;

class FrontEndController extends Controller
{
    protected $items, $databases;

    public function __construct(Item $item, A2zDatabase $database)
    {
        $this->middleware('auth');
        $this->items = $item;
        $this->databases = $database;
    }

    public function index($id = null)
    {
        switch ($id) {
            case "author":
                $page = "frontend.authors";
                break;
            case "service":
                $page = "frontend.services";
                break;
            case "year":
                $page = "frontend.year";
                break;
            case "category":
                $page = "frontend.department";
                break;

            //static page
            case "about-us":
                $page = "frontend.about-us";
                break;
            case "privacy-policy":
                $page = "frontend.privacy-policy";
                break;
            case "terms-of-use":
                $page = "frontend.terms-of-use";
                break;
            case "contact-us":
                $page = "frontend.contact-us";
                break;
            default:
                $page = "frontend.home";

        }
        return view($page);
    }

    /*
        public function departments()
        {
            $departments = Department::where('status', 1)->get();
            return view('frontend.department', compact('departments'));
        }

        public function services()
        {
            $services = Category::where('isVisible', 1)->get();
            return view('frontend.services', compact('services'));
        }

        public function authors()
        {
            return view('frontend.authors');
        }

    */
    public function serviceItem(Request $request, $id)
    {
        $category = Category::where('itemCategoryShort', $id)->first();
        if ($category->accessibilityWithoutAuthentication == 0) {
            if (!Auth::check()) {
                return redirect('login');
            }
        }
        if ($request->ajax()) {
            $items = $this->items->latest('created_at')->paginate(20);
            return view('frontend.getItem', compact('items'));
        } else {
            $items = Item::where('category_id', $category->id)->latest('created_at')->paginate(20);
            return view('frontend.search-item', compact('items'));
        }
    }

    public function yearItem(Request $request, $id)
    {
        $items = Item::where('publicationYear', $id)->paginate(20);
        if ($request->ajax()) {
            $items = $this->items->latest('created_at')->paginate(20);
            return view('frontend.getItem', compact('items'));
        } else {
            return view('frontend.search-item', compact('items'));
        }
    }

    public function departmentItem(Request $request, $id)
    {
        $items = Department::where('deptShortName', $id)->first();
        $items = $items->item()->paginate(20);
        if ($request->ajax()) {
            $items = $this->items->latest('created_at')
                ->whereHas('department', function($q) use($id){
                    $q->where('deptShortName', $id );
                })
                ->paginate(20);
            return view('frontend.getItem', compact('items'));
        } else {
            return view('frontend.dept-search-item', compact('items'));
        }
    }

    public function searchDepartment(Request $request){

                $items = Department::where('deptShortName', $request['dept_name'])->first();
                $id = $items->id;
                if ($request['q']) {
                    $q = $request['q'];
                    $items = $this->items->latest('created_at')
                        ->where('title', 'like', '%' . $request['q'] . '%')
                        ->whereHas('department', function($q) use($request){
                            $q->where('deptShortName', $request['dept_name'] );
                        })
                        ->paginate(300)->setPath('');
                    return view('frontend.getItem', compact('items','q'));
                }else{
                    $items = $this->items->latest('created_at')
                        ->whereHas('department', function($q) use($request){
                            $q->where('deptShortName', $request['dept_name'] );
                        })
                        ->paginate(20);
                    return view('frontend.getItem', compact('items'));
                }

    }






    public function authorItem(Request $request, $id)
    {
        $items = Author::where('slug', $id)->first();
        $items = $items->item()->paginate(20);
        if ($request->ajax()) {
            $items = $this->items->latest('created_at')->paginate(20);
            return view('frontend.getItem', compact('items'));
        } else {
            return view('frontend.search-item', compact('items'));
        }
    }

    public function feedbackNew()
    {
        return view('frontend.new_issue');
    }


    public function getDetails($segment1, $segment2, $title)
    {
        $item = Item::with('category')->where('slug', $title)->first();
        if ($item->category()->get()[0]->accessibilityWithoutAuthentication == 0) {
            if (!Auth::check()) {
                return redirect('login');
            }
        }
        $data['item_id'] = $item->id;
        ItemView::create($data);
        $dataa = ItemView::where('item_id', $item->id)->get();
        $years = array();
        foreach ($dataa as $year) {
            array_push($years, date_create($year->created_at)->format('Y'));
        }
        $years = array_count_values($years);
        krsort($years);
        return view('frontend.item-details', compact('item', 'years'));
    }




    public function search(Request $request)
    {
        $q = $request['q'];
        if ($request['q']) {
            //$started = microtime(true);
            $data = $request['q'];
            $items = Item::Where('title', 'like', '%' . $request['q'] . '%')
                ->orWhere('edition', 'like', '%' . $request['q'] . '%')
                ->orWhere('itemStandardNumberValue', 'like', '%' . $request['q'] . '%')
                ->orWhere('keywords', 'like', '%' . $request['q'] . '%')
                ->orWhere('summary', 'like', '%' . $request['q'] . '%')
                ->orWhere('publicationYear', 'like', '%' . $request['q'] . '%')
                ->orWhere('placeOfPublication', 'like', '%' . $request['q'] . '%')
                ->orWhereHas('publisher', function ($q) use ($data) {
                    $q->where('publisherName', 'like', '%' . $data . '%');
                })
                ->orWhereHas('category', function ($q) use ($data) {
                    $q->where('itemCategory', 'like', '%' . $data . '%');
                })
                ->orWhereHas('itemStandardNumber', function ($q) use ($data) {
                    $q->where('itemStandardName', 'like', '%' . $data . '%');
                })
                ->orWhereHas('author', function ($q) use ($data) {
                    $q->where('authorName', 'like', '%' . $data . '%');
                })
                ->paginate(20)->setPath('');
            //$end = microtime(true);
            //$difference = $end - $started;
            //$queryTime = number_format($difference, 10);
            $pagination = $items->appends(array(
                'q' => $request['q']
            ));
            if ($request['home'] == "ok") {
                return view('frontend.search-item', compact('items', 'q'));
            } else {
                return view('frontend.getItem', compact('items', 'q'));
            }
            //return Response::json(view( compact('items')));
        } else {
            if ($request->ajax()) {
                $items = $this->items->latest('created_at')->paginate(20);
                return view('frontend.getItem', compact('items', 'q'));
            } else {
                $items = $this->items->latest('created_at')->paginate(20);
                //$items = Item::all();
                //return Response::json(view('frontend.getItem', compact('items')));
                return view('frontend.search-item', compact('items', 'q'));
            }
        }
    }

    public function a2zDatabase2(Request $request)
    {
        if ($request->ajax()) {
            $a2z_types = A2zType::withCount('a2zDatabase')->where('a2z_type_id', 2)->orderBy('a2z_database_count', 'desc')->get();

            return view('frontend.a2zGetItem', compact('a2z_types'));
        } else {
            $a2z_subjects = A2ZSubject::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $a2z_types = A2zType::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $a2z_vendors = A2zVendor::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $databases = A2zDatabase::latest('created_at')->paginate(20);
            return view('frontend.a2z', compact('a2z_subjects', 'a2z_types', 'a2z_vendors', 'databases'));
        }
    }

    public function a2zDatabase(Request $request)
    {

        $q = $request['q'];
        if ($request['q']) {
            $databases = $this->databases->latest('created_at')->where('a2zTitle', 'like', $request['q'] . '%')->paginate(10)->setPath('');
            $pagination = $databases->appends(array(
                'q' => $request['q']
            ));
            if ($request['home'] == "ok") {
                return view('frontend.a2z', compact('databases', 'q'));
            } else {
                return view('frontend.a2zGetItem', compact('databases', 'q'));
            }
        } else {
            //$databases = $this->databases->latest('created_at')->paginate(20);
            $databases = A2zDatabase::with('a2zSubject')->paginate(20);
            if ($request->ajax()) {
                return view('frontend.a2zGetItem', ['databases' => $databases])->render();
            }
            return view('frontend.a2z', compact('databases'));

        }
    }

    public function a2zSearch(Request $request)
    {
        if ($request->ajax()) {
            $subject_id = $request->input('subject_id');
            $type_id = $request->input('type_id');
            $vendor_id = $request->input('vendor_id');
//return $subject_id.",".$type_id.",".$vendor_id;

            $a2z_subjects = A2ZSubject::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $a2z_types = A2zType::withCount('a2zDatabase')
                ->orderBy('a2z_database_count', 'desc')->get();
            $a2z_vendors = A2zVendor::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();

            $databases = A2zDatabase::latest('created_at')
                ->where('a2z_type_id', $type_id)
                ->where('a2z_vendor_id', $vendor_id)
                ->paginate(20);

            return view('frontend.a2zGetItem', compact('a2z_subjects', 'a2z_types', 'a2z_vendors', 'databases'));
        } else {
            $a2z_subjects = A2ZSubject::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $a2z_types = A2zType::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $a2z_vendors = A2zVendor::withCount('a2zDatabase')->orderBy('a2z_database_count', 'desc')->get();
            $databases = A2zDatabase::latest('created_at')->paginate(20);
            return view('frontend.a2z', compact('a2z_subjects', 'a2z_types', 'a2z_vendors', 'databases'));
        }
    }
}

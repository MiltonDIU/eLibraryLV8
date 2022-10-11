<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemSemesterSupervisor;
use App\Models\ItemStandardNumber;
use App\Models\Publisher;
use App\Models\Semester;
use App\Models\Supervisor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use File;
use Str;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    protected $items;

    public function __construct(Item $item)
    {
        $this->items = $item;
    }

    public function index(Request $request)
    {

        $data2 = array();
        $data3 = array();

        DB::enableQueryLog();
        DB::connection()->enableQueryLog();
        if ($request['q']) {

            $data = $request['q'];
            $items = Item::where('title', 'like', '%' . $data . '%')
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
                ->orWhereHas('user', function ($q) use ($data) {
                    $q->where('email', 'like', '%' . $data . '%');
                })
                ->orWhereHas('user', function ($q) use ($data) {
                    $q->where('diu_id', 'like', '%' . $data . '%');
                })
                ->orWhere('itemStandardNumberValue','like', '%' . $data . '%')
                ->paginate(20)->setPath('');

            $query = DB::getQueryLog();
            $query = end($query);
            $queryTime = $query['time'];
            $pagination = $items->appends(array(
                'q' => $request['q']
            ));
            $queryTime = $queryTime / 1000;


            if ($request['show']==1){
                $data2['show']='show';
            }
            if ($request['destroy']==1){
                $data2['destroy']='destroy';
            }
            if ($request['edit']==1){
                $data2['edit']='edit';
            }
            $data3['slug']=$request['slug'];
            Session::flash('controller', $data3);
            Session::flash('viewIndex', $data2);


            return view('admin.item.getItem', compact('items', 'queryTime'));
        } else {
            if ($request->ajax()) {
                $items = $this->items->latest('created_at')->paginate(20);
                $query = DB::getQueryLog();
                $query = end($query);
                $queryTime = $query['time'];
                $queryTime = $queryTime / 1000;
                if ($request['show']==1){
                    $data2['show']='show';
                }
                if ($request['destroy']==1){
                    $data2['destroy']='destroy';
                }
                if ($request['edit']==1){
                    $data2['edit']='edit';
                }
                $data3['slug']=$request['slug'];
                Session::flash('controller', $data3);
                Session::flash('viewIndex', $data2);

                return view('admin.item.getItem', compact('items', 'queryTime'));
            } else {
                $items = $this->items->latest('created_at')->paginate(20);
                $query = DB::getQueryLog();
                $query = end($query);
                $queryTime = $query['time'];
                $queryTime = $queryTime / 1000;
                // print_r($queryTime);
                return view('admin.item.index', compact('items', 'queryTime'));
            }
        }
    }


    public function itemStandardValueCheck(Request $request){
        if ($request['q']) {
            $data = $request['q'];
            $items = Item::where('itemStandardNumberValue',$data)->first();
            return $items;
        }

    }



    public function getItemSearch(Request $request)
    {
        if ($request['search']) {
            $items = Item::with('publisher', 'serviceCategory')
                ->where('title', 'like', '%' . $request['search'] . '%')
                ->orWhere('publisher.publisherName', 'like', '%' . $request['search'] . '%')
                ->paginate(5, ['*'], 'page');;
            $result = view('admin.item.getItem', compact('items'));
            return $result;
        }
    }

    public function data($search)
    {
        $items = Item::where('title', $search)
            ->orWhere('summary', $search)
            ->orWhere('keyword', $search)
            ->paginate(10);
        return $items;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $publishers = Publisher::pluck('publisherName','id');
        $itemCategories = Category::pluck('itemCategory', 'id');
        $itemStandardNumbers = ItemStandardNumber::pluck('itemStandardName','id');
        $authors = Author::all()->pluck('authorName','id')->take(10);
        $departments = Department::pluck('departmentName','id');
        $semesters = Semester::pluck('name','id');
        $supervisors = Supervisor::pluck('name','id');

        return view('admin.item.create', compact('supervisors','semesters','publishers', 'itemCategories', 'itemStandardNumbers', 'authors', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ItemRequest $request)
    {
        $requestData = $request->all();
        $requestData['ip_address'] = $request->ip();
        $publisher = $request->input('publisher_id');
        $pubData = array();
        $publisherSearch = Publisher::find($publisher);
        if ($publisherSearch === null) {
            $pubData['publisherName'] = $publisher;
            $publisher = Publisher::create($pubData);
            $requestData['publisher_id'] = $publisher->id;
        } else {
            $requestData['publisher_id'] = $publisherSearch->id;
        }

        if ($request->hasFile('pdfUrl')) {
//            $uploadPath = public_path('/uploads/item');
            $data = $this->makeFolder('/uploads/item_pdf');
            $extension = $request->file('pdfUrl')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('pdfUrl')->move($data['uploadPath'], $fileName);
            $requestData['pdfUrl'] = $fileName;
            $requestData['pdfFullUrl'] = $data['dbPath'].'/'.$fileName;
        }
        if ($request->hasFile('uploadImageUrl')) {
//            $uploadPath = public_path('/uploads/item/covers');
            $data = $this->makeFolder('/uploads/item_images');
            $extension = $request->file('uploadImageUrl')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('uploadImageUrl')->move($data['uploadPath'], $fileName);
            $requestData['uploadImageUrl'] = $fileName;
            $requestData['coverImageFullUrl'] = $data['dbPath'].'/'.$fileName;

        }
        $requestData['user_id'] = Auth::id();
        $requestData['slug'] = Str::slug($requestData['title'], '-');

        if ($requestData['slug'] == Item::where('slug', $requestData['slug'])->pluck('slug')->first()) {
            $requestData['slug'] = $requestData['slug'] . '-' . date('diHs');
        }

        $items = Item::create($requestData);

        if ($request->category_id==7){
            $data['supervisor_id']=$request->supervisor_id;
            $data['semester_id']=$request->semester_id;
            $data['item_id']=$items->id;
            ItemSemesterSupervisor::create($data);
        }
        $author_ids = $request->input('authors_ids');

        $newAuthor = array();
        $authorData = array();
        foreach ($author_ids as $author) {
            $authorSearch = Author::find($author);
            if ($authorSearch === null) {
                $authorData['authorName'] = $author;
                $authorData['slug'] =  Str::slug($author, '-');
                $author_id = Author::create($authorData);
                $newAuthor[] = $author_id->id;
            } else {
                $newAuthor[] = $authorSearch->id;
            }
        }

        $department_ids = $request->input('departments_ids');
        $items->author()->attach($newAuthor);
        $items->department()->attach($department_ids);
        $title = $request->input('title');
        $notification = array(
            'message' => "$title   successfully Uploaded!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/item');





        /*
         $requestData = $request->all();

         if ($request->hasFile('pdfUrl')) {
             $uploadPath = public_path('/uploads/item');
             $extension = $request->file('pdfUrl')->getClientOriginalExtension();
             $fileName = rand(1111111, 9999999) . '.' . $extension;
             $request->file('pdfUrl')->move($uploadPath, $fileName);
             $requestData['pdfUrl'] = $fileName;
         }

         $item= Item::create($requestData);


         $author = $request->input('authors');

         $item->author->attach($author);



         return redirect('admin/item')->with('flash_message', 'Item added!');

        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('admin.item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Item $item, Request $request)
    {
        $publishers = Publisher::pluck('publisherName','id');
        $itemCategories = Category::pluck('itemCategory', 'id');
        $itemStandardNumbers = ItemStandardNumber::pluck('itemStandardName','id');
        // $authors = Author::pluck('authorName','id')->take(50);
        $departments = Department::pluck('departmentName','id');
        $selected_author = $item->author()->pluck('author_id')->toArray();
        $authors = $item->author()->pluck('authorName','author_id');
        // $authors = (object)array_merge((array)$authors,(array)$selected_author2);

        $selected_department = $item->department()->pluck('department_id')->toArray();
        $semesters = Semester::pluck('name','id');
        $supervisors = Supervisor::pluck('name','id');
        return view('admin.item.edit', compact('supervisors','semesters','selected_author', 'selected_department', 'item', 'publishers', 'itemCategories', 'itemStandardNumbers', 'authors', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ItemRequest $request, $id)
    {
        $requestData = $request->all();
        $publisher = $request->input('publisher_id');
        $pubData = array();
        $publisherSearch = Publisher::find($publisher);
        if ($publisherSearch === null) {
            $pubData['publisherName'] = $publisher;
            $publisher = Publisher::create($pubData);
            $requestData['publisher_id'] = $publisher->id;
        } else {
            $requestData['publisher_id'] = $publisherSearch->id;
        }
        $item = Item::findOrFail($id);
        if ($request->hasFile('pdfUrl')) {
//            $uploadPath = public_path('/uploads/item');
            $data = $this->makeFolder('uploads/item_pdf');
            $extension = $request->file('pdfUrl')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('pdfUrl')->move($data['uploadPath'], $fileName);
            $requestData['pdfUrl'] = $fileName;
            $requestData['pdfFullUrl'] = $data['dbPath'].'/'.$fileName;
            if ($item->pdfFullUrl != null) {
                $existingPath = $item->pdfFullUrl;
                if (file_exists( $existingPath)){
                    unlink(public_path($existingPath));
                }
            }

        }

        if ($request->hasFile('uploadImageUrl')) {
//            $uploadPath = public_path('/uploads/item/covers');
            $data = $this->makeFolder('uploads/item_images');

            $extension = $request->file('uploadImageUrl')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('uploadImageUrl')->move($data['uploadPath'], $fileName);
            $requestData['uploadImageUrl'] = $fileName;
            $requestData['coverImageFullUrl'] = $data['dbPath'].'/'.$fileName;
            if ($item->coverImageFullUrl != null or $item->coverImageFullUrl != null) {
                $existingPath = $item->coverImageFullUrl;
                if (file_exists( $existingPath)){
                    unlink($existingPath);
                }
            }
        }
        // $requestData['user_id'] = Auth::id();
        $item->update($requestData);
        if ($request->category_id==7){
            $itemSearch = ItemSemesterSupervisor::where('item_id',$id)->first();
            if ($itemSearch!=null){
                $itemSemesterSupervisor = ItemSemesterSupervisor::findOrFail($itemSearch->id);
                $data['supervisor_id']=$request->supervisor_id;
                $data['semester_id']=$request->semester_id;
                $data['item_id']=$id;
                $itemSemesterSupervisor->update($data);
                //ItemSemesterSupervisor::create($data);
            }
        }
        $author_ids = $request->input('authors_ids');
        $newAuthor = array();
        $authorData = array();
        foreach ($author_ids as $author) {
            $authorSearch = Author::find($author);
            if ($authorSearch === null) {
                $authorData['authorName'] = $author;
                $authorData['slug'] = Str::slug($author, '-');
                $author_id = Author::create($authorData);
                $newAuthor[] = $author_id->id;
            } else {
                $newAuthor[] = $authorSearch->id;
            }
        }

        $department_ids = $request->input('departments_ids');
        $item->author()->sync($newAuthor);
        $item->department()->sync($department_ids);
        $title = $request->input('title');
        $notification = array(
            'message' => "$title   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Item::destroy($id);
        $notification = array(
            'message' => "Department successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/item');
    }


    public function select2(){
        return view('admin.item.select2');
    }

    /*
    AJAX request
    */
    public function getAuthors(Request $request){

        $search = $request->search;

        if($search == ''){
            $employees = Author::orderby('authorName','asc')->select('id','authorName')->limit(50)->get();
        }else{
            $employees = Author::orderby('authorName','asc')->select('id','authorName')->where('authorName', 'like', '%' .$search . '%')->limit(50)->get();
        }
        $response = array();
        foreach($employees as $employee){
            $response[] = array(
                "id"=>$employee->id,
                "text"=>$employee->authorName
            );
        }

        echo json_encode($response);
        exit;
    }

//used single time only make folder and file transfer related methods
    public function coverPath(){
        $items = Item::all();
        $i=$j=0;
        $data=array();
        foreach ($items as $key=>$item){
            if ($item->uploadImageUrl!=null and $item->coverImageFullUrl==null){
                $j++;
                $existing = "uploads/item/covers/".$item->uploadImageUrl;
                $source_file = public_path($existing);
                if (file_exists($source_file)){

                    $data = $this->makeFilePath("uploads/item_images",$item->created_at->year,$item->created_at->month);
                    $destination_path = $data['uploadPath'].'/'.$item->uploadImageUrl;
                    // dd($source_file);
                    if( !copy($source_file, $destination_path) ) {
                        echo "File can't be copied! \n";
                    }
                    else {
                        $i++;
                        //echo "File has been copied! \n";
                        $requestData['coverImageFullUrl']=$data['dbPath'].'/'.$item->uploadImageUrl;
                        $requestData['image_status']='1';
                        $item->update($requestData);
                        unlink($source_file);
                    }
                }
                if ($item->imageUrl==null){
                    array_push($data,$item);
                }

            }
        }
        return view('admin.report.item_image_pdf_not_found',compact('data'));
        //echo $i.'='.$j.", Final total = ".count($items);
    }
    public function filePath(){
        $items = Item::all();
        $i=$j=0;
        $data=array();
        foreach ($items as $key=>$item){
            if ($item->pdfUrl!=null and $item->pdfFullUrl==null){
                $j++;
                $existing = "/uploads/item/".$item->pdfUrl;
                $source_file = public_path($existing);
                if (file_exists($source_file)){
                    $data = $this->makeFilePath("uploads/item_pdf",$item->created_at->year,$item->created_at->month);
                    $destination_path = $data['uploadPath'].'/'.$item->pdfUrl;
                    if( !copy($source_file, $destination_path) ) {
                        echo "File can't be copied! <br>";
                    }
                    else {
                        $i++;
                        //echo "File has been copied! <br>";
                        $requestData['pdfFullUrl']=$data['dbPath'].'/'.$item->pdfUrl;
                        $requestData['pdf_status']='1';
                        $item->update($requestData);
                        unlink($source_file);
                    }
                }
                array_push($data,$item);
            }
        }


        return view('admin.report.item_image_pdf_not_found',compact('data'));
        //echo $i.'='.$j.", Final total = ".count($items);
    }
    //end file and image transfer


// make a file path
    public function makeFilePath($path,$year,$month){
        $year_path = public_path($path.'/'.$year);
        $dbPath = $path.'/'.$year;
        if (File::exists($year_path)) {
            if (File::exists($year_path.'/'.$month)){
                $uploadPath = $year_path.'/'.$month;
                $dbPath = $dbPath.'/'.$month;
            }else{
                $month_path =$year_path.'/'.$month;
                if (!File::makeDirectory($month_path, 0777, true)) {
                    die('Failed to create folders...');
                }
                $uploadPath = $month_path;
                $dbPath = $dbPath.'/'.$month;
            }
        }else{
            if (!File::makeDirectory($year_path, 0777, true)) {
                die('Failed to create folders...');
            }
            $month_path =$year_path.'/'.$month;
            if (!File::makeDirectory($month_path, 0777, true)) {
                die('Failed to create folders...');
            }
            $uploadPath = $month_path;
            $dbPath = $dbPath.'/'.$month;
        }
        $data['uploadPath']=$uploadPath;
        $data['dbPath']=$dbPath;
        return $data;
    }
//end make folder and file related methods

    //create file directory related functionality
    public function makeFolder($path){
        $year_path = public_path($path.'/'.date('Y'));
        $dbPath = $path.'/'.date('Y');
        if (File::exists($year_path)) {
            if (File::exists($year_path.'/'.date('m'))){
                $uploadPath = $year_path.'/'.date('m');
                $dbPath = $dbPath.'/'.date('m');
            }else{
                $month_path =$year_path.'/'.date('m');
                if (!File::makeDirectory($month_path, 0777, true)) {
                    die('Failed to create folders...');
                }
                $uploadPath = $month_path;
                $dbPath = $dbPath.'/'.date('m');
            }
        }else{
            if (!File::makeDirectory($year_path, 0777, true)) {
                die('Failed to create folders...');
            }
            $month_path =$year_path.'/'.date('m');
            if (!File::makeDirectory($month_path, 0777, true)) {
                die('Failed to create folders...');
            }
            $uploadPath = $month_path;
            $dbPath = $dbPath.'/'.date('m');
        }
        $data['uploadPath']=$uploadPath;
        $data['dbPath']=$dbPath;
        return $data;
    }

}

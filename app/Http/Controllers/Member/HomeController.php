<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\IssueTracking;
use App\Models\Item;
use App\Models\ItemUser;
use App\Models\Rating;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;
use Session;

use File;
class HomeController extends Controller
{
    public function __construct()
      {
          $this->middleware('auth');
      }
    public function index()
    {
        return view('member.layouts.member');
    }

    public function profile()
    {
        $id = Auth::id();
        $user = User::find($id);

        $issueTracking = IssueTracking::with('issueTrackingDetail')->where('user_id', $id)->get();
        return view('frontend.profile', compact('user', 'issueTracking'));
    }

    public function singleIndex()
    {
        if (Auth::user()->isAdmin === 1) {
            $issuetracking = IssueTracking::all();
        } else {
            $issuetracking = IssueTracking::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }
        $ratings = Rating::all();
        return view('frontend.issue_tracking', compact('issuetracking', 'ratings'));
    }

    /*
        public function getDetails($segment1, $segment2, $title)
        {
            $item = Item::where('slug', $title)->first();
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
    */

    public function getDownload(Request $request)
    {
        
        $id = $request->input('id');
        $slug = $request->input('slug');
        $item = Item::where('id', $id)->where('slug', $slug)->first();
        $file = public_path() . "/uploads/item/$item->pdfUrl";
        $download = User::withCount('items')->where('id',Auth::id())->first();
if ($download->download > $download->items_count){
    if(file_exists($file)){
        $ext = pathinfo($item->pdfUrl, PATHINFO_EXTENSION);
        $data['item_id'] = $id;
        $data['user_id'] = Auth::id();
        ItemUser::create($data);
        if($download->items_count==0){
            $notification = array(
                'message' => "Welcome to download the book from our system, you can download Maxim  $download->download books from our system.",
                'alert-type' => 'success'
            );
            Session::flash('notification',$notification);
        }else{
            $notification = array(
                'message' => "You can download up to $download->download books, you are already downloaded $download->items_count books",
                'alert-type' => 'success'
            );
            Session::flash('notification',$notification);
        }
        return Response::download($file, "$item->title.$ext");

    }else{
        $notification = array(
            'message' => "Your file has been not created! please contact with library.",
            'alert-type' => 'success'

        );
        Session::flash('notification',$notification);
        return redirect()->back();
    }
}else{
    $notification = array(
        'message' => "You can  over your maximum $download->download books, but if you still want to download please contact the Library Officer's or Submit the request through Feedback",
        'alert-type' => 'success'
    );
    Session::flash('notification',$notification);
    return redirect()->back();
        
        
        //  $id = $request->input('id');
        // $slug = $request->input('slug');
        // $item = Item::where('id', $id)->where('slug', $slug)->first();
        // $file = public_path() . "/uploads/item/$item->pdfUrl";
        // if(file_exists($file)){
        //     $ext = pathinfo($item->pdfUrl, PATHINFO_EXTENSION);
        //     $data['item_id'] = $id;
        //     $data['user_id'] = Auth::id();
        //     ItemUser::create($data);
        //     return Response::download($file, "$item->title.$ext");
        // }else{
        //     $notification = array(
        //         'message' => "Your file has been not created! please contact with library.",
        //         'alert-type' => 'success'
        //     );
        //     Session::flash('notification',$notification);
        //     return redirect()->back();
         }
    }

    public function avatarUpdate(Request $request){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = array();
        if ($request->hasFile('avatar')) {
            $uploadPath = public_path('/uploads/profile/icon');
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('avatar')->move($uploadPath, $fileName);
            $data['imageIcon'] = $fileName;
            if(isset($user->imageIcon)) {
                $path = public_path('uploads/profile/icon/' . $user->imageIcon);
                if (File::exists($path)) {
                    unlink($path);
                }
            }
            $user->imageIcon = $fileName;
            $user->save();

        }
        return redirect()->route('admin.profile')
            ->with('success_message', 'Profile was successfully updated!');
    }

    /*

    public function getDownload(Request $request)
    {
        $id = $request->input('id');
        $slug = $request->input('slug');
        $item = Item::where('id', $id)->where('slug', $slug)->first();
        $file = public_path() . "/uploads/item/$item->pdfUrl";
        $ext = pathinfo($item->pdfUrl, PATHINFO_EXTENSION);
        $data['item_id'] = $id;
        $data['user_id'] = Auth::id();
        ItemUser::create($data);
        return Response::download($file, "$item->title.$ext");
        /*
        $item = Item::where('id', $id)->where('slug', $title)->first();
        $file = public_path() . "/uploads/item/$item->pdfUrl";
        $ext = pathinfo($item->pdfUrl, PATHINFO_EXTENSION);
        $data['item_id'] = $id;
        $data['user_id'] = Auth::id();
//dd($data);
        ItemUser::create($data);
        return Response::download($file, "$item->title.$ext");


        if (!$item==null){
            $file= public_path(). "/uploads/item/$item->pdfUrl";
            $ext = pathinfo($item->pdfUrl, PATHINFO_EXTENSION);
            $data['item_id']=$id;
            $data['user_id']=2;
           ItemUser::create($data);
            return Response::download($file,"$item->title.$ext");
        }{
        $notification = array(
            'message' => "Attached file currently is not available!",
            'alert-type' => 'success' //warning,info,success,error
        );
        Session::flash('notification',$notification);
           return back()->refresh();
    }


    }

    */
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueTrackingRequest;
use App\Models\IssueTracking;
use App\Models\IssueTrackingDetail;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class IssueTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        if (Auth::user()->isAdmin === 1) {
            $issuetracking = IssueTracking::all();
        } else {
            $issuetracking = IssueTracking::where('assignTo', Auth::id())->get();
        }
        $assignTo = DB::table('role_user')
            ->join('users', 'users.id', '=', 'role_user.user_id')
            ->where('role_id', 4)->get();
        return view('admin.issue-tracking.index', compact('issuetracking','assignTo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.issue-tracking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(IssueTrackingRequest $request)
    {
        $requestData = $request->all();
        $requestData['user_id']=Auth::id();
        IssueTracking::create($requestData);
        $notification = array(
            'message' => "New Issue  successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect()->back();
        //return redirect('admin/issue-tracking');
    }
//also store method
    public function feedback(IssueTrackingRequest $request)
    {

        $requestData = $request->only('issue_tracking_id','actionComments');
        $id = $request->input('issue_tracking_id');
        $issueDataFind = IssueTracking::find($id);
        $isCompleted = $request->input('isCompleted');
        $requestData['user_id']=Auth::id();
        if ($issueDataFind->assignTo == Auth::id()) {
            $issueData['unread2initiator'] = 1;
            $issueData['unread2handler'] = 0;
            $issueDataFind->update($issueData);
        } elseif (Auth::id() == $issueDataFind->user_id) {
            $issueData['unread2initiator'] = 0;
            $issueData['unread2handler'] = 1;
            $issueDataFind->update($issueData);
        }
        if ($isCompleted == 1) {
            $issueData = $request->only('isCompleted');
            $issueData['unread2initiator'] = 0;
            $issueData['unread2handler'] = 0;
            $issueDataFind->update($issueData);
        }
        IssueTrackingDetail::create($requestData);
        $notification = array(
            'message' => "New Issue feedback successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        //return redirect()->previous();
        return redirect()->back();
    }


    public function assignTo(IssueTrackingRequest $request)
    {
        $id = $request->input('id');
        $issueTracking= IssueTracking::find($id);
        $requestData = $request->only('assignTo');
        $requestData['assignBy']=Auth::id();
        $issueTracking->update($requestData);
        $notification = array(
            'message' => "New Issue Assigned Person added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        //return redirect()->previous();
        return redirect()->back();
    }

    public function rating(IssueTrackingRequest $request,$id)
    {
        $issueTracking= IssueTracking::find($id);
        $requestData = $request->only('rating_id');
        $issueTracking->update($requestData);
        $notification = array(
            'message' => "your rating is counted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        //return redirect()->previous();
        return redirect()->back();
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

        $item = IssueTracking::findOrFail($id);
        $ratings = Rating::all();
        return view('admin.issue-tracking.show', compact('item', 'ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $issuetracking = IssueTracking::findOrFail($id);

        return view('admin.issue-tracking.edit', compact('issuetracking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(IssueTrackingRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $issuetracking = IssueTracking::findOrFail($id);
        $issuetracking->update($requestData);
        $notification = array(
            'message' => "Issue  successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/issue-tracking');
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
        IssueTracking::destroy($id);
        $notification = array(
            'message' => "Issue  successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/issue-tracking');
    }

}

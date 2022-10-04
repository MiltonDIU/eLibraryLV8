<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\A2zSubjectRequest;
use App\Models\A2ZSubject;
use Session;

class A2zSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $a2zsubject = A2zSubject::all();
        return view('admin.a2z-subject.index', compact('a2zsubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.a2z-subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(A2zSubjectRequest $request)
    {
        
        $requestData = $request->all();
        
        A2zSubject::create($requestData);
        $notification = array(
            'message' => "A 2 Z Subject   successfully created!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-subject');
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
        $item = A2zSubject::findOrFail($id);

        return view('admin.a2z-subject.show', compact('item'));
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
        $a2zsubject = A2zSubject::findOrFail($id);

        return view('admin.a2z-subject.edit', compact('a2zsubject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(A2zSubjectRequest $request, $id)
    {
        
        $requestData = $request->all();
        $a2zsubject = A2zSubject::findOrFail($id);
        $a2zsubject->update($requestData);
        $notification = array(
            'message' => "A 2 Z Subject   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-subject');
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
        A2zSubject::destroy($id);
        $notification = array(
            'message' => "A 2 Z Subject   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-subject');
    }
}

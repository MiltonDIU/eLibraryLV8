<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SisterConcernRequest;
use App\Models\SisterConcern;
use Session;

class SisterConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sisterconcern = SisterConcern::all();
        return view('admin.sister-concern.index', compact('sisterconcern'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sister-concern.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SisterConcernRequest $request)
    {
        
        $requestData = $request->all();
        SisterConcern::create($requestData);
        $notification = array(
            'message' => "Sister Concern Successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/sister-concern');
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
        $item = SisterConcern::findOrFail($id);

        return view('admin.sister-concern.show', compact('item'));
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
        $sisterconcern = SisterConcern::findOrFail($id);

        return view('admin.sister-concern.edit', compact('sisterconcern'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SisterConcernRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $sisterconcern = SisterConcern::findOrFail($id);
        $sisterconcern->update($requestData);
        $notification = array(
            'message' => "Sister Concern   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/sister-concern');
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
        SisterConcern::destroy($id);
        $notification = array(
            'message' => "Sister Concern   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/sister-concern');
    }
}

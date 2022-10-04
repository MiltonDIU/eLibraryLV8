<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\A2zTypeRequest;
use App\Models\A2zType;
use Session;

class A2zTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $a2ztype = A2zType::all();

        return view('admin.a2z-type.index', compact('a2ztype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.a2z-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(A2zTypeRequest $request)
    {
        
        $requestData = $request->all();
        
        A2zType::create($requestData);
        $notification = array(
            'message' => "A 2 Z Type   successfully created!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-type');
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
        $item = A2zType::findOrFail($id);

        return view('admin.a2z-type.show', compact('item'));
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
        $a2ztype = A2zType::findOrFail($id);

        return view('admin.a2z-type.edit', compact('a2ztype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(A2zTypeRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $a2ztype = A2zType::findOrFail($id);
        $a2ztype->update($requestData);
        $notification = array(
            'message' => "A 2 Z Type   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-type');
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
        A2zType::destroy($id);
        $notification = array(
            'message' => "A 2 Z Type   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-type');
    }
}

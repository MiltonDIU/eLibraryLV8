<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\A2zVendorRequest;
use App\Models\A2zVendor;
use Session;

class A2zVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $a2zvendor = A2zVendor::all();
        return view('admin.a2z-vendor.index', compact('a2zvendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.a2z-vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(A2zVendorRequest $request)
    {
        
        $requestData = $request->all();
        
        A2zVendor::create($requestData);
        $notification = array(
            'message' => "A 2 Z Vendor   successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-vendor');
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
        $item = A2zVendor::findOrFail($id);

        return view('admin.a2z-vendor.show', compact('item'));
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
        $a2zvendor = A2zVendor::findOrFail($id);

        return view('admin.a2z-vendor.edit', compact('a2zvendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(A2zVendorRequest $request, $id)
    {
        
        $requestData = $request->all();
        $a2zvendor = A2zVendor::findOrFail($id);
        $a2zvendor->update($requestData);
        $notification = array(
            'message' => "A 2 Z Vendor   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/a2z-vendor');
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
        A2zVendor::destroy($id);
        $notification = array(
            'message' => "A 2 Z Vendor   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-vendor');
    }
}

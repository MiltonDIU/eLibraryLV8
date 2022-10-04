<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryRequest;
use App\Models\ServiceCategory;
use Session;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

            $servicecategory = ServiceCategory::all();

        return view('admin.service-category.index', compact('servicecategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.service-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ServiceCategoryRequest $request)
    {


        $requestData = $request->all();
        $aWA = $request->input('accessibilityWithoutAuthentication');
       if($aWA==1){
           $request->validate([
               'externalUrl' => 'required|max:250'
           ]);
       }

        if ($request->hasFile('image')) {
            $uploadPath = public_path('/uploads/category');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('image')->move($uploadPath, $fileName);
            $requestData['image'] = $fileName;
        }


        ServiceCategory::create($requestData);
        $notification = array(
            'message' => "Service Category   successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/service-category');
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
        $item = ServiceCategory::findOrFail($id);

        return view('admin.service-category.show', compact('item'));
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
        $servicecategory = ServiceCategory::findOrFail($id);

        return view('admin.service-category.edit', compact('servicecategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ServiceCategoryRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $servicecategory = ServiceCategory::findOrFail($id);
        $servicecategory->update($requestData);
        $notification = array(
            'message' => "Service Category   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/service-category');
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
        ServiceCategory::destroy($id);
        $notification = array(
            'message' => "Service Category successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/service-category');
    }
}

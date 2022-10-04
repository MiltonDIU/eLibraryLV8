<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {


        $requestData = $request->all();
        $aWA = $request->input('accessibilityWithoutAuthentication');
        if ($aWA == 1) {
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


        Category::create($requestData);
        $notification = array(
            'message' => "Item Category   successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);

        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = Category::findOrFail($id);

        return view('admin.category.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, $id)
    {

        $requestData = $request->all();

        $category = Category::findOrFail($id);

        //$aWA = $request->input('accessibilityWithoutAuthentication');


        if ($request->hasFile('image')) {
            $uploadPath = public_path('/uploads/category');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(1111111, 9999999) . '.' . $extension;
            $request->file('image')->move($uploadPath, $fileName);
            $requestData['image'] = $fileName;
        }

        $category->update($requestData);
        $notification = array(
            'message' => "Category successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);

        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Category::destroy($id);
        $notification = array(
            'message' => "Item Category successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);

        return redirect('admin/category');
    }
}

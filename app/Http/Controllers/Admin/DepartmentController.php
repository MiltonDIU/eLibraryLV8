<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Session;
use DataTables;
use App\Models\Item;
use App\Models\Category;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(DepartmentRequest $request)
    {
        
        $requestData = $request->all();
        
        Department::create($requestData);
        $notification = array(
            'message' => "Department  successfully created!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/department');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request,$id)
    {
        $item = Department::with('item')->findOrFail($id);
        return view('admin.department.show',compact('item'));
    }
    public function departmentBooks(Request $request,$id)
    {
        $department = Department::with('item')->findOrFail($id);
        if ($request->ajax()) {
            $data = $department->item;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('url', function($row){
                    $category = Category::find($row->category_id);
                    $url = url("service/$category->itemCategoryShort/$row->slug");
                    return $url;
                })
                ->addColumn('author',function ($row){
                    $authorD = [];
                    $item = Item::with('author')->find($row->id);
                    foreach ($item->author as $author){
                        array_push($authorD, $author->authorName);
                    }
                    return join(", ",$authorD);
                })
                ->addColumn('category',function ($row){
                    $category = Category::find($row->category_id);
                   return $category->itemCategoryShort;
                })
                ->addColumn('edit', function($row){
                    return url("admin/item/$row->id/edit");
                })
                ->addColumn('department',function ($row){
                    $departmentD = [];
                    $item = Item::with('department')->find($row->id);
                    foreach ($item->department as $department){
                        array_push($departmentD, $department->deptShortName);
                    }
                    return join(", ",$departmentD);
                })
                ->make(true);
        }
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
        $department = Department::findOrFail($id);

        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DepartmentRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $department = Department::findOrFail($id);
        $department->update($requestData);
        $notification = array(
            'message' => "Department  successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/department');
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
        Department::destroy($id);
        $notification = array(
            'message' => "Department  successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/department');
    }
}

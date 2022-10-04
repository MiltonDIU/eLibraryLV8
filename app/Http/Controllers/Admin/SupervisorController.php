<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupervisorRequest;
use App\Models\Department;
use App\Models\Supervisor;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = Supervisor::all();
        return view('admin.supervisor.index',compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('departmentName','id');
        return view('admin.supervisor.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupervisorRequest $request)
    {
        try {
    $data = $request->only('department_id','email','mobile','designation','name','employeeId');
    //$data = $request->all();
    Supervisor::create($data);
    $notification = array(
        'message' => "New Supervisor Successfully added!",
        'alert-type' => 'success'
    );
    Session::flash('notification', $notification);
    return redirect('admin/supervisor');

}catch (Exception $exception){
    return back()->withInput()
        ->withErrors(['unexpected_error' => "Unexpected error occurred while trying to process your request!".$exception->getMessage()]);
}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Supervisor::findORFail($id);
        return view('admin.supervisor.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::pluck('departmentName','id');
        $supervisor = Supervisor::findOrFail($id);
        return view('admin.supervisor.edit',compact('supervisor','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupervisorRequest $request, $id)
    {
        try {
            $data = $request->only('department_id','email','mobile','designation','name','employeeId');
            $supervisor = Supervisor::findOrFail($id);
            $supervisor->update($data);
            $notification = array(
                'message' => "New Supervisor Successfully updated!",
                'alert-type' => 'success'
            );
            Session::flash('notification', $notification);
            return redirect('admin/supervisor');
        }catch (Exception $exception){
            return back()->withInput()
                ->withErrors(['unexpected_error' => "Unexpected error occurred while trying to process your request!".$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supervisor::destroy($id);
        $notification = array(
            'message' => "Supervisor  successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/supervisor');
    }
}

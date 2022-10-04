<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\A2zDatabaseRequest;
use App\Models\A2zDatabase;
use App\Models\A2zHitCounter;
use App\Models\A2ZSubject;
use App\Models\A2zType;
use App\Models\A2zVendor;
use Illuminate\Support\Facades\Auth;
use Session;


class A2zDatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $a2zdatabase = A2zDatabase::all();
        return view('admin.a2z-database.index', compact('a2zdatabase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $a2z_types = A2zType::pluck('a2zTypeName', 'id');
        $a2z_vendors = A2zVendor::pluck('a2zVendorName','id');
        $a2z_subjects = A2ZSubject::pluck('a2zSubjectName','id');
        return view('admin.a2z-database.create',compact('a2z_subjects','a2z_types','a2z_vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(A2zDatabaseRequest $request)
    {

        $requestData = $request->only('a2z_type_id', 'a2z_vendor_id', 'a2zTitle', 'a2zDescription', 'trial', 'lock', 'redirectLink', 'isVisible');
        $user_id = Auth::id();
        $requestData['user_id']=$user_id;
        $a2zDatabase = A2zDatabase::create($requestData);
        $subjects_ids = $request->input('a2z_subject_ids');
        // dd($subjects_ids);
        $a2zDatabase->a2zSubject()->attach($subjects_ids);



        $notification = array(
            'message' => 'A2Z Database has been  successfully created!',
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-database')->with('flash_message', 'A2zDatabase added!');
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
        $this->a2zHitCounter($id);
        $item = A2zDatabase::findOrFail($id);
        return view('admin.a2z-database.show', compact('item'));
    }
    public function a2zHitCounter($id){
        $a2zHitCounter = $a2zHitCounter = A2zHitCounter::where('a2z_database_id',$id)->get()->last();
        if ($a2zHitCounter==null){
            $this->a2zHitCounterInitialRow($id);
        }else{
            $startTime = new \DateTime($a2zHitCounter->currentDate);
            if($startTime->format('Y-m-d') == date("Y-m-d")) {
                $requestData['hitCount']=$a2zHitCounter->hitCount+1;
                $a2zHitCounter->update($requestData);
            } else {
                $this->a2zHitCounterInitialRow($id);
            }

        }
    }
    public function a2zHitCounterInitialRow($id){
        $requestData['a2z_database_id']=$id;
        $requestData['hitCount']=1;
        $requestData['currentDate']=date("Y-m-d h:i:s");
        A2zHitCounter::create($requestData);
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
        $a2zdatabase = A2zDatabase::findOrFail($id);

        $a2z_types = A2zType::pluck('a2zTypeName', 'id');
        $a2z_vendors = A2zVendor::pluck('a2zVendorName','id');
        $a2z_subjects = A2ZSubject::pluck('a2zSubjectName','id');

        $selected_subjects = $a2zdatabase->a2zSubject()->pluck('a2z_subject_id')->toArray();


        return view('admin.a2z-database.edit', compact('a2zdatabase', 'a2z_subjects', 'a2z_types', 'a2z_vendors', 'selected_subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(A2zDatabaseRequest $request, $id)
    {
        $requestData = $request->all();
        $a2zdatabase = A2zDatabase::findOrFail($id);
        $requestData['user_id']=Auth::id();
        $a2zdatabase->update($requestData);
        $notification = array(
            'message' => 'A2Z Database has been  successfully Updated!',
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-database');
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
        A2zDatabase::destroy($id);
        $notification = array(
            'message' => 'A2Z Database has been  successfully Deleted!',
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/a2z-database');
    }
}

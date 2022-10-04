<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceUser;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")
                ->orWhere('alias', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Role $role)
    {
        $serviceCategory = ServiceCategory::all();
        $services = Service::all();
        $selectedService = $role->service()->pluck('service_id')->toArray();
        return view('admin.roles.create', compact('services', 'serviceCategory', 'selectedService'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        $role = Role::create($requestData);

        $services = $request->input('services');
        $role->service()->attach($services);
        $notification = array(
            'message' => "Role Service Successfully Created!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);
        return redirect('admin/roles');
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
        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {

        $serviceCategory = ServiceCategory::all();
        $services = Service::all();
        $selectedService = $role->service()->pluck('service_id')->toArray();


        return view('admin.roles.edit', compact('role', 'services', 'serviceCategory', 'selectedService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $detaceService = array();
        $newService = array();


        $oldRoleService = DB::table('role_service')->where('role_id', $id)->pluck('service_id')->toArray();
        $requestData = $request->all();
        $role = Role::findOrFail($id);
        $role->update($requestData);
        $services = $request->input('services');

        $role->service()->sync($services);

        $roleUsers = DB::table('role_user')->where('role_id', $id)->get()->toArray();

        if ($services == null) {
            $services = Array();
        }
        if (!empty($oldRoleService)) {
            $detaceService = array_diff($oldRoleService, $services);
        }
        if (!empty($services)) {
            $newService = array_diff($services, $oldRoleService);
        }
        $login_id = Auth::id();
        foreach ($roleUsers as $key => $sr) {
            $user_id = $roleUsers[$key]->user_id;
            if (!empty($detaceService)) {
                foreach ($detaceService as $ds) {
                    $service = ServiceUser::where('service_id', $ds)->where('user_id', $user_id)->first();


                    if ($service !=null){
                        if ($service->roleCount > 1) {
                            $data['login_id'] = $login_id;
                            $data['isRoleService'] = 1;
                            $data['roleCount'] = $service->roleCount - 1;//$services->roleCount-1;
                            $data['service_id'] = $ds;
                            $data['updated_at'] = Carbon::now()->toDateTimeString();
                            $service->update($data);
                        } else {
                            ServiceUser::destroy($service->id);
                        }
                    }

                }
            }
            if (!empty($newService)) {
                foreach ($newService as $ds) {
                    $service = ServiceUser::where('service_id', $ds)->where('user_id', $user_id)->first();
                    if (!empty($service)) {
                        $data['login_id'] = $login_id;
                        $data['isRoleService'] = 1;
                        $data['roleCount'] = $service->roleCount + 1;//$services->roleCount-1;
                        $data['service_id'] = $ds;
                        $data['updated_at'] = Carbon::now()->toDateTimeString();
                        $service->update($data);
                    } else {
                        $data['login_id'] = $login_id;
                        $data['user_id'] = $user_id;
                        $data['isRoleService'] = 1;
                        $data['roleCount'] = 1;//$services->roleCount-1;
                        $data['service_id'] = $ds;
                        $data['created_at'] = Carbon::now()->toDateTimeString();
                        $data['updated_at'] = Carbon::now()->toDateTimeString();
                        ServiceUser::create($data);
                        //ServiceUser::destroy($service->id);
                    }
                }
            }
        }
        $notification = array(
            'message' => "Role Service Successfully Updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);
        return redirect('admin/roles');
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
        Role::destroy($id);
        $notification = array(
            'message' => "Role Service Successfully Deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification', $notification);
        return redirect('admin/roles');
    }

    public function serviceUserUpdate($sr, $user_id, $login_id)
    {

        $service = DB::table('service_user')->where('service_id', $sr)->where('user_id', $user_id)->first();
        if ($service != null) {
            $isRole = 1;
            $roleCount = $service->roleCount;
            $roleCount += 1;
        } else {
            $isRole = 1;
            $roleCount = 1;
        }

        $data['login'] = $login_id;
        $data['isRoleService'] = $isRole;
        $data['roleCount'] = $roleCount;
        $data['service_id'] = $sr;
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        return $data;
    }
}

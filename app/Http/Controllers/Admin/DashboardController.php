<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\IssueTracking;
use App\Models\Item;
use App\Models\SisterConcern;
use App\User;
use Carbon\Carbon;
use DB;
use App\Models\Role;
use App\Models\ItemUser;
class DashboardController extends Controller
{
    public function index()
    {

$monty_wise_users = User::select('id', 'created_at')
    ->get()
                ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('M Y'); // grouping by years and its month
});
$month_wise_downloads = ItemUser::select('id', 'created_at')
    ->get()->groupBy(function($date) {
      return Carbon::parse($date->created_at)->format('M Y'); // grouping by years and its month
});

        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $items = Item::all();
        $services = Category::withCount('item')->orderBy('item_count', 'desc')->get();
       
        $results = array();
        $result = ['Task', 'Hours per Day'];

        foreach ($services as $key => $service) {
            $count = 0;
            $items = Item::where('category_id', $service->id)->get();
           
            foreach ($items as $item) {
                $count += DB::table('item_user')->where('item_id', $item->id)->count();
            }
            array_push($results, array(
                'service' => $service->itemCategory,
                'counts' => (int)$count,
            ));
            $result[++$key] = [$service->itemCategory, (int)$count];
          
        }
        $departments = Department::all();

        $departmentsArr = array();
        foreach ($departments as $department) {
            $count=0;
            $count += DB::table('department_item')->where('department_id', $department->id)->count();
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            array_push($departmentsArr, array(
                'departmentName' => $department->departmentName,
                'counts' => (int)$count,
                'color' => $color,
            ));
        }

        $users = User::all()->count();
        $items = Item::all()->count();
        $department = Department::all()->count();
        $categories = Category::all()->count();
        $issueTracking = IssueTracking::all()->count();
        $concern = SisterConcern::all()->count();
        $downloads = DB::table('item_user')->get()->count();
        $views = DB::table('item_views')->get()->count();

        $current_months_user = User::whereMonth('created_at', date('m'))->whereYear('created_at',date('Y'))->count();
        $current_months_download = ItemUser::whereMonth('created_at', date('m'))->whereYear('created_at',date('Y'))->count();

        $itemUsers = User::withCount('item')->having('item_count','>',0)->orderBy('item_count','desc')->get();

        $itemToday = User::withCount(['item' => function ($query) {
            $query->whereDate('created_at', Carbon::today());
        }])->having('item_count','>',0)->orderBy('item_count','desc')->get();

        $itemPreviousMonth = User::withCount(['item' => function ($query) {
            $query
            ->whereMonth('created_at', date("m",strtotime("-1 month")))
            ->whereYear('created_at',date("Y",strtotime("-1 month")))
            ;
        }])->having('item_count','>',0)->orderBy('item_count','desc')->get();


        $itemCurrentMonth = User::withCount(['item' => function ($query) {
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
            $query->where('created_at', '<=', Carbon::now()->endOfMonth());
        }])->having('item_count','>',0)->orderBy('item_count','desc')->get();
        

//dd($departmentsArr);
        return view('admin.dashboard', compact('issueTracking','users', 'monty_wise_users', 'month_wise_downloads', 'items','current_months_download','current_months_user', 'department', 'categories', 'concern', 'views', 'downloads','itemUsers','itemToday','itemCurrentMonth','itemPreviousMonth'))
            ->with('visitor', json_encode($results))
            ->with('departments', json_encode($departmentsArr));
    }

    public function itemCount($key, $service)
    {

        //return $result;
    }
}

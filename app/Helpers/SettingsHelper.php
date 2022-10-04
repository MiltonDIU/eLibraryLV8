<?php
/**
 * Created by PhpStorm.
 * User: DIU
 * Date: 10/28/2017
 * Time: 9:22 AM
 */

namespace App\Helpers;

use App\Models\IssueTrackingDetail;
use App\Models\Item;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Notice;
use App\Schedule;
use App\Setting;
use App\User;
use App\UserSchedule;
use Auth;
use DB;
use App\Models\ItemUser;

class SettingsHelper
{
    public static function config(){

        $data['contact'] = "hello Milton";
        return $data;
    }

    public static function admit(){

    }
    public static function downloadReport($id){
        $items = ItemUser::where('item_id',$id)->count();
        return $items;
    }

    public static function notice(){


    }

    public static function assignTo($id = null)
    {
        if ($id == null) {
            return "N/A";
        } else {
            $user = User::find($id);
            return $user->displayName;
        }
    }

    public static function assignby($id = null)
    {
        if ($id == null) {
            return "N/A";
        } else {
            $user = User::find($id);
            return $user->displayName;
        }
    }

    public static function feedbackCount($id)
    {
        $feedbackCount = IssueTrackingDetail::where('issue_tracking_id', $id)->get()->count();
        return $feedbackCount;
    }

    public static function menu()
    {
        $user_id = Auth::id();
        $userService = DB::table('service_user')
            ->join('services', 'service_user.service_id', '=', 'services.id')
            ->where('service_user.user_id', $user_id)->where('services.action', 'index')->pluck('services.service_category_id')->toArray();

        $service = Service::distinct()->pluck('service_category_id')->toArray();
        $accessService = array_intersect($service, $userService);
        $result = "";
        foreach ($accessService as $item) {
            $sc = ServiceCategory::find($item);
            if ($sc->isVisible == 1) {
                $result .= '<li class="nav-item start ">';
                $result .= '<a href="' . url('admin/' . $sc->serviceCategoryShort) . '"  >';
                $result .= '<i class="icon-arrow-up"></i>';
                $result .= '<span class="title">' . $sc->serviceCategory . '</span>';
                $result .= '</a>';
                $result .= ' </li>';
            }
        }
        return $result;
    }

    public static function auditLogs()
    {

    }

    public static function serviceCategory($id)
    {
        $data = ServiceCategory::find($id);
        return $data->serviceCategory;
    }

    public static function getViewPage()
    {

    }
}
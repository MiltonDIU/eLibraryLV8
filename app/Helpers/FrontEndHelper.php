<?php
/**
 * Created by PhpStorm.
 * User: DIU
 * Date: 10/28/2017
 * Time: 9:22 AM
 */

namespace App\Helpers;

use App\Models\AuditLog;
use App\Models\Author;
use App\Models\Category;
use App\Models\Department;
use App\Models\IssueTracking;
use App\Models\IssueTrackingDetail;
use App\Models\Item;
use App\Models\ItemView;
use App\Notice;
use App\Schedule;
use App\Setting;
use App\User;
use App\UserSchedule;
use Auth;
use DB;
use Form;

class FrontEndHelper
{
    //Header Menu Part
    public static function serviceMenu()
    {
        $services = Category::withCount('item')->where('isVisible',1)->orderBy('item_count', 'desc')->get();
        //$services = Category::where('isVisible', 1)->get();
        $result = "";
        foreach ($services as $item) {
            if ($item->externalUrl == null) {
                $result .= "<li><a href=" . url('service', $item->itemCategoryShort) . ">";
                $result .= "$item->itemCategory <span class='count'></span>";
                $result .= "</a>";
                $result .= "</li>";
            } else {
                $result .= "<li><a target='_blank' href=" . $item->externalUrl . ">";
                $result .= "$item->itemCategory <span class='count'></span>";
                $result .= "</a>";
                $result .= "</li>";
            }
        }
        return $result;
    }

    //end of header menu part
    // start of Sidebar part
    public static function departmentSidebar()
    {
        //$departments = Department::get()->take(5);
        $departments = Department::withCount('item')->orderBy('item_count', 'desc')->get()->take(5);

        $result = "<ul class=\"nav sidebar-categories margin-bottom-40\">";
        foreach ($departments as $item) {
            $result .= '<li>';
            $result .= "<a href=" . url('category', $item->deptShortName) . ">";
            $result .= $item->departmentName." ($item->item_count)";
            $result .= '</a>';
            $result .= ' </li>';
        }
        $result .= '<li> <a href=' . url('category') . '>more..</a> </li>';
        $result .= "</ul>";
        return $result;
    }

    public static function authorSidebar()
    {
        //$departments = Author::withCount('item')->orderBy('item_count', 'desc')->get()->take(5);
        $departments = Author::withCount('item')->orderBy('item_count', 'desc')->get()->take(5);
        $result = "<ul class=\"nav sidebar-categories margin-bottom-40\">";
        foreach ($departments as $item) {
            $result .= '<li>';
            $result .= "<a href=" . url('author', $item->slug) . ">";
            $result .= $item->authorName . " ($item->item_count)";
            $result .= '</a>';
            $result .= ' </li>';
        }
        $result .= '<li> <a href=' . url('author') . '>more..</a> </li>';
        $result .= "</ul>";
        return $result;
    }

    public static function yearSidebar()
    {
        $items = Item::distinct('publicationYear')->orderBy('publicationYear', 'desc')->pluck('publicationYear');
        $result = '<ul class="nav sidebar-categories margin-bottom-40">';

        for ($i = 0; $i < sizeof($items); $i++) {
            $count = Item::where('publicationYear', $items[$i])->count();
            $data[$items[$i]] = $count;
        }
        if (isset($data)) {
$i=0;
            arsort($data);

            foreach ($data as $key => $car) {
                $result .= '<li>';
                $result .= "<a href=" . url('year', $key) . ">$key ($car)</a>";
                $result .= "</li>";
                $i++;
                if ($i===5){
                    $result .= '<li>';
                    $result .= "<a href=" . url('year') . ">More..</a>";
                    $result .= "</li>";
                    break;
                }
            }
        }
        $result .= " </ul>";
        return $result;
    }
    //end of sidebar function

    // start of page content search
    public static function departments()
    {
        $departments = Department::withCount('item')->orderBy('item_count', 'desc')->get();
        $result = "<ul class='list-unstyled'>";
        foreach ($departments as $item) {
            $result .= '<li class="col-md-6 list-page" >';
            $result .= '<a href="' . url('category/' . $item->deptShortName) . '"  >';
            $result .= '<i class="fa fa-check"></i>';
            $result .= $item->departmentName . " <span class='count'>($item->item_count)</span>";
            $result .= '</a>';
            $result .= ' </li>';
        }
        $result .= "</ul>";
        return $result;
    }

    public static function years()
    {
        $items = Item::distinct('publicationYear')->orderBy('publicationYear', 'desc')->pluck('publicationYear');
        $result = "<ul class='list-unstyled'>";
        $data = array();
        for ($i = 0; $i < sizeof($items); $i++) {
            $count = Item::where('publicationYear', $items[$i])->count();
            $data[$items[$i]] = $count;
        }
        arsort($data);
        foreach ($data as $key => $car) {
            $result .= '<li class="col-md-2 list-page" > <i class="fa fa-check"></i>';
            $result .= "<a href=" . url('year', $key) . ">$key ($car)</a>";
            $result .= "</li>";
        }
        $result .= " </ul>";
        return $result;
    }
    public static function authors()
    {
        $departments = Author::withCount('item')->orderBy('item_count', 'desc')->get();
        $result = "<ul class='list-unstyled'>";
        foreach ($departments as $item) {
            $result .= '<li class="col-md-4 list-page" >';
            $result .= '<a href="' . url('author/' . $item->slug) . '"  >';
            $result .= '<i class="fa fa-check"></i>';
            $result .= $item->authorName . " <span class='count'>($item->item_count)</span>";
            $result .= '</a>';
            $result .= ' </li>';
        }
        $result .= "</ul>";
        return $result;
    }

    public static function services()
    {
        $services = Category::where('isVisible', '1')->orderBy('serial','ASC')->get();
        $service1 = $services->count();
        $service = $services->count();
        $result = "<div class='row'>";
        foreach ($services as $item) {

            
            if ($service1 % 4 == 0) {
                $col = 3;
            } elseif ($service1 % 4 == 1) {
                if ($service > 3) {
                    $col = 3;
                } else {
                    $col = 6;
                }
            } else {
                if ($service > 1) {
                    $col = 3;
                } else {
                    $col = 6;
                }
            }
            

            // if ($service1 % 3 == 0) {
            //     $col = 3;
            // } elseif ($service1 % 3 == 1) {
            //     if ($service > 4) {
            //         $col = 3;
            //     } else {
            //         $col = 6;
            //     }
            // } else {
            //     if ($service > 2) {
            //         $col = 4;
            //     } else {
            //         $col = 6;
            //     }
            // }



            $service--;
            $shortDescription = substr($item->shortDescription, 0, 60) . '..';
            $result .= "<div class='col-md-" . $col . " col-sm-6'>";
            if ($item->externalUrl == null) {
                $result .= "<a  class='service-link' href=" . url('service', $item->itemCategoryShort) . ">";
            } else {
                $result .= "<a target='_blank'  class='service-link' href=" . $item->externalUrl . ">";
            }

            $result .= "<div class='service_box'>";
            $result .= '<div class="service_icon"><img src=' . url('uploads/category/' . $item->image) . ' alt=' . $item->itemCategory . '> </div>';
            $result .= "<h3>$item->itemCategory</h3>";
            //$result .= "<p>$shortDescription</p>";
            $result .= "</div>";
            $result .= "</a>";
            $result .= "</div>";
        }
        $result .= "</div>";
        return $result;
    }
    /*
    public static function services()
    {
        $services = Category::where('isVisible', 1)->get();
        $service1 = $services->count();
        $service = $services->count();
        $result = "<div class=\"row\">";
        foreach ($services as $item) {
            if ($service1 % 3 == 0) {
                $col = 4;
            } elseif ($service1 % 3 == 1) {
                if ($service > 4) {
                    $col = 4;
                } else {
                    $col = 6;
                }
            } else {
                if ($service > 2) {
                    $col = 4;
                } else {
                    $col = 6;
                }
            }
            $service--;
            $shortDescription = substr($item->shortDescription, 0, 60) . '..';
            $result .= "<div class='col-md-" . $col . " col-sm-6'>";
            if ($item->externalUrl == null) {
                $result .= "<a  class='service-link' href=" . url('service', $item->itemCategoryShort) . ">";
            } else {
                $result .= "<a target='_blank'  class='service-link' href=" . $item->externalUrl . ">";
            }

            $result .= "<div class='service_box'>";
            $result .= '<div class="service_icon"><img src=' . url('uploads/category/' . $item->image) . ' alt=' . $item->itemCategory . '> </div>';
            $result .= "<h3>$item->itemCategory</h3>";
            $result .= "<p>$shortDescription</p>";
            $result .= "</div>";
            $result .= "</a>";
            $result .= "</div>";
        }
        $result .= "</div>";
        return $result;
    }
    */

//end of page content search

    //start home page search select box values
    public static function departmentSearch()
    {
        $departments = Department::withCount('item')->orderBy('item_count', 'desc')->get();
        $result = '<select  class="js-example-basic-single col-md-12" name="department_id" title="Department">';
        $result .= '<option value="" selected disabled>Select Department</option>';
        foreach ($departments as $item) {
            $result .= "<option value=" . 'department/' . $item->deptShortName . ">$item->departmentName ($item->item_count) </option>";
        }
        $result .= '</select>';
        return $result;
    }


    public static function serviceSearch()
    {
        $categories = Category::withCount('item')->orderBy('item_count', 'desc')->get();
        $result = '<select  class="js-example-basic-single col-md-12" name="category_id" title="Services">';
        $result .= '<option value="" selected disabled>Select Service</option>';
        foreach ($categories as $item) {
            $result .= "<option value=" . $item->id . ">$item->itemCategory ($item->item_count) </option>";
        }
        $result .= " </select>";
        return $result;
    }

    public static function authorsSearch()
    {
        $authors = Author::withCount('item')->orderBy('item_count', 'desc')->get();
        $result = '<select  class="js-example-basic-single col-md-12" name="category_id" title="Authors">';
        $result .= '<option value="" selected disabled>Select Author</option>';
        foreach ($authors as $item) {
            $result .= "<option value=" . $item->id . ">$item->authorName ($item->item_count) </option>";
        }
        $result .= " </select>";
        return $result;
    }
// end of home page search select box values

//item download count per user
    public static function itemDownloadCount($id)
    {
        $count = DB::table('item_user')->where('item_id', $id)->get()->count();
        return $count;
    }

    public static function itemUserDownloadCount($id)
    {
        $count = DB::table('item_user')->where('user_id', $id)->get()->count();
        return $count;
    }

    public static function getFeedbackCount($id)
    {
        $count = IssueTracking::where('user_id', $id)->get()->count();
        return $count;
    }

    public static function getMessageCount($id)
    {
        $count = IssueTrackingDetail::where('user_id', $id)->get()->count();
        return $count;
    }
    public static function itemViewCount($id)
    {
        $count = DB::table('item_views')->where('item_id', $id)->get()->count();
        return $count;
    }

    public static function unreadMessage($id)
    {
        $count = IssueTracking::where('user_id', $id)->where('unread2initiator', 1)->get()->count();
        return $count;
    }
    // multiple item view as like department wise, author wise, year wise, service wise etc.
    public static function getItem($item)
    {
        $url = $item->slug;
        $result = "";
        $result .= '<div class="row"><div class="col-md-3 col-sm-4">';
        if (!$item->imageUrl == null) {
            $result .= "<img class='img-responsive item-cover-image' alt='' src=" . $item->imageUrl . ">";
        } else {
            $result .= "<img class='img-responsive item-cover-image' alt='' src=" . url('uploads/item/covers', $item->uploadImageUrl) . ">";
        }
        $result .= '</div><div class="col-md-9 col-sm-8">';
        $result .= "<h3><a href=" . url(request()->path(), $url) . ">$item->title</a></h3>";
        $result .= '<ul class="blog-info"><li><ul class="author-item-ul"><i class="fa fa-user"></i>';
        foreach ($item->author as $author) {
            $result .= "<li><a href=" . url('author', $author->slug) . ">$author->authorName</a></li>";
        }
        $result .= '</ul></li><li><i class="fa fa-download"></i>';
        $result .= FrontEndHelper::itemDownloadCount($item->id);
        $result .= "</li>";
        $result .= '<li><i class="fa fa-eye"></i>';
        $result .= FrontEndHelper::itemViewCount($item->id);
        $result .= "</li>";
        $result .= "</ul><p>" . substr($item->summary, 0, 250) . "</p>";
        $result .= "<a class='more' href=" . url(request()->path(), $item->slug) . ">Read more<i class='fa fa-angle-double-right'></i></a>";

        if (!$item->pdfUrl == null) {
            $result .= Form::open(['url' => '/download/' . $item->id . '/' . $item->slug, 'class' => 'form-horizontal download-form', 'name' => $item->id]);
            $result .= "<a href=" . url('download') . '/' . $item->id . '/' . $item->slug . ">";
            $result .= "<input type='hidden' name='id' value=" . $item->id . "><input type='hidden' name='slug' value=" . $item->slug . "><input type='submit' class='download' value='Download'>";
            $result .= "</a>";
            $result .= Form::close();
        }
        $result .= '</div></div>';
        return $result;
    }

//document.getElementsByName(out)[0].value = diff
    public static function itemViewReport($item, $years)
    {
        $result = "";
        $result .= '<ul class="tabbable faq-tabbable " style="margin-top: 30px;">
                    <li class="active sidebar-active">
                    <a href="#" data-toggle="tab" aria-expanded="true">Total Visits (' . FrontEndHelper::itemViewCount($item->id) . ')</a>';

        foreach ($years as $key => $year) {

            $result .= '<div id="accordion' . $key . '" class="panel-group left-bar-menu">
                        <div class="panel panel-default">
                            <div class="panel-heading statistics">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion' . $key . '" href="#accordion1_' . $key . '">
                                    ' . $key . '(' . $year . ')' . '
                                    </a>
                                </h4>
                            </div></div>
                            <div style="height: 0px;" id="accordion1_' . $key . '" class="panel-collapse collapse">
                                <div class="panel-body">
                <ul class="pricing-content list-unstyled">';

            foreach (FrontEndHelper::month($item->id, $key) as $key => $month) {
                $result .= "<li><i class='fa fa-angle-double-right'></i> $key ($month)</li>";
            }
            $result .= '
        </ul></div>
        </div>
        </div>  ';
        }

        $result .= '</li></ul><ul class="tabbable faq-tabbable sidebar-active2">
                    <li class="active "><a href="#">File Visits (' . FrontEndHelper::itemDownloadCount($item->id) . ')</a> </li></ul>';
        return $result;
    }

    public static function month($id, $year)
    {
        $years = ItemView::where('item_id', $id)->where('created_at', 'like', '%' . $year . '%')->get();;
        $months = array();
        foreach ($years as $year) {
            array_push($months, date_create($year->created_at)->format('F'));
        }
        $months = array_count_values($months);
        krsort($months);
        return $months;
    }


    // end of  multiple item view as like department wise, author wise, year wise, service wise etc.

    //start  Item details option
     public static function getItemDetails($item, $years)
    {
        $result = "";
        $result .= '<div class="row"><div class="col-md-3 col-sm-4">';
        if (!$item->imageUrl == null) {
            $result .= "<img class='img-responsive item-cover-image' alt='' src=" . $item->imageUrl . ">";
        } else {
            $result .= "<img class='img-responsive item-cover-image' alt='' src=" . url('uploads/item/covers', $item->uploadImageUrl) . ">";
        }
        $result .= FrontEndHelper::itemViewReport($item, $years);
        $result .= '</div><div class="col-md-9 col-sm-8">';

        $result .= "<h3><a href=" . url(request()->path()) . ">$item->title</a></h3>";
        $result .= '<ul class="blog-info"><li><ul class="author-item-ul"><i class="fa fa-user"></i>';
        foreach ($item->author as $author) {
            $result .= "<li><a href=" . url('author', $author->slug) . ">$author->authorName</a></li>";
        }
        $result .= '</ul></li>';
        $result .= '<li><i class="fa fa-download"></i>';
        $result .= FrontEndHelper::itemDownloadCount($item->id);
        $result .= "</li>";
        $result .= '<li><i class="fa fa-eye"></i>';
        $result .= FrontEndHelper::itemViewCount($item->id);
        $result .= "</li>";
        $result .= "</ul>";
        $result .= "<p>$item->summary</p>";
        if (!$item->pdfUrl == null) {
            $result .= Form::open(['url' => '/download/' . $item->id . '/' . $item->slug, 'class' => 'form-horizontal download-form', 'name' => $item->id]);
            $result .= "<a class='btn btn-dark-blue' href=" . url('download') . '/' . $item->id . '/' . $item->slug . "><i class='fa fa-download'></i>";
            $result .= "<input type='hidden' name='id' value=" . $item->id . "><input type='hidden' name='slug' value=" . $item->slug . "><input type='submit' class='download' value='Download'>";
            $result .= "</a>";
            $result .= Form::close();

        }
        $result .= '</div></div>';
        return $result;
    }



    /*
     *  <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-leaf"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>*/

    //end of  Item details option

    // recent image page
    public static function recentUpload()
    {
        $items = Item::latest('created_at')
            ->where(function ($q){
                $q->whereNotNull('uploadImageUrl');
                $q->orWhereNotNull('imageUrl');
            })
            ->get()->take(10);
//        dd($items);
        return $items;
    }

    public static function recentVisitors()
    {
        $users = AuditLog::with('user')->distinct()->get(['user_id'])->take(5);
        return $users;
    }

    public function search(){

    }
}
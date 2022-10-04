<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Item;
Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    echo "1<br>";
    Artisan::call('view:clear');
    echo "1<br>";
    Artisan::call('config:cache');
    echo "1<br>";
    Artisan::call('config:clear');
    echo "1<br>";
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('php-info', function (){
    phpinfo();
});
Route::get('cover-path','App\Http\Controllers\Admin\ItemController@coverPath');
Route::get('file-path','App\Http\Controllers\Admin\ItemController@filePath');
Route::get('/admin/api-report','App\Http\Controllers\Admin\TestController@index');

Route::get('/admin/api-test','App\Http\Controllers\Admin\TestController@testApi');

Route::get('/admin/select','App\Http\Controllers\Admin\ItemController@select2');
Route::post('/select/getAuthors/','App\Http\Controllers\Admin\ItemController@getAuthors')->name('author.getAuthors');


Route::post('users', 'App\Http\Controllers\Admin\\UsersController@index'); // item search in backend

Route::post('/author/new', 'App\Http\Controllers\Admin\\AuthorController@ajaxPost');
Route::post('/author-store', 'App\Http\Controllers\Admin\\AuthorController@authorStore');
Route::post('/publisher-store', 'App\Http\Controllers\Admin\\PublisherController@publisherStore');
//Route::post('/authorList','App\Http\Controllers\Admin\\AuthorController@authorList');
Route::resource('/authors', 'App\Http\Controllers\Admin\\AuthorController');

Route::get('/author-json', 'App\Http\Controllers\Admin\\AuthorController@getJson')->name('authorJson');
Route::get('/publisher-list', 'App\Http\Controllers\Admin\\PublisherController@getPublisher');

Route::post('/download/{id}/{slug}', 'App\Http\Controllers\Member\\HomeController@getDownload');
Route::post('item', 'App\Http\Controllers\Admin\\ItemController@index'); // item search in backend
Route::post('check-item-standard-value', 'App\Http\Controllers\Admin\\ItemController@itemStandardValueCheck'); // item search in backend

Route::post('/search', [FrontEndController::class, 'search']);// item search in ajax
Route::post('/a2z', [FrontEndController::class, 'a2zDatabase']);// item search in ajax
Route::get('/a2z', [FrontEndController::class, 'a2zDatabase']);
Route::get('/a2z/{id}', [FrontEndController::class, 'a2zDatabase']);// a2z latter wise search
Route::get('/search', [FrontEndController::class, 'search']);
Route::get('/', [FrontEndController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => Config("authorization.route-prefix"),
    'middleware' => ['web', 'auth']],

    function() {
        Route::group(['middleware' => Config("authorization.middleware")], function() {
            // user role and permission
            Route::resource('roles', 'App\Http\Controllers\Admin\\RolesController');
            Route::resource('users', 'App\Http\Controllers\Admin\\UsersController');
            //service resource
            Route::resource('department', 'App\Http\Controllers\Admin\\DepartmentController');
            Route::resource('author', 'App\Http\Controllers\Admin\\AuthorController');
            Route::resource('publisher', 'App\Http\Controllers\Admin\\PublisherController');
            Route::resource('service-category', 'App\Http\Controllers\Admin\\ServiceCategoryController');
            Route::resource('category', 'App\Http\Controllers\Admin\\CategoryController');
            Route::resource('item-standard-number', 'App\Http\Controllers\Admin\\ItemStandardNumberController');
            Route::resource('item', 'App\Http\Controllers\Admin\\ItemController');
            Route::resource('sister-concern', 'App\Http\Controllers\Admin\\SisterConcernController');
            Route::resource('rating', 'App\Http\Controllers\Admin\\RatingController');
            Route::resource('a2z-type', 'App\Http\Controllers\Admin\\A2zTypeController');
            Route::resource('a2z-vendor', 'App\Http\Controllers\Admin\\A2zVendorController');
            Route::resource('a2z-subject', 'App\Http\Controllers\Admin\\A2zSubjectController');
            Route::resource('a2z-database', 'App\Http\Controllers\Admin\\A2zDatabaseController');
            Route::resource('issue-tracking', 'App\Http\Controllers\Admin\\IssueTrackingController');
            Route::get('audit-logs', 'App\Http\Controllers\Admin\\AuditLogController@index');
            Route::resource('semester', 'App\Http\Controllers\Admin\\SemesterController');
            Route::resource('supervisor', 'App\Http\Controllers\Admin\\SupervisorController');

            //dashboard
            Route::get('dashboard', 'App\Http\Controllers\Admin\\DashboardController@index');
            //service individual method
            Route::post('issue-tracking/feedback', 'App\Http\Controllers\Admin\\IssueTrackingController@feedback');
            Route::post('issue-tracking/assignTo', 'App\Http\Controllers\Admin\\IssueTrackingController@assignTo');
            Route::patch('issue-tracking/rating/{id}', 'App\Http\Controllers\Admin\\IssueTrackingController@rating');
            //user frontend access area
            //reportsdownload-statistics
            Route::get('/report', 'App\Http\Controllers\Admin\\ReportController@index');
            Route::get('/report/upload-statistics', 'App\Http\Controllers\Admin\\ReportController@uploadStatistics');
            Route::post('/report/upload-statistics', 'App\Http\Controllers\Admin\\ReportController@uploadStatistics');
            Route::get('/report/download-statistics', 'App\Http\Controllers\Admin\\ReportController@downloadStatistics');
            Route::post('/report/download-statistics', 'App\Http\Controllers\Admin\\ReportController@downloadStatistics');

            Route::get('/report/download-history', 'App\Http\Controllers\Admin\\ReportController@downloadHistory');
            Route::get('/report/download-history/{id}', 'App\Http\Controllers\Admin\\ReportController@downloadHistoryUser');

            Route::get('/report/highest-download-books/', 'App\Http\Controllers\Admin\\ReportController@highestDownloadBooks');
            Route::get('/report/highest-download-books-with-user-list/{id}', 'App\Http\Controllers\Admin\\ReportController@highestDownloadBooksWithUserList');
//depart wise book count with year wise book list
            Route::get('year-department-book-list/{id}', 'App\Http\Controllers\Admin\\ReportController@yearDepartmentBookList')->name('year-department-book-list');

            //department book list
            Route::get('department-book-list/{id}', 'App\Http\Controllers\Admin\\DepartmentController@departmentBooks')->name('department-book-list');
        });

        Route::get('/', function () {
            return view('home');

        });
    });


Route::post('admin/users/selectedUserService', 'App\Http\Controllers\Admin\\UsersController@selectedUserService');
Route::resource('test', 'App\Http\Controllers\Admin\\TestController');
Route::get('register/verify/{token}', 'App\Http\Controllers\Auth\\RegisterController@verify');
Route::get('register/verifyActive/{token}', 'App\Http\Controllers\Auth\\RegisterController@verifyActive');


//FrontEnd Users with Login


Route::get('/service/{id}', [FrontEndController::class, 'serviceItem']);
Route::get('/category/{id}', [FrontEndController::class, 'departmentItem']);
Route::get('/dept-search', [FrontEndController::class, 'searchDepartment']);
Route::get('/year/{id}', [FrontEndController::class, 'yearItem']);
Route::get('/author/{id}', [FrontEndController::class, 'authorItem']);


Route::get('/feedback/', 'App\Http\Controllers\Member\\HomeController@singleIndex');
Route::get('/feedback/new', [FrontEndController::class, 'feedbackNew']);
Route::get('/profile', 'App\Http\Controllers\Member\\HomeController@profile')->name('admin.profile');
Route::post('profile/avatarUpdate', 'App\Http\Controllers\Member\\HomeController@avatarUpdate')->name('dashboard.user.avatarUpdate');


//download file
Route::get('/{segment1}/{segment2}/{title}', [FrontEndController::class, 'getDetails']);
//////////FrontEnd Users without login
//all single pages in here dynamic way on one method using switch
Route::get('/{id}', [FrontEndController::class, 'index']);

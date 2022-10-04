<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Department;
use App\Models\ItemUser;
use App\Models\Role;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use DB;
use Illuminate\Http\Response;
use PDF;
use function Sodium\compare;

class ReportController extends Controller
{
    protected $items;

    public function __construct(Item $item)
    {
        $this->items = $item;
    }

    public function index(){
        return view('admin.report.index');
    }
    
    
    public function yearDepartmentBookList($department_id){
    $department = Department::with('item')->find($department_id);
    $items = $department->item->groupBy( function ($data){
        return Carbon::parse($data->created_at)->format('Y'); // grouping by years and its month
    });
    dd($items);
}

    
    public function downloadHistory(){
        $users = User::withCount('items')->has('items', '>', 0)->orderBy('items_count', 'desc')->get();

return view('admin.report.download_history',compact('users'));

    }

//view individual download file

    public function downloadHistoryUser($id){

        $items = ItemUser::where('user_id',$id)->get();
        $user = User::withCount('items')->has('items', '>', 0)->where('id',$id)->first();
        return view('admin.report.download_history_user',compact('items','user'));

    }
    public function highestDownloadBooks(){
        $books = Item::withCount('users')->has('users', '>',0)->orderBy('users_count', 'desc')->get();
        return view('admin.report.highest_download_books',compact('books'));
    }
    public function highestDownloadBooksWithUserList($id){
        $users = ItemUser::where('item_id',$id)->get();
        $item = Item::withCount('users')->has('users', '>', 0)->where('id',$id)->first();
        return view('admin.report.highest_download_books_with_user_list',compact('item','users'));
    }
    public function uploadStatistics(Request $request, $items=null){
        $dateSelect = $request->input('date_select');
        $roles  = Role::find(4);
        $users = $roles->user->pluck('displayName','id');
        $userWise = $request->input('userWise');
        if (isset($dateSelect) and $items==null){
            //dd($dateSelect);
            $inputDate = $request->input('date_select');
            $dateRange = (explode("-",$inputDate));
            $dt1 = $dateRange[0];
            $dt1 = date("Y-m-d", strtotime($dt1));
            $dt2 = $dateRange[1];
            $dt2 = date("Y-m-d", strtotime($dt2));
            $diff=date_diff(date_create($dt1),date_create($dt2));
            $diff=$diff->format("%R%a");

            if ($userWise=="on"){
                $request->validate([
                    'user_id' => 'required',
                ]);
                if ($diff>0){
                    $user_id = $request->input('user_id');
                    if($request->input('btnResult')=='PDF-Download'){
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->where('user_id',$user_id)->get();
                        $pdf = PDF::loadView('admin.report.upload_statistics_pdf_single',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->where('user_id',$user_id)->get();
                        $fileName = $this->uploadWordDownload($items);
                        return response()->download(public_path('assets/report/uploads/'.$fileName.'.docx'));
                    }elseif($request->input('btnResult')=='resultView'){
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->where('user_id',$user_id)->get();
                        return view('admin.report.upload_statistics_single',compact('items','users','dateSelect'));
                    }
                }
                else{
                    $user_id = $request->input('user_id');
                    if($request->input('btnResult')=='PDF-Download'){
                        $items = Item::where('user_id',$user_id)->whereDate('created_at', [$dt1, $dt2])->get();
                        $pdf = PDF::loadView('admin.report.upload_statistics_pdf_single',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $items = Item::where('user_id',$user_id)->whereDate('created_at', [$dt1, $dt2])->get();
                        $fileName = $this->uploadWordDownload($items);
                        return response()->download(public_path('assets/report/uploads/'.$fileName.'.docx'));
                    }elseif($request->input('btnResult')=='resultView'){
                        $items = Item::where('user_id',$user_id)->whereDate('created_at', [$dt1, $dt2])->get();
                        return view('admin.report.upload_statistics_single',compact('items','users','dateSelect'));
                    }
                }
            }else{
                if ($diff>0){
                    if($request->input('btnResult')=='PDF-Download'){
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->get();
                        view()->share('items',$items);
                        $pdf = PDF::loadView('admin.report.upload_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->get();
                        $fileName = $this->uploadWordDownload($items);
                        return response()->download(public_path('assets/report/uploads/'.$fileName.'.docx'));
                    }
                    elseif($request->input('btnResult')=='resultView'){
                        // dd("$dt1=$dt2");
                        $items = Item::whereBetween('created_at', [$dt1, $dt2])->get();
                        //$items = Item::whereBetween('created_at', ['2018-06-01','2018-12-25'])->get();

                        return view('admin.report.upload_statistics',compact('items','users'));
                    }
                }
                else{
                    if($request->input('btnResult')=='PDF-Download'){
                        $items = Item::whereDate('created_at', [$dt1, $dt2])->get();
                        $pdf = PDF::loadView('admin.report.upload_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $items = Item::whereDate('created_at', [$dt1, $dt2])->get();
                        $fileName = $this->uploadWordDownload($items);
                        return response()->download(public_path('assets/report/uploads/'.$fileName.'.docx'));
                    }
                    elseif($request->input('btnResult')=='resultView'){
                        $items = Item::whereDate('created_at', [$dt1, $dt2])->get();
                        return view('admin.report.upload_statistics',compact('items','users'));
                    }

                }
            }
        }else{
            if ($items==null){
                $items = Item::where('isPublished',1)->orderBy('id', 'ASC')->get()->take(100);
                return view('admin.report.upload_statistics',compact('items','users'));
            }else{
                return view('admin.report.upload_statistics',compact('items','users'));
            }
        }
    }

    public function downloadStatistics(Request $request, $items=null){
        $dateSelect = $request->input('date_select');
        $users = User::pluck('displayName','id');
        $userWise = $request->input('userWise');
        if (isset($dateSelect) and $items==null){
            $inputDate = $request->input('date_select');
            $dateRange = (explode("-",$inputDate));
            $dt1 = $dateRange[0];
            $dt1 = date("Y-m-d", strtotime($dt1));
            $dt2 = $dateRange[1];
            $dt2 = date("Y-m-d", strtotime($dt2));
            $diff=date_diff(date_create($dt1),date_create($dt2));
            $diff=$diff->format("%R%a");
            if ($userWise=="on"){
                $request->validate([
                    'user_id' => 'required',
                ]);
                if ($diff>0){
                    $user_id = $request->input('user_id');
                    if($request->input('btnResult')=='PDF-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $pdf = PDF::loadView('admin.report.download_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $fileName = $this->downloadWordDownload($items);
                        return response()->download(public_path('assets/report/downloads/'.$fileName.'.docx'));
                    }elseif($request->input('btnResult')=='resultView'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $data = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        return view('admin.report.download_statistics',compact('items','users','data'));
                    }
                }
                else{
                    $user_id = $request->input('user_id');
                    if($request->input('btnResult')=='PDF-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $pdf = PDF::loadView('admin.report.download_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');

                    }elseif($request->input('btnResult')=='Word-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $fileName = $this->downloadWordDownload($items);
                        return response()->download(public_path('assets/report/downloads/'.$fileName.'.docx'));

                    }elseif($request->input('btnResult')=='resultView'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $data = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        return view('admin.report.download_statistics',compact('items','users','data'));

                    }
                }
            }else{
                if ($diff>0){
                    $user_id=null;
                    if($request->input('btnResult')=='PDF-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $pdf = PDF::loadView('admin.report.download_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $fileName = $this->downloadWordDownload($items);
                        return response()->download(public_path('assets/report/downloads/'.$fileName.'.docx'));
                    }
                    elseif($request->input('btnResult')=='resultView'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $data = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        return view('admin.report.download_statistics',compact('items','users','data'));
                    }
                }
                else{
                    $diff=null;
                    $user_id=null;
                    if($request->input('btnResult')=='PDF-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $pdf = PDF::loadView('admin.report.download_statistics_pdf',compact('items','dateSelect'));
                        $pdf->setPaper('A4', 'landscape');
                        return $pdf->download($dateSelect.'.pdf');
                    }elseif($request->input('btnResult')=='Word-Download'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $items = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        $fileName = $this->downloadWordDownload($items);
                        return response()->download(public_path('assets/report/downloads/'.$fileName.'.docx'));
                    }
                    elseif($request->input('btnResult')=='resultView'){
                        $categories = Category::orderBy('id', 'ASC')->get();
                        $data = $this->downloadItem($categories,$dt1,$dt2,$diff,$user_id);
                        return view('admin.report.download_statistics',compact('items','users','data'));
                    }

                }
            }
        }else{
            if ($items==null){
                $categories = Category::orderBy('id', 'ASC')->get();
                $data = $this->downloadItem($categories,$dt1=null,$dt2=null,$diff=null,$user_id=null);
                return view('admin.report.download_statistics',compact('items','users','data'));
            }else{
                return view('admin.report.download_statistics',compact('items','users'));
            }
        }
    }

    public function downloadItem($categories,$dt1,$dt2,$diff,$user_id){
        $data = array();
        foreach($categories as $category){
            $count = 0;
            $download = 0;
            $items = Item::where('category_id',$category->id)->get();
            foreach ($items as $item){
                if ($user_id!=null){
                    $user = User::where('email',$user_id)->first();
                    $userID = $user->id;
                    if ($diff!=null){
                        $download += ItemUser::whereBetween('created_at',[$dt1, $dt2])->where('item_id',$item->id)->where('user_id',$userID)->count();
                    }else{
                        $download += ItemUser::whereDate('created_at',$dt1)->where('item_id',$item->id)->where('user_id',$userID)->count();
                    }
                    $count += $download;
                    $download=0;
                }else{
                    if ($diff!=null){
                        $download += ItemUser::whereBetween('created_at',[$dt1, $dt2])->where('item_id',$item->id)->count();
                    }elseif ($diff==null){
                        $download += ItemUser::where('item_id',$item->id)->whereDate('created_at',$dt1)->count();
                    }else{
                        $download += ItemUser::where('item_id',$item->id)->count();
                    }
                    $count += $download;
                    $download=0;
                }
            }
            array_push($data, $category->itemCategory."($count)");
        }
        return $data;
    }


    public function uploadWordDownload($data){


        $date_fileName=time();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(
            array('marginLeft' => 800, 'marginRight' => 800,
                'marginTop' => 600, 'marginBottom' => 600)
        );
        $diuStyle = array('bold' => true,'size'=>18,'align' => 'center');
        $section->addImage( 'assets/image/library_logo.png', array('width' => 230,'align' => 'center' ) );
        $section->addText( 'Daffodil International University',$diuStyle);
        $section->addText( date('d-m-Y'),array('size' => 14,'align' => 'center'));
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 1, 'borderColor' => 'd2d2d2', 'cellMargin' => 25, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $fancyTableFirstRowStyle = array('bgColor' => 'DDDDDD');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow();
        $table->addCell(750, $fancyTableCellStyle)->addText('Sl.No.', $fancyTableFontStyle);
        $table->addCell(3000, $fancyTableCellStyle)->addText('Title', $fancyTableFontStyle);
        $table->addCell(3000, $fancyTableCellStyle)->addText('Author', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('Edition', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Service Name', $fancyTableFontStyle);
        $table->addCell(1500, $fancyTableCellStyle)->addText('Library Personal', $fancyTableFontStyle);
        $i=0;
        foreach ($data as $item)
        {
            $j=1;
            $authorList="";
            foreach($item->author as $author){
                $authorList.=$j.' '.$author->authorName.(sizeof($item->author)>=$j?", ":'');
                $j++;
            }
            $j=1;
            $i++;
            $table->addRow();
            $table->addCell(750)->addText($i);
            $table->addCell(3000)->addText($item->title);
            $table->addCell(3000)->addText($authorList);
            $table->addCell(1000)->addText( $item->edition);
            $table->addCell(2000)->addText($item->category->itemCategory);
            $table->addCell(1500)->addText($item->user->displayName);
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('assets/report/uploads/'.$date_fileName.'.docx');
        return $date_fileName;
        //return response()->download(public_path('assets/report/Jamela.docx'));
    }

    public function downloadWordDownload($data){
        $date_fileName=time();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(
            array('marginLeft' => 800, 'marginRight' => 800,
                'marginTop' => 600, 'marginBottom' => 600)
        );
        $diuStyle = array('bold' => true,'size'=>18,'align' => 'center');
        $section->addImage( 'assets/image/library_logo.png', array('width' => 230,'align' => 'center' ) );
        $section->addText( 'Daffodil International University',$diuStyle);
        $section->addText( date('d-m-Y'),array('size' => 14,'align' => 'center'));
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 1, 'borderColor' => 'd2d2d2', 'cellMargin' => 25, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $fancyTableFirstRowStyle = array('bgColor' => 'DDDDDD');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow();
        $table->addCell(750, $fancyTableCellStyle)->addText('Sl.No.', $fancyTableFontStyle);
        $table->addCell(9000, $fancyTableCellStyle)->addText('Service', $fancyTableFontStyle);
        $i=0;
        foreach ($data as $item)
        {
            $i++;
            $table->addRow();
            $table->addCell(750)->addText($i);
            $table->addCell(9000)->addText($item);
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('assets/report/downloads/'.$date_fileName.'.docx');
        return $date_fileName;
        //return response()->download(public_path('assets/report/Jamela.docx'));
    }


}

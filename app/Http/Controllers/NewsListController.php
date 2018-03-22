<?php

namespace App\Http\Controllers;

use Excel;
use Session;
use Auth;
use App\News;
use Validator;
use \Carbon\Carbon;
use Illuminate\Http\Request;

class NewsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.news_list')->with('news', News::all());
    }

    public function filter(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'condition'     => 'required' 
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('news_list#filterModal_sponsors')
                            ->withErrors($validator)
                            ->withInput();
        }

        $from = $to = null;
        
        if($request->start_at) {
            $from = date("Y-m-d 00:00:00", strtotime($request->start_date) );
            $to = null;
        }
        if($request->end_at) {
            $from = null;
            $to   = date("Y-m-d 23:59:59", strtotime($request->end_date) ); 
        }

        if($from && $to) {
            $filter = News::whereBetween('created_at', [$from, $to]);
        } else if ($from && !$to) {
            $filter = News::where('created_at', '>=', $from);
        } else if (!$from && $to) {
            $filter = News::where('created_at', '<=', $to);
        } else {
            $filter = News::where('created_at', '!=', null);
        }

        // dd([$from, $to]);

        switch($request->condition) {
            case "1":
                $filter = $filter->get();
                break;
            case "2":
                $filter = $filter->where('is_active', '!=', 0)->get();
                break;
            case "3":
                $filter = $filter->where('is_active', 0)->get();
                break;
            default:
                break;
        }
                    
        return view('news.news_list')->with('news', $filter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.news_list_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->newsImg);
        $this->validate($request, [
            'newsName'  => 'required',
            'newsImg'  => 'image|mimes:jpeg,jpg,png',
            'newsContent'   => 'required'
        ]);
        

        // if news is activated then set published_at to current date time
        if($request->activate != 0) {  
            $published_at = Carbon::now();
            $published_at->toDateTimeString();
        } else {
            $published_at = null;
        }

        // upload image to storage/app/public
        if($request->newsImg) {
            $img = $request->newsImg;
            $newImg = time().$img->getClientOriginalName(); // current time + original image name
            $img->move('storage/app/public', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
        }

        $current_user = 'Admin-Test';
        // $current_user = Auth::user()->name; // Get current username 

        News::create([
            'name'  => $request->newsName,
            'body'  => $request->newsContent,
            'photo' => $imgPath,
            'is_active' => $request->activate,
            'published_at' => $published_at,
            'created_by'   => $current_user,
            'modified_by'  => $current_user,
        ]);

        return redirect('news_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('news.news_list_show')->with('news', News::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('news.news_list_edit')->with('news', News::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // dd($request->newsImg);
         $this->validate($request, [
            'newsName'  => 'required',
            'newsImg'  => 'image|mimes:jpeg,jpg,png',
            'activate'  => 'required',
            'newsContent'   => 'required'
        ]);
        
        $news = News::find($id);

        // if news is activated then set published_at to current date time
        if($request->activate != 0) {  
            $published_at = Carbon::now();
            $published_at->toDateTimeString();
        } else {
            $published_at = null;
        }

        // upload image to storage/app/public
        if($request->newsImg) {
            $img = $request->newsImg;
            $newImg = time().$img->getClientOriginalName();
            $img->move('storage/app/public', $newImg);
            $imgPath = 'storage/app/public/'.$newImg;
        } else {
            if($news->photo) {
                $imgPath = $news->photo;
            } else {
                $imgPath = null;
            }
        }

        $current_user = 'Ahmed Yacoub';
        // $current_user = Auth::user()->name; // Get current username 

        $news->name  = $request->newsName;
        $news->body  = $request->newsContent;
        $news->photo = $imgPath;
        $news->is_active = $request->activate;
        $news->published_at = $published_at;
        $news->created_by   = $current_user;
        $news->modified_by  = $current_user;
        $news->save();

        return redirect('news_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $news = News::find($id);        // find this news
        $image_path = $news->photo;     // image path

        // check if image exists then delete it
        unlink(public_path($image_path));
        
        // delete this record
        $news->delete();

        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    /**
     * Delete selected rows
     */
    public function destroySelected(Request $request) 
    {
        // get cities IDs from AJAX
        $ids = $request->ids;

        // transform $ids into array values then search and delete
        News::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $data = array(['عنوان الخبر', 'مضمون الخبر', 'كتب بواسطة', 'تم تعديله بواسطة']);
        $ids = explode(",", $request->ids);
        // $data = Geo_Cities::whereIn('id', explode(",", $ids))->get();

        foreach($ids as $id) {
            $d =  News::find($id);
            array_push( $data, [$d->name, strip_tags($d->body), $d->created_by, $d->modified_by]);
        }

        $myFile = Excel::create('الاخبار', function($excel) use ($data) {
            $excel->setTitle('الاخبار');
            // Chain the setters
            $excel->setCreator('جسر الامان')
            ->setCompany('جسر الامان');
            // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول الاخبار');

            $excel->sheet('الاخبار', function($sheet) use ($data) {
                $sheet->setRightToLeft(true);
                $sheet->getStyle('A1:B1')->getFont()->setBold(true);
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        });

        $myFile = $myFile->string('xlsx');
        $response = array(
            'name' => 'الاخبار'.date('Y_m_d'),
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );

        return response()->json($response);
    }
}

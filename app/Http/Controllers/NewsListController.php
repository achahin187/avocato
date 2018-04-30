<?php

namespace App\Http\Controllers;

use File;
use Exception;
use Auth;
use Excel;
use Session;
use App\News;
use Validator;
use \Carbon\Carbon;
use App\Exports\NewsExport;
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
        // check if start date is less than end date
        Validator::extend('before_or_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($validator->getData()[$parameters[0]]) >= strtotime($value);
        });

        if( $request->start_date && !$request->end_date) {
            $rules =  [
                'condition'     => 'required' 
            ];
        } else if($request->start_date ) {
            $rules =  [
                'start_date'   => 'before_or_equal:end_date',
                'end_date'     => '',
                'condition'     => 'required' ];
        } else {
            $rules =  [
                'condition'     => 'required' 
            ];
        }

        $validator =  Validator::make($request->all(), $rules, [
            'start_date.before_or_equal'    => 'حقل تاريخ البداية يجب ان يكون اصغر من او يساوي حقل تاريخ النهاية'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('news_list#filterModal_sponsors')
                            ->withErrors($validator)
                            ->withInput();
        }

        $from = $to = null;
        
        if($request->start_date) {
            $from = date("Y-m-d 00:00:00", strtotime($request->start_date) );
        }
        if($request->end_date) {
            $to   = date("Y-m-d 23:59:59", strtotime($request->end_date) ); 
        }

        if($from && $to) {
            $filter = News::whereBetween('published_at', [$from, $to]);
        } else if ($from && !$to) {
            $filter = News::where('published_at', '>=', $from);
        } else if (!$from && $to) {
            $filter = News::where('published_at', '<=', $to);
        } else {
            $filter = News::where('published_at', '!=', null);
        }


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
            $img->move('storage/app/public/news', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/news/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
        }

        // check is active
        if($request->activate) {
            $activate = 1;
        } else {
            $activate = 0;
        }

        $current_user = Auth::user()->id;

        try {
            $news = new News;
            $news->name  = $request->newsName;
            $news->body  = $request->newsContent;
            $news->photo = $imgPath;
            $news->is_active = $activate;
            $news->published_at = $published_at;
            $news->created_by   = $current_user;
            $news->updated_by  = $current_user;
            $news->save();
        } catch(Exception $ex) {
            $news->forcedelete();
            dd($ex);
            Session::flash('warning', 'حدث خطأ ما عند ادخال الخبر');
            return redirect()->back()->withInput();
        }

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

        // check is active
        if($request->activate == 1) {
            $activate = 1;
        } else {
            $activate = 0;
        }

        $current_user = Auth::user()->id;

        try {
        $news->name  = $request->newsName;
        $news->body  = $request->newsContent;
        $news->photo = $imgPath;
        $news->is_active = $activate;
        $news->published_at = $published_at;
        $news->created_by   = $current_user;
        $news->updated_by  = $current_user;
        $news->save();
        } catch(Exception $ex) {
            Session::flash('warning', 'حدث خطأ ما عند تعديل الخبر');
            return redirect()->back()->withInput();
        }

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
        if ( File::exists(public_path($image_path)) ) {
            File::delete(public_path($image_path));
        }
        
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
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'News'.time().'.xlsx';

        if(isset($request->ids)){
            $ids = explode(",", $request->ids);

            Excel::store(new NewsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new NewsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }
}

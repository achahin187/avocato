<?php

namespace App\Http\Controllers;

use Helper;
use File;
use Exception;
use Auth;
use Excel;
use Session;
use App\News;
use App\Languages;
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
        // if(session('country') == null)
        // {
        //     return redirect()->route('choose.country');
        // }
          $data['news'] = News::where('country_id',session('country'))->paginate(10);
          $data['languages'] = Languages::all();
          
        // return view('news.news_list')->with('news', News::where('country_id',session('country'))->get())->with('languages', $languages);
        return view('news.news_list')->with($data);
    }

    public function filter(Request $request)
    {
        // check if start date is less than end date
        Validator::extend('before_or_equal', function ($attribute, $value, $parameters, $validator) {
            return strtotime($validator->getData()[$parameters[0]]) >= strtotime($value);
        });

        if ($request->start_date && !$request->end_date) {
            $rules = [
                'condition' => 'required'
            ];
        } else if ($request->start_date) {
            $rules = [
                'start_date' => 'before_or_equal:end_date',
                'end_date' => '',
                'condition' => 'required'
            ];
        } else {
            $rules = [
                'condition' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $rules, [
            'start_date.before_or_equal' => 'حقل تاريخ البداية يجب ان يكون اصغر من او يساوي حقل تاريخ النهاية'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('news_list#filterModal_sponsors')
                ->withErrors($validator)
                ->withInput();
        }

        $filter = new News;

        if ($request->start_date && $request->end_date) {
            $from = Helper::checkDate($request->start_date, 1);
            $to = Helper::checkDate($request->end_date, 2);

            // check on start and end dates
            if ($from && $to) {
                $filter = $filter->whereBetween('published_at', [$from, $to]);
            }
        }
        if ($request->filled('language')) {
           $filter =  $filter->where('lang_id', '=', $request->language);
               }


        switch ($request->condition) {
            case "1":
                $filter = $filter->paginate(10);
                break;
            case "2":
                $filter = $filter->where('is_active', 1)->paginate(10);
                break;
            case "3":
                $filter = $filter->where('is_active', 0)->paginate(10);
                break;
            default:
                break;
        }
         $languages = Languages::all();

        return view('news.news_list')->with('news', $filter)->with('languages', $languages);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['languages'] = Languages::all();
        return view('news.news_list_create',$data);
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
            'newsName' => 'required',
            'newsImg' => 'image|mimes:jpeg,jpg,png',
            'newsContent' => 'required',
            'language' => 'required',
        ]);
        

        // if news is activated then set published_at to current date time
        if ($request->activate != 0) {
            $published_at = Carbon::now();
            $published_at->toDateTimeString();
        } else {
            $published_at = null;
        }
        $news = new News;

        // upload image to storage/app/public
        if ($request->newsImg) {
            $img = $request->newsImg;
            $news->photo_name = $img->getClientOriginalName();
            $news->extension = $img->getClientOriginalExtension();
            $newImg = time(). rand(111, 999).'.'.$img->getClientOriginalExtension(); // current time + original image name
            $img->move('storage/app/public/news', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/news/' . $newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
        }

        // check is active
        if ($request->activate) {
            $activate = 1;
        } else {
            $activate = 0;
        }

        $current_user = Auth::user()->id;

        try {
            
            $news->name = $request->newsName;
            $news->body = $request->newsContent;
            $news->photo = $imgPath;
            $news->is_active = $activate;
            $news->published_at = $published_at;
            $news->created_by = $current_user;
            $news->updated_by = $current_user;
            $news->lang_id = $request->language;
            $news->country_id=session('country');
            $news->save();
        } catch (Exception $ex) {
            $news->forcedelete();
            
            Session::flash('warning', 'حدث خطأ ما عند ادخال الخبر');
            return redirect()->back()->withInput();
        }

        Helper::add_log(3, 18, $news->id);
        return redirect('news_list_show' . '/' . $news->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        // redirect to home page if user is not found
        if( $news == NULL ) {
            Session::flash('warning', 'الخبر غير موجود');
            return redirect('/news_list');
        }

        return view('news.news_list_show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        // redirect to home page if user is not found
        if( $news == NULL ) {
            Session::flash('warning', 'الخبر غير موجود');
            return redirect('/news_list');
        }
        $data['languages'] = Languages::all();
        return view('news.news_list_edit',$data)->with('news', $news);
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
            'newsName' => 'required',
            'newsImg' => 'image|mimes:jpeg,jpg,png',
            'newsContent' => 'required',
            // 'language' => 'required',
        ]);

        $news = News::find($id);

        // if news is activated then set published_at to current date time
        if ($request->activate != 0) {
            $published_at = Carbon::now();
            $published_at->toDateTimeString();
        } else {
            $published_at = null;
        }

        // upload image to storage/app/public
        if ($request->newsImg) {
            $img = $request->newsImg;
            $news->photo_name = $img->getClientOriginalName();
            $news->extension = $img->getClientOriginalExtension();
            $newImg = time(). rand(111, 999).'.'.$img->getClientOriginalExtension();
            $img->move('storage/app/public', $newImg);
            $imgPath = 'storage/app/public/' . $newImg;
        } else {
            if ($news->photo) {
                $imgPath = $news->photo;
            } else {
                $imgPath = null;
            }
        }

        // check is active
        if ($request->activate == 1) {
            $activate = 1;
        } else {
            $activate = 0;
        }

        $current_user = Auth::user()->id;

        try {
            $news->name = $request->newsName;
            $news->body = $request->newsContent;
            $news->photo = $imgPath;
            $news->is_active = $activate;
           // $news->lang_id = $news->lang_id;
            $news->published_at = $published_at;
            $news->created_by = $current_user;
            $news->updated_by = $current_user;
            $news->save();
        } catch (Exception $ex) {
            Session::flash('warning', 'حدث خطأ ما عند تعديل الخبر');
            return redirect()->back()->withInput();
        }

        Helper::add_log(4, 18, $news->id);
        return redirect('news_list_show' . '/' . $news->id);
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
        if($news->photo) {
            $image_path = $news->photo;     // image path
            // check if image exists then delete it
            if (File::exists(public_path($image_path)) && $image_path != NULL) {
                File::delete(public_path($image_path));
            }
        }


        Helper::add_log(5, 18, $news->id);

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
        $ids = explode(",", $request->ids);

        foreach($ids as $id) {
            Helper::add_log(5, 18, $id);

            $news = News::find($id);        // find this news
            if($news->photo) {
                $image_path = $news->photo;     // image path

                // check if image exists then delete it
                if (File::exists(public_path($image_path)) && $image_path != NULL) {
                    File::delete(public_path($image_path));
                }
            }

            // delete this record
            $news->delete();
        }

        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'News' . time() . '.xlsx';

        if (isset($request->ids) && $request->ids != null) {
            $ids = explode(",", $request->ids);

            Excel::store(new NewsExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new NewsExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }

        return response()->json($response);
    }

    public function rename_files()
    {
        $all = News::all();
        foreach($all as $key => $news)
        {
            if($news->photo != null)
            {
                $extension = substr($news->photo, strpos($news->photo, ".") + 1);
            // dd($extension);
            $file = $news->file;

            $destinationPath = 'storage/app/public';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999).'.'.$extension;
            // try{
                rename(public_path($news->photo), public_path($fileNameToStore));
                $all[$key]['photo'] = $fileNameToStore;
                $all[$key]['extension'] = $extension;
            // }
            // catch(\exception $extension)
            // {
            //     $all[$key]['photo'] = $file;
            // }
            
            // $all[$key]->update([
            //     'file' => $fileNameToStore
            // ]);
            
            
            $all[$key]->save();

            }
            
            // Storage::move('hodor/file1.jpg', 'holdthedoor/file2.jpg');

        }
        
    }
}

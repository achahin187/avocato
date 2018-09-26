<?php

namespace App\Http\Controllers;

use Session;
use App\Fixed_Pages;
use App\Languages;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }


         $clients =  Fixed_Pages::where('country_id',session('country'));

         $clients = $clients->where(function($query)  {
          $query->where('page_name','aboutus')
         ->orWhere('page_name','vision')
         ->orWhere('page_name','mission');
          });

   
         $data['about'] = $clients->get();
         return view('about',$data);

        // return view('about')->with('about', Fixed_Pages::where('page_name','aboutus')->orWhere('page_name','vision')
        //     ->orWhere('page_name','mission')->where('country_id',session('country'))->get());
    }



     public function terms_conditions()
    {
          if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }
        return view('terms')->with('terms', Fixed_Pages::where('page_name','terms')->where('country_id',session('country'))->first());
    }


    public function privacy()
    {
          if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }
        return view('privacy')->with('terms', Fixed_Pages::where('page_name','privacy')->where('country_id',session('country'))->first());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data['about']= Fixed_Pages::where('page_name','aboutus')->where('country_id',session('country'))->first();
        $data['vision']= Fixed_Pages::where('page_name','vision')->where('country_id',session('country'))->first();
        $data['mission']= Fixed_Pages::where('page_name','mission')->where('country_id',session('country'))->first();
        $data['languages']= Languages::all();
        return view('about_edit',$data);
    }

    public function terms_edit()
    {
        $data['terms']= Fixed_Pages::where('page_name','terms')->where('country_id',session('country'))->first();
        $data['languages']= Languages::all();
        return view('terms_edit',$data);
    }


        public function privacy_edit()
    {
        $data['privacy']= Fixed_Pages::where('page_name','privacy')->where('country_id',session('country'))->first();
        $data['languages']= Languages::all();
        return view('privacy_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 

    //**** Note still need to add localization (arabic or french) to mission and vission
        // edit info
        if(isset($request->about)){
        $about_edit = Fixed_Pages::where('page_name','aboutus')->where('country_id',session('country'))->first();
           //  dd($about_edit);
         
        if($about_edit == null) {
             if ($request->lang_about == 1) {
        Helper::add_localization('fixed_pages', 'content', $about_edit->id, $request->about, 1);
        }else{
            Fixed_Pages::create([
                'name' => 'About us',
                'content' => $request->about
            ]);

            }

        } else {
         if ($request->lang_about == 1) {

              try {
            Helper::edit_entity_localization('fixed_pages', 'content',$about_edit->id, $request->about,1);
        } catch (\Exception $ex) {
             Helper::remove_localization('fixed_pages', 'content', $about_edit->id, 1);
             Helper::add_localization('fixed_pages', 'content', $about_edit->id, $request->about, 1);

        }
         }else{
            $about_edit->update(['name' => 'About us', 'content' => $request->about]);
        }

        }
       }

       //vision

        if(isset($request->vision)){
        $vision_edit = Fixed_Pages::where('page_name','vision')->where('country_id',session('country'))->first();
           //  dd($about_edit);
        if($vision_edit == null) {
            Fixed_Pages::create([
                'name' => 'vision',
                'content' => $request->vision
            ]);
        } else {
            $vision_edit->update(['name' => 'vision', 'content' => $request->vision]);
        }
       }


        //mission

        if(isset($request->mission)){
        $mission_edit = Fixed_Pages::where('page_name','mission')->where('country_id',session('country'))->first();
           //  dd($about_edit);
        if($mission_edit == null) {
            Fixed_Pages::create([
                'name' => 'Mission',
                'content' => $request->mission
            ]);
        } else {
            $mission_edit->update(['name' => 'mission', 'content' => $request->mission]);
        }
       }
        // redirect back
        return redirect('about');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

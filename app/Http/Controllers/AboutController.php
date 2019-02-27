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
    public function index() {
        $data['about'] = Fixed_Pages::whereIn('page_name', array('aboutus', 'mission', 'vision'))->get();
         return view('about',$data);
    }
    
    public function terms_conditions() {
        return view('terms')->with('terms', Fixed_Pages::where('page_name','terms')->first());
    }


    public function privacy()
    {
        return view('privacy')->with('terms', Fixed_Pages::where('page_name','privacy')->first());
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
        $data['about']= Fixed_Pages::where('page_name','aboutus')->first();
        $data['vision']= Fixed_Pages::where('page_name','vision')->first();
        $data['mission']= Fixed_Pages::where('page_name','mission')->first();
        $data['languages']= Languages::all();
        return view('about_edit',$data);
    }

    public function aboutUsAjax($lang_id)
    {
        if($lang_id==2)
        {
            
        $en = Fixed_Pages::where('page_name','aboutus')->first()['content'];
        return $en;
        }
        else{
        $other_lang = Helper::localizations('fixed_pages','content',1,$lang_id);  
        return $other_lang;  
        }
    }

        public function visionAjax($lang_id)
    {
        if($lang_id==2)
        {
            
        $en = Fixed_Pages::where('page_name','vision')->first()['content'];
        return $en;
        }
        else{
        $other_lang = Helper::localizations('fixed_pages','content',3,$lang_id);  
        return $other_lang;  
        }
    }

        public function missionAjax($lang_id)
    {
        if($lang_id==2)
        {
            
        $en = Fixed_Pages::where('page_name','mission')->first()['content'];
        return $en;
        }
        else{
        $other_lang = Helper::localizations('fixed_pages','content',2,$lang_id);  
        return $other_lang;  
        }
    }

        public function termsAjax($lang_id)
    {
        if($lang_id==2)
        {
            
        $en = Fixed_Pages::where('page_name','terms')->first()['content'];
        return $en;
        }
        else{
        $other_lang = Helper::localizations('fixed_pages','content',4,$lang_id);  
        return $other_lang;  
        }
    }

        public function privacyAjax($lang_id)
    {
        if($lang_id==2)
        {
            
        $en = Fixed_Pages::where('page_name','privacy')->first()['content'];
        return $en;
        }
        else{
        $other_lang = Helper::localizations('fixed_pages','content',5,$lang_id);  
        return $other_lang;  
        }
    }


    public function terms_edit()
    {
        $data['terms']= Fixed_Pages::where('page_name','terms')->first();
        $data['languages']= Languages::all();
        return view('terms_edit',$data);
    }


        public function privacy_edit()
    {
        $data['privacy']= Fixed_Pages::where('page_name','privacy')->first();
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
        $about_edit = Fixed_Pages::where('page_name','aboutus')->first();
           //  dd($about_edit);    
        if($about_edit == null) {
             if ($request->lang_about == 2) {
       
            Fixed_Pages::create([
                'name' => 'About us',
                'content' => $request->about
            ]);
        }else{
    Helper::add_localization('fixed_pages', 'content', $about_edit->id, $request->about, $request->lang_about);
            }

        } else {
         if ($request->lang_about == 2) {

               $about_edit->update(['name' => 'About us', 'content' => $request->about]);
         }else{
    
            Helper::edit_entity_localization('fixed_pages', 'content',$about_edit->id, $request->lang_about,$request->about);

        }

        }
       }

       //vision
        if(isset($request->vision)){
        $vision_edit = Fixed_Pages::where('page_name','vision')->first();
           //  dd($about_edit);
        if($vision_edit == null) {
             if ($request->lang_vision == 2) {
       
            Fixed_Pages::create([
                'name' => 'Vision',
                'content' => $request->vision
            ]);
        }else{
    Helper::add_localization('fixed_pages', 'content', $vision_edit->id, $request->vision, $request->lang_vision);
            }

        } else {
         if ($request->lang_vision == 2) {

               $vision_edit->update(['name' => 'Vision', 'content' => $request->vision]);
         }else{
            // Helper::edit_entity_localization('fixed_pages', 'content',$vision_edit->id, $request->lang_vision,$request->vision);
            Helper::remove_localization('fixed_pages', 'content',$vision_edit->id, $request->lang_vision);
            Helper::add_localization('fixed_pages', 'content', $vision_edit->id, $request->vision, $request->lang_vision);

        }

        }
       }

        if(isset($request->mission)){
        $mission_edit = Fixed_Pages::where('page_name','mission')->first();
           //  dd($about_edit);
        if($mission_edit == null) {
             if ($request->lang_mission == 2) {
       
            Fixed_Pages::create([
                'name' => 'Mission',
                'content' => $request->mission
            ]);
        }else{
    Helper::add_localization('fixed_pages', 'content', $mission_edit->id, $request->mission, $request->lang_mission);
            }

        } else {
         if ($request->lang_mission == 2) {

               $mission_edit->update(['name' => 'Mission', 'content' => $request->mission]);
         }else{
            // Helper::edit_entity_localization('fixed_pages', 'content',$vision_edit->id, $request->lang_vision,$request->vision);
            Helper::remove_localization('fixed_pages', 'content',$mission_edit->id, $request->lang_mission);
            Helper::add_localization('fixed_pages', 'content', $mission_edit->id, $request->mission, $request->lang_mission);

        }

        }
       }

        return redirect('about');
    }


      public function terms_update(Request $request)
    { 

                if(isset($request->terms)){
        $terms_edit = Fixed_Pages::where('page_name','terms')->first();
           //  dd($about_edit);
        if($terms_edit == null) {
             if ($request->lang_terms == 2) {
       
            Fixed_Pages::create([
                'name' => 'Terms and Conditions',
                'content' => $request->terms
            ]);
        }else{
    Helper::add_localization('fixed_pages', 'content', $terms_edit->id, $request->terms, $request->lang_terms);
            }

        } else {
         if ($request->lang_terms == 2) {

               $terms_edit->update(['name' => 'Terms and Conditions', 'content' => $request->terms]);
         }else{
            // Helper::edit_entity_localization('fixed_pages', 'content',$vision_edit->id, $request->lang_vision,$request->vision);
            Helper::remove_localization('fixed_pages', 'content',$terms_edit->id, $request->lang_terms);
            Helper::add_localization('fixed_pages', 'content', $terms_edit->id, $request->terms, $request->lang_terms);

        }

        }
       }

         return redirect('terms_conditions');
    }

   
     public function privacy_update(Request $request)
    { 
        //privacy update
           if(isset($request->privacy)){
        $privacy_edit = Fixed_Pages::where('page_name','privacy')->first();
           //  dd($about_edit);
        if($privacy_edit == null) {
             if ($request->lang_privacy == 2) {
       
            Fixed_Pages::create([
                'name' => 'Privacy And Policy',
                'content' => $request->privacy
            ]);
        }else{
    Helper::add_localization('fixed_pages', 'content', $privacy_edit->id, $request->privacy, $request->lang_privacy);
            }

        } else {
         if ($request->lang_privacy == 2) {

               $privacy_edit->update(['name' => 'Privacy And Policy', 'content' => $request->privacy]);
         }else{
            // Helper::edit_entity_localization('fixed_pages', 'content',$vision_edit->id, $request->lang_vision,$request->vision);
            Helper::remove_localization('fixed_pages', 'content',$privacy_edit->id, $request->lang_privacy);
            Helper::add_localization('fixed_pages', 'content', $privacy_edit->id, $request->privacy, $request->lang_privacy);

        }

        }
       }
       
         return redirect('privacy');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\AcademicDegree;
use App\Languages;
use App\Helpers\Helper;

class AcademicDegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academic_degrees = AcademicDegree::latest()->get();
        $languages = Languages::all();
        
        return view('academic_degrees.index', compact('academic_degrees', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|unique:academic_degrees,title',
            'from'=>'required|integer|min:1',
            'to'=>'required|integer|min:1|min:'.(int)$request->from,
        ]);

        if ($validator->fails()) {
            return redirect('academic_degrees#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }

        $acedemic_degree = new AcademicDegree;
        $acedemic_degree->title= $request->title;
        $acedemic_degree->from = $request->from;
        $acedemic_degree->to = $request->to;
        if (Auth::check()) {
            $acedemic_degree->created_by = Auth::id();
        }
        $acedemic_degree->save();

        return redirect()->route('degrees')->with('success','تم إضافه درجة أكاديميه جديده بنجاح');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $court=AcademicDegree::find($id);
        Helper::remove_related_localization('academic_degrees', $id);
        $court->delete();
    }

    public function destroyall()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            Helper::remove_related_localization('academic_degrees', $id);
            AcademicDegree::find($id)->delete();
        } 
    }

    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'academic_degree_id' => 'required|integer',
            'academic_degree_name'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('academic_degrees#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('academic_degrees', 'title', $request->academic_degree_id, $request->academic_degree_name, $request->lang_id);
        return redirect()->route('degrees')->with('success','تم الإضافة بنجاح');
    }
}

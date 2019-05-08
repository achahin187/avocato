<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bouquet;
use App\BouquetPaymentMethod;
use App\BouquetService;

class BouquetsController extends Controller
{
    public function index()
    {
        $data['bouquets'] = Bouquet::with('price')->with('payment')->with('services')->with('users')->get();
        return view('bouquets.index',$data);
    }

    public function view($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price')->first();
        return view('bouquets.view',$data);
    }

    public function edit($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price')->first();
        return view('bouquets.edit',$data);
    }

    public function update(Request $request , $id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price')->first();
        return view('bouquets.index',$data);
    }

    public function add()
    {
         $data['payment_methods'] = BouquetPaymentMethod::all();
         $data['services']=BouquetService::all();
        return view('bouquets.add',$data);
    }
    public function create(Request $request)
    {
        dd($request->all());
        if($request['name_language'] == 2)
        {
            $bouquet['name']=$request['name'];
        }
        if($request['description_language'] == 2)
        {
            $bouquet['name']=$request['description'];
        }
        if($request['client_type'] == 0)
        {
            $bouquet['bouquet_type']=$request['client_type'];
        }
        
        $data['bouquet'] = Bouquet::create($request->all());
        return view('bouquets.view',$data);
    }
    public function delete($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price')->first();
        return redirect()->route('bouquets');
    }
}

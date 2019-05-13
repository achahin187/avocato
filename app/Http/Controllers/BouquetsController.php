<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bouquet;
use App\BouquetPaymentMethod;
use App\BouquetService;
use App\BouquetPrice;
use App\BouquetMethod;
use App\BouquetServiceCount;
use Illuminate\Support\Facades\Validator;
use App\Languages;
use Helper;

class BouquetsController extends Controller
{
    public function index()
    {
        $data['bouquets'] = Bouquet::with('price_relation')->with('payment')->with('services')->with('users')->get();
        $data['languages'] = Languages::all();
        return view('bouquets.index',$data);
    }

    public function view($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price_relation')->first();
        return view('bouquets.view',$data);
    }

    public function edit($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('users')->with('price_relation')->with('payment')->with('services')->first();
        
        if($data['bouquet']->users()->count() > 0 )
        {
            session('error','cannot edit this bouquet because it has users ');
            return redirect()->route('bouquets');  
        }
        $data['payment_methods'] = BouquetPaymentMethod::all();
        $data['services']=BouquetService::all();
        // dd($data['bouquet']['services'][0]);
        return view('bouquets.edit',$data);
    }

    public function update(Request $request , $id)
    {
        // dd($request->all());
        $bouquet = Bouquet::find($id);
        if($bouquet == null)
        {
            return redirect()->back()->with('error','No bouquet Found with this id');
        }
        try
        {

        
         $bouquet->update($request->all());
        if($request['bouquet_type'] == 1)
        {
            BouquetPrice::where('bouquet_id',$bouquet->id)->delete();
             $bouquet->update([
                'price'=>NULL
            ]);
            foreach($request['bouquet'] as $key => $value)
            {
                
                BouquetPrice::create([
                    'bouquet_id'=> $bouquet->id,
                    'price' => $value['price'] , 
                    'count_from' => $value['count_from'],
                    'count_to' => $value['count_to']
                    ]);

            }
            
        }
        if($request['bouquet_type'] == 0)
        {
            BouquetPrice::where('bouquet_id',$bouquet->id)->delete();
            // $bouquet->update([
            //     'price'=>$request['price']
            // ]);
        }
        
        if(array_key_exists('payment_method',$request->all()))
        {
            BouquetMethod::where('bouquet_id',$bouquet->id)->delete();
            foreach($request['payment_method'] as $key => $value)
            {
                BouquetMethod::create([
                    'bouquet_id'=> $bouquet->id,
                    'payment_method_id' => $value 
                    ]);

            }
        }
            if(array_key_exists('service',$request->all()))
            {
                BouquetServiceCount::where('bouquet_id',$bouquet->id)->delete();
                foreach($request['service'] as $key => $value)
                {
                    
                    if($value['count'] != null)
                    {
                        $active = 0;
                        if(array_key_exists('active',$value) )
                        {
                            $active = 1;
                        }
                        BouquetServiceCount::create([
                            'bouquet_id'=> $bouquet->id,
                            'bouquet_service_id' => $value['id'],
                            'service_count'=>$value['count'],
                            'service_active' => $active,
                            ]);

                    }
                    

                }
            }
            
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','error while updating package');
        }

        return redirect()->route('bouquets')->with('success','package updated successfully'); 
    }

    public function add()
    {
         $data['payment_methods'] = BouquetPaymentMethod::all();
         $data['services']=BouquetService::all();
        return view('bouquets.add',$data);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'service' => 'required',
            'payment_method' => 'required',
            'bouquet_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $request['country_id']=session('country');
        $bouquet = Bouquet::create($request->all());
        if($request['bouquet_type'] == 1)
        {
            foreach($request['bouquet'] as $key => $value)
            {
                BouquetPrice::create([
                    'bouquet_id'=> $bouquet->id,
                    'price' => $value['price'] , 
                    'count_from' => $value['count_from'],
                    'count_to' => $value['count_to']
                    ]);

            }
            
        }
        
        
            foreach($request['payment_method'] as $key => $value)
            {
                BouquetMethod::create([
                    'bouquet_id'=> $bouquet->id,
                    'payment_method_id' => $value 
                    ]);

            }
            foreach($request['service'] as $key => $value)
            {
                if($value['count'] != null)
                {
                    $active = 0;
                    if(array_key_exists('active',$value) )
                    {
                        $active = 1;
                    }
                    BouquetServiceCount::create([
                        'bouquet_id'=> $bouquet->id,
                        'bouquet_service_id' => $value['id'],
                        'service_count'=>$value['count'],
                        'service_active' => $active,
                        ]);

                }
                

            }
            
        
        session('success','package added  successfully');
        return redirect()->route('bouquets');
    }
    public function delete($id)
    {
        $bouquet = Bouquet::where('id',$id)->with('users')->first();
        // dd($bouquet->users()->count());
        if($bouquet->users()->count() > 0 )
        {
            session('error','cannot delete this bouquet because it has users ');
            return redirect()->route('bouquets');  
        }
        try{
            // $bouquet->price()->delete();
            // $bouquet->payment()->delete();
            // $bouquet->services()->delete();
            $bouquet->delete();
            Helper::remove_related_localization('bouquets', $bouquet->id);

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','error while delete');
        }
        
        return redirect()->route('bouquets');
    }
    
    public function delete_all(Request $request)
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $bouquet = Bouquet::where('id',$id)->with('users')->first();
        if($bouquet->users()->count() == 0 )
        {
            try{
                // $bouquet->price()->delete();
                // $bouquet->payment()->delete();
                // $bouquet->services()->delete();
                $bouquet->delete();
                Helper::remove_related_localization('bouquets', $bouquet->id);
    
            }
            catch(\Exception $e)
            {
                return redirect()->back()->with('error','error while delete');
            } 
        }
       
        }
        return redirect()->route('bouquets'); 
    }

    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bouquet_id' => 'required|integer',
            'bouquet_name'=>'required',
            'bouquet_description'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('bouquets#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('bouquets', 'name', $request->bouquet_id, $request->bouquet_name, $request->lang_id);
        Helper::add_localization('bouquets', 'description', $request->bouquet_id, $request->bouquet_description, $request->lang_id);
        return redirect()->route('bouquets')->with('success','تم الإضافة بنجاح');
    }
}

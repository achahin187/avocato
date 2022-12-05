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
use App\UserBouquet;
use App\UserBouquetPayment;
use App\UserBouquetServiceCount;
use Excel;
use App\Exports\BouquetsExport;

class BouquetsController extends Controller
{
    public function index()
    {
        $data['bouquets'] = Bouquet::with('price_relation')->with('payment')->with('services')->with('users')->where('country_id',session('country'))->get();
        $data['languages'] = Languages::all();
        return view('bouquets.index',$data);
    }

    public function view($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('payment')->with('services')->with('users')->with('price_relation')->where('country_id',session('country'))->first();
        
        return view('bouquets.view',$data);
    }

    public function edit($id)
    {
        $data['bouquet'] = Bouquet::where('id',$id)->with('users')->with('price_relation')->with('payment')->with('services')->where('country_id',session('country'))->first();
        
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
            'description' => 'required|max:150',
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

    public function bouquets_payment_user_update(Request $request , $id)
    {
        // dd($request->payment_status);
        try
        {
            if($request->payment_status == 1)
            { 
                $bouquet = UserBouquetPayment::find($id);
                if($bouquet->payment_status != $request->payment_status || $bouquet->payment_status != 1)
                {
                    $number_of_installments = UserBouquetPayment::where('user_id',$bouquet->user_id)->get()->count();
               
                  UserBouquetPayment::where('id',$id)->update([
                    "payment_status" => $request->payment_status
                    ]);
                    $services = BouquetServiceCount::where('bouquet_id',$bouquet->bouquet_id)->get();
                    foreach($services as $service)
                    {
                        if($service->service_active == 1)
                        {
                            

                          $user_service = UserBouquetServiceCount::where('user_id' , $bouquet->user_id )->where('service_id',$service->bouquet_service_id)->first();
                        //   dd($user_service);
                          if($user_service != null)
                          {
                            $count = $user_service->count + ($service->service_count / $number_of_installments);
                            // dd($count);
                            $user_service->update([
                                'quota'=>$count
                            ]);
                          }
                          else
                          {
                            $count = $service->service_count / $number_of_installments ; 
                            UserBouquetServiceCount::create([
                                'user_id'=> $bouquet->user_id ,
                                'bouquet_id' => $bouquet->bouquet_id ,
                                'service_id' => $service->bouquet_service_id ,
                                'all_count' => $service->service_count,
                                'quota'=>$count,
                                
                            ]);

                          }
                           

                        }
                        
                    }

                }
                else
                {
                    return redirect()->back()->with('error','You cannot update this installment');
                }

            }
            
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','error update installment');
        }

       return redirect()->back()->with('success','installment updated successfully');

    }

    public function bouquet_payment($id)
    {
        $payments = BouquetMethod::where('bouquet_id',$id)->with('payment')->get();
        // dd($payments);
        return response()->json($payments);
    }

    public function bouquet_payment_value($id , $discount)
    {
        $bouquet = Bouquet::find($id);
        $discount_value = $bouquet->price * $discount / 100 ;
        $value = $bouquet->price - $discount_value ;
//  dd($value);
        return response()->json($value);

    }
    public function bouquet_price($id)
    {
        $payments = BouquetPrice::where('bouquet_id',$id)->get();
        // dd($payments);
        return response()->json($payments);
    }

    public function bouquet_price_value($id , $discount ,$price_relation)
    {
        $bouquet = Bouquet::find($id);
        $price = BouquetPrice::find($price_relation);
        $discount_value = $price->price * $discount / 100 ;
        $value = $price->price - $discount_value ;
//  dd($value);
        return response()->json($value);

    }

    public function bouquet_type($id)
    {
        $type = Bouquet::find($id);
        // dd($payments);
        return response()->json($type->bouquet_type);
    }

    public function excel()
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'bouquets' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];

            Excel::store(new BouquetsExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            
            Excel::store((new BouquetsExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            
            Excel::store((new BouquetsExport(null)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bouquet;
use App\BouquetPaymentMethod;
use App\BouquetService;
use App\BouquetPrice;

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
        $bouquet = Bouquet::where('id',$id)->with('users')->first();
        if(count($bouquet->users()) == 0 )
        {
            session('error','cannot edit this bouquet because it has users ');
            return redirect()->route('bouquets');  
        }
        return redirect()->route('bouquets');
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
        $bouquet = Bouquet::create($request->all());
        if($request['bouquet_type'] == 1)
        {
            foreach($request['price'] as $key => $value)
            {
                BouquetPrice::create([
                    'bouquet_id'=> $bouquet->id,
                    'price' => $value , 
                    'count_from' => $request['count_from'][$key],
                    'count_to' => $request['count_to'][$key]
                    ]);

            }
            
        }
        session('success','added bouquet successfully');
        return redirect()->route('bouquets');
    }
    public function delete($id)
    {
        $bouquet = Bouquet::where('id',$id)->with('users')->first();
        if(count($bouquet->users()) == 0 )
        {
            session('error','cannot delete this bouquet because it has users ');
            return redirect()->route('bouquets');  
        }
        try{
            $bouquet->price()->destroy();
            $bouquet->payment()->destroy();
            $bouquet->services()->destroy();
            $bouquet->destroy();

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
        if(count($bouquet->users()) > 0 )
        {
            try{
                $bouquet->price()->destroy();
                $bouquet->payment()->destroy();
                $bouquet->services()->destroy();
                $bouquet->destroy();
    
            }
            catch(\Exception $e)
            {
                return redirect()->back()->with('error','error while delete');
            } 
        }
       
        }
        return redirect()->route('bouquets'); 
    }
}

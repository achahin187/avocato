<?php

namespace App\Http\Controllers;
use App\Payment;
use App\Users;
use Session;
use App\Package_Types;
use App\Subscriptions;
use App\Geo_Countries;

use Auth;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    

    public function index(Request $request)
    {

        $nationalities = Geo_Countries::all();


        $payments=Payment::all();

        return view('payment.payment',compact('payments','nationalities'))->with('users', Users::users(8)->where('country_id',Auth::user()->country_id)->get());
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if($data['statusCode'] == 200){
            Payment::create([
                'type' => $data['type'],
                'referenceNumber' => $data['referenceNumber'],
                'merchantRefNumber' => $data['merchantRefNumber'],
                'orderAmount' => $data['orderAmount'],
                'paymentAmount' => $data['paymentAmount'],
                'fawryFees' => $data['fawryFees'],
                'paymentMethod' => $data['paymentMethod'],
                'orderStatus' => $data['orderStatus'],
                'name' => $data['customerName'],
                'Mobile' => $data['customerMobile'],
                'Mail' => $data['customerMail'],
                'customerProfileId' => $data['customerProfileId'],
                'signature' => $data['signature'],
                'statusCode' => $data['statusCode'],
                'statusDescription'=> $data['statusDescription'],
            ]);
        }
        
         return redirect()->route('payment_index');
    }


  /**
     * Delete selected rows
     */
    public function destroySelected(Request $request)
    {
        // get cities IDs from AJAX
        $ids = $request->ids;

        // transform $ids into array values then search and delete
        payment::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    public function destroy($id)
    {
        // Find and delete this record
        payment::find($id)->delete();

        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    
    }


    public function filter(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'activate' => 'required'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('individuals#filterModal_sponsors')
                ->withErrors($validator)
                ->withInput();
        }
      
        $users=Users::all();
   

       
        if($request->has('search'))
        {
          $users = $users->distinct()->where(function($query) use ($request){
            $query->where('name','like','%'.$request->search.'%')
            ->orwhere('full_name','like','%'.$request->search.'%')
            ->orwhere('code','like','%'.$request->search.'%')
            ->orwhere('cellphone','like','%'.$request->search.'%');
          });
        }

        // check nationality
        if ($request->nationality && $request->nationality != null) {
            $users = $users->where('user_details.nationality_id', $request->nationality);
        }
        // dd($users->toSql());
        switch ($request->activate) {
            case "1":
                $users = $users->get();
                break;
            case "2":
                $users = $users->where('users.is_active', '!=', 0)->get();
                break;
            case "3":
                $users = $users->where('users.is_active', '=', 0)->get();
                break;
            default:
                break;
        }


        $packages = Package_Types::all();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();

        return view('payment.payment', compact(['packages', 'subscriptions', 'nationalities']))->with('filters', $users);
    }

}
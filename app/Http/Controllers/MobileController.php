<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;
use Validator;
use Exception;

use Excel;
use App\Users;
use App\Users_Rules;
use App\Entity_Localizations;
use App\Case_;
use App\Case_Client;
use App\Tasks;
use App\Consultation;

use Illuminate\Http\Request;

class MobileController extends Controller
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
       
        return view('clients.mobile.mobile')->with('users', Users::users(7)->where('country_id', Auth::user()->country_id)->paginate(10));
    }

    // Filter mobile users
    public function filter(Request $request)
    {
        // check if start date is less than end date
        Validator::extend('before_or_equal', function ($attribute, $value, $parameters, $validator) {
            return strtotime($validator->getData()[$parameters[0]]) >= strtotime($value);
        });

        if ($request->start_date && !$request->end_date) {
            $rules = [
                'activate' => 'required'
            ];
        } else if ($request->start_date) {
            $rules = [
                'start_date' => 'before_or_equal:end_date',
                'end_date' => '',
                'activate' => 'required'
            ];
        } else {
            $rules = [
                'activate' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $rules, [
            'start_date.before_or_equal' => 'حقل تاريخ البداية يجب ان يكون اصغر من او يساوي حقل تاريخ النهاية'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('mobile#filterModal_sponsors')
                ->withErrors($validator)
                ->withInput();
        }

        $from = $to = null;

        if ($request->start_date) {
            $from = date("Y-m-d 00:00:00", strtotime($request->start_date));
        }
        if ($request->end_date) {
            $to = date("Y-m-d 23:59:59", strtotime($request->end_date));
        }

        if ($from && $to) {
            $filter = Users::users(7)->whereHas('subscription', function ($query) use ($from, $to) {
                $query->where('start_date', '>=', $from)->where('end_date', '<=', $to);
                
            });
        } else if ($from && !$to) {
            $filter = Users::users(7)->whereHas('subscription', function ($query) use ($from, $to ) {
                $query->where('start_date', '>=', $from);
                
            });
        } else if (!$from && $to) {
            $filter = Users::users(7)->whereHas('subscription', function ($query) use ($from, $to ) {
                $query->where('end_date', '<=', $to);
                
            });
        } else {
            $filter = Users::users(7);
        }

       
            if(array_key_exists('search',$request->all()))
            {
                // dd($request->all());
                
                $filter=$filter->where('name','like','%'.$request->search.'%')->orwhere('full_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%');
            }
        
        switch ($request->activate) {
            case "1":
                $filter = $filter->paginate(10);
                break;
            case "2":
                $filter = $filter->where('is_active', '!=', 0)->paginate(10);
                break;
            case "3":
                $filter = $filter->where('is_active', 0)->paginate(10);
                break;
            default:
                break;
        }

        return view('clients.mobile.mobile')->with('users', $filter);
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
        
        $data['user'] = Users::find($id);
        // redirect to home page if user is not found
        if ($data['user'] == null) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/mobile');
        }

        $data['packages'] = Entity_Localizations::where('field', 'name')->where('entity_id', 1)->get();
        $data['cases'] = Case_Client::where('client_id', $id)->get();

        // get urgent
        $data['urgents'] = Tasks::where('client_id', $id)->where('task_type_id', 1)->get();

        // get paid and free services only
        $data['services'] = Tasks::where('client_id', $id)->where('task_type_id', 3)->get();
        $data['consultations'] = Consultation::where('created_by', $id)->get();

        return view('clients.mobile.mobile_show', $data);
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
        // Find and delete this record
        Users::destroy($id);

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
        // return explode(",", $ids);
        // transform $ids into array values then search and delete
        Users::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $data = array(['كود العميل', 'اسم العميل', 'الهاتف']);
        $ids = explode(",", $request->ids);

        foreach ($ids as $id) {
            $d = Users::find($id);
            array_push($data, [$d->code, $d->name, $d->phone]);
        }

        $myFile = Excel::create('عملاء المحتوي', function ($excel) use ($data) {
            $excel->setTitle('المدن والمحافظات');
            // Chain the setters
            $excel->setCreator('جسر الامان')
                ->setCompany('جسر الامان');
            // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول المحافظات والمدن');

            $excel->sheet('المدن والمحافظات', function ($sheet) use ($data) {
                $sheet->setRightToLeft(true);
                $sheet->getStyle('A1:B1')->getFont()->setBold(true);
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        });

        $myFile = $myFile->string('xlsx');
        $response = array(
            'name' => 'عملاء المحتوي' . date('Y_m_d'),
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
        );

        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Users;
use App\Rules;
use App\Users_Rules;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Excel;
use Session;
use App\Exports\UsersExport;
use App\Helpers\Helper;
use App\Log;
use Carbon\Carbon;
use Auth;
use App\Geo_Countries;

class UsersListController extends Controller
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
        // return Users::withTrashed()->restore();
        $data['users'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
            $q->where('parent_id', 13);
        })->paginate(10);
        $data['roles'] = Rules::where('parent_id', 13)->get();
        return view('users.users_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Rules::where('parent_id', 13)->get();
        $data['codes'] = Geo_Countries::all();
        return view('users.users_list_create', $data);
    }


    public function excel()
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'users' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];
            Excel::store(new UsersExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            Excel::store((new UsersExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new UsersExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }
    }

    public function filter(Request $request)
    {
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
         */
        $data['users'] = Users::where('country_id',session('country'))->where(function ($q) use ($request) {
            $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
            $date_to = date('Y-m-d 23:59:59', strtotime($request->date_to));

            if ($request->has('roles')) {
                $q->whereHas('rules', function ($q) use ($request) {
                    $q->whereIn('name', $request->roles);

                });
            } else {
                $q->whereHas('rules', function ($q) {
                    $q->whereIn('name', ['admin', 'data entry', 'call center']);
                });
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $q->whereBetween('last_login', array($date_from, $date_to));
            } elseif ($request->filled('date_from')) {
                $q->where('last_login', '>=', $date_from);
            } elseif ($request->filled('date_to')) {
                $q->where('last_login', '<=', $date_to);
            }
            if ($request->active == 1 || $request->active == 0) {
                $q->where('is_active', $request->active);
            }



        })->paginate(10);
        $data['roles'] = Rules::whereBetween('id', array('2', '4'))->get();
        foreach ($data['users'] as $user) {
            $filter_ids[] = $user->id;
        }
        if (!empty($filter_ids)) {
            Session::flash('filter_ids', $filter_ids);
        } else {
            $filter_ids[] = 0;
            Session::flash('filter_ids', $filter_ids);
        }

        return view('users.users_list', $data);

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
            'user_name' => 'required|between:3,20|unique:users,name,,,deleted_at,NULL',
            'full_name' => 'required|between:3,100',
            'role'      => 'required',
            'email'     => 'required|email|max:40',
            'phone'     => 'required|digits_between:1,10',
            'cellphone' => (session('country') == 1)?'required|digits:10|unique:users,cellphone,,,deleted_at,NULL':'required|digits:9|unique:users,cellphone,,,deleted_at,NULL',
            'password'  => 'required|between:3,8|same:confirm_password',
            'confirm_password'      => 'required|between:3,8|same:confirm_password',
            'image'     => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = new Users;
        $user->name = $request->user_name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tele_code = $request->tele_code ;
        $user->cellphone = $request->cellphone ;
        $user->mobile = $request->tele_code.$request->cellphone ;
        $user->is_active = '1';
        $user->password = bcrypt($request->password);
        $user->country_id=session('country');
        if ($request->hasFile('image')) {
            $destinationPath = 'users_images';
            $fileNameToStore = $destinationPath . '/' . $request->user_name . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('image')->move($destinationPath, $fileNameToStore);
        } else {
            $destinationPath = 'users_images';
            $fileNameToStore = $destinationPath . '/' . "male.jpg";
        }
        $user->image = $fileNameToStore;
        $user->save();
        $user->rules()->attach([$request->role, 13]);
        Helper::add_log(3, 16, $user->id);
        return redirect()->route('users_list_create')->with('success', 'تم إضافه مستخدم جديد بنجاح');
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

        if ($data['user'] == null) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/users_list');
        }

        $logs = Log::with('user')->with('actions')->with('entity')->orderBy('created_at', 'desc')->get();

        foreach ($logs as $key => $log) {
            $log['created_at'] = Carbon::parse($log->created_at)->diffForHumans();
            $last = substr($log['entity']['base_url'], -1);
            if ($last == '/') {
                //  echo($log['item_id']);
                //  echo url('/');
                $log['entity']['base_url'] = url('/') . $log['entity']['base_url'] . $log['item_id'];
                // dd($log['entity']['base_url']);
            } else {
                // echo '1';
                $log['entity']['base_url'] = url('/') . $log['entity']['base_url'];
            }
            if ($log['created_by'] != $id) {


                unset($logs[$key]);
            }

        }


        $data['logs'] = $logs;

        return view('users.user_profile', $data);
    }

    public function filter_logs(Request $request, $id)
    {
        $data['user'] = Users::find($id);
        $logs = Log::where(function ($q) use ($request) {
            $q->where('created_at', '>=', date('Y-m-d h:s:i', strtotime($request['from'])))
                ->where('created_at', '<=', date('Y-m-d h:s:i', strtotime($request['to'])));
        })->with('user')->with('actions')->with('entity')->orderBy('created_at', 'desc')->get();
        foreach ($logs as $key => $log) {
            $log['created_at'] = Carbon::parse($log->created_at)->diffForHumans();
            $last = substr($log['entity']['base_url'], -1);
            if ($last == '/') {
                    //  echo($log['item_id']);
                    //  echo url('/');
                $log['entity']['base_url'] = url('/') . $log['entity']['base_url'] . $log['item_id'];
                    // dd($log['entity']['base_url']);
            } else {
                    // echo '1';
                $log['entity']['base_url'] = url('/') . $log['entity']['base_url'];
            }
            if ($log['created_by'] != $id) {


                unset($logs[$key]);
            }

        }
        $data['logs'] = $logs;
        //  dd($data['logs']);
        return view('users.user_profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = Users::find($id);
        $data['codes'] = Geo_Countries::all();
        if ($data['user'] == null) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/users_list');
        }

        $data['roles'] = Rules::where('parent_id', 13)->get();
        return view('users.users_list_edit', $data);
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
        $user = Users::find($id);
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|between:3,20|unique:users,name,' . $id,
            'full_name' => 'required|between:3,100',
            'role' => 'required',
            'cellphone' => ($user->cellphone == $request['cellphone'])? "":((session('country')==1)?"unique:users,cellphone,,,deleted_at,NULL|digits:10":"unique:users,cellphone,,,deleted_at,NULL|digits:9"),
            'email' => ($user->email == $request['email'])? "email":"bail|email|unique:users,email,,,deleted_at,NULL",
            'phone' => 'required|digits_between:1,10',
            
            'password' => 'same:confirm_password',
            'confirm_password' => 'same:confirm_password',
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Users::find($id);
        $user->name = $request->user_name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tele_code = $request->tele_code ;
        $user->cellphone = $request->cellphone ;
        $user->mobile = $request->tele_code.$request->cellphone;
        $user->is_active = $request->is_active;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $destinationPath = 'users_images';
        if ($request->hasFile('image')) {
            $fileNameToStore = $destinationPath . '/' . $request->user_name . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
            if ($user->image != 'users_images/male.jpg') {
                File::delete($user->image);
            }
            Input::file('image')->move($destinationPath, $fileNameToStore);
        } else {
            if ($user->image != 'users_images/male.jpg') {
                $fileNameToStore = $destinationPath . '/' . $request->user_name . time() . rand(111, 999) . '.' . substr($user->image, strrpos($user->image, '.') + 1);
                rename(public_path($user->image), public_path($fileNameToStore));
            } else {
                $fileNameToStore = 'users_images/male.jpg';
            }

        }
        $user->image = $fileNameToStore;
        $user->save();
        $user->rules()->detach();
        $user->rules()->attach([$request->role, 13]);
        Helper::add_log(4, 16, $user->id);
        return redirect()->route('users_list')->with('success', 'تم تعديل بيانات العضويه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGet($id)
    {
        // return Users::withTrashed()->restore();
        $user = Users::find($id);
        $user->delete();
        return redirect()->route('users_list')->with('success', 'تم حذف العضويه بنجاح');
    }

    public function destroyPost($id)
    {
        $user = Users::find($id);
        Helper::add_log(5, 16, $user->id);
        $user->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $user = Users::find($id);
            Helper::add_log(5, 16, $user->id);
            $user->delete();
        }
    }
}
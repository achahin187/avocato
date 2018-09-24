<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Users;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function username()
    // {
    //     return 'name';
    // }
    public function username()
{
    return 'name';
}

    public function authenticate()
    {
        // session('country')="";
        // Session::put('country', null);
        if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }
        //  dd(session('country'));
       return view('auth/login'); 
    }
    public function login(Request $request)
    {
        //check country
        if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }
        
        // Check validation
        $this->validate($request, [
            'user_name' => 'required',
            'password'=>'required',            
        ]);
        $userdata=array('name'=>$request->user_name,'password'=>$request->password);

        if (Auth::attempt($userdata)) {
            foreach (Auth::user()->rules as $rule){
                if($rule->id==13 && Auth::user()->is_active==1) {
                    $u=Users::where('id',Auth::user()->id)->where('country_id',session('country'))->first();
                    // dd($u);
                    if($u != null)
                    {
                        // dd($u);
                        $u->last_login=date('Y-m-d H:i:s');
                        $u->save();
                        Helper::add_log(1,16,Auth::user()->id);
                        return redirect('/'); 
                    }
                    else
                    {
                        Session('error','country id doesnot exist , البلد ليست محدده');
                        return redirect()->route('choose.country');
                    }
                    
                }
            }
            // Helper::add_log(2,12,Auth::user()->id);
            Auth::logout();
            return redirect()->back()->with('error','غير مسموح لك بالدخول');

        }
        else{
          return redirect()->back()->with('error','من فضلك تأكد من ادخال اسم المستخدم وكلمة المرور بطريقة صحيحة');
        }
        
        // Redirect home page
    }

    public function logout(Request $request) {
        Session::put('country', null);
        Helper::add_log(2,16,Auth::user()->id);
        Auth::logout();
        return redirect('/'); 
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

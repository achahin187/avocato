<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Users;
use Illuminate\Http\Request;

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

    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'user_name' => 'required',
            'password'=>'required',            
        ]);
        $userdata=array('name'=>$request->user_name,'password'=>$request->password);

        if (Auth::attempt($userdata)) {
            foreach (Auth::user()->rules as $rule){
                if($rule->id==13 && Auth::user()->is_active==1) {
                    $u=Users::find(Auth::user()->id);
                    $u->last_login=date('Y-m-d H:i:s');
                    $u->save();
                    
                    return redirect()->route('home');  
                }
            }
            Auth::logout();
            return redirect()->back()->with('error','غير مخول لك بالدخول');;

        }
        else{
          return redirect()->back()->with('error','من فضلك تأكد من ادخال اسم المستخدم وكلمة المرور بطريقة صحيحة');
        }
        
        // Redirect home page
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

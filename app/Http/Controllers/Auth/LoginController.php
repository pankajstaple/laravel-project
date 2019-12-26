<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request){
        if(isset(Auth::user()->type) && (Auth::user()->type == "Admin")){
            Auth::logout();
            return redirect('admin/login');
        }else{
            Auth::logout();
            return redirect('/');    
       
        }
        
    }

    protected function authenticated(Request $request, $user)
    {
        if ($request->ajax()){
            if(auth()->check()){
                \LogActivity::addToLog('LOGGED_IN', $user->id); // store log
            }
            return response()->json([
                'auth' => auth()->check(),
                'user' => $user,
//                'intended' => $this->redirectPath(),
            ]);
        }

        \LogActivity::addToLog('LOGGED_IN', $user->id); // store log
         $user->update([
            'last_login_at' => date("Y-m-d H:i:s", time()),
            'last_login_ip' => $request->getClientIp()
        ]);
    }   
}

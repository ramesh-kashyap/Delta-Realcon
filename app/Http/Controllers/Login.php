<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserLogin;

use DB;

class Login extends Controller
{


    public function login(Request $request)
    {

        $validation =  Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required|string',

        ]);
        // dd($validation);

        $post_array  = $request->all();
        $credentials = $request->only('username', 'password');



        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->active_status == "Block") {
                Auth::logout();
                return Redirect::back()->withErrors(array('You are Blocked by admin'));
            }

            // $ip = $_SERVER["REMOTE_ADDR"];
            // $exist = UserLogin::where('user_ip',$ip)->first();
            // $userLogin = new UserLogin();
            // if ($exist) {
            //     $userLogin->longitude =  $exist->longitude;
            //     $userLogin->latitude =  $exist->latitude;
            //     $userLogin->location =  $exist->location;
            //     $userLogin->country_code = $exist->country_code;
            //     $userLogin->country =  $exist->country;
            // }else{
            //     $info = json_decode(json_encode(getIpInfo()), true);
            //     $userLogin->longitude =  @implode(',',$info['long']);
            //     $userLogin->latitude =  @implode(',',$info['lat']);
            //     $userLogin->location =  @implode(',',$info['city']) . (" - ". @implode(',',$info['area']) ."- ") . @implode(',',$info['country']) . (" - ". @implode(',',$info['code']) . " ");
            //     $userLogin->country_code = @implode(',',$info['code']);
            //     $userLogin->country =  @implode(',', $info['country']);
            // }
            // $userAgent = osBrowser();
            // $userLogin->user_id = $user->id;
            // $userLogin->user_ip =  $ip;

            // $userLogin->browser = @$userAgent['browser'];
            // $userLogin->os = @$userAgent['os_platform'];
            // $userLogin->save();

            return redirect()->route('user.dashboard');

            // echo "credentials are invalid"; die;
        } else {
            // echo "credentials are invalid"; die;
            return Redirect::back()->withErrors(array('Invalid Username & Password !'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function forgot_password()
    {

        return view('auth.passwords.forgot-password');
    }


    public function forgot_password_submit(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'username' => 'required|unique:users',

        ]);


        $credentials = User::where('username', $request->username)->first();

        if ($credentials) {

            $userIpInfo = getIpInfo();
            $userBrowserInfo = osBrowser();
            $code = verificationCode(6);

            PasswordReset::where('email', $credentials->email)->delete();

            $password = new PasswordReset();
            $password->email = $credentials->email;
            $password->token = $code;
            $password->created_at = \Carbon\Carbon::now();
            $password->save();

            sendEmail($credentials->email, 'Recovery Password', [
                'name' => $credentials->name,
                'browser' => @$userBrowserInfo['browser'],
                'ip' => @$userIpInfo['ip'],
                'time' => @$userIpInfo['time'],
                'operating_system' => @$userBrowserInfo['os_platform'],
                'code' => $code,
                'viewpage' => 'forgot_sucess',

            ]);

            $page_title = 'Account Recovery';
            $userID = $credentials->id;
            session()->put('pass_res_mail', $userID);
            $notify[] = ['success', 'Password reset email sent successfully'];
            return redirect()->route('codeVerify')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Invalid Username '];
            return redirect()->route('forgot-password')->withNotify($notify);
        }
    }

    public function codeVerify()
    {
        $page_title = 'Account Recovery';
        $userID = session()->get('pass_res_mail');

        $user_name = session()->get('username');

        if (!$userID) {
            $notify[] = ['error', 'Opps! session expired'];
            return redirect()->route('forgot-password')->withNotify($notify);
        }

        return view('auth.passwords.confirm', compact('page_title', 'userID', 'user_name'));
    }


    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required', 'userID' => 'required']);
        $code = $request->code;
        $userDetail = User::where('id', $request->userID)->first();

        if (PasswordReset::where('token', $code)->where('email', $userDetail->email)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('forgot-password')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_email', $request->userID);
        session()->put('resetMail', $request->userID);
        return redirect()->route('resetPassword', $code)->withNotify($notify);
    }


    public function resetPassword()
    {
        $page_title = "Forgot Password";
        //   dd("hi");
        return view('auth.passwords.resetPassword', compact('page_title'));
    }



    public function submitResetPassword(Request $request)
    {

        $request->validate(['password' => 'required|confirmed|min:5']);

        $userID = session()->get('resetMail');

        //    dd($userID);
        //    die;

        $user_name = session()->get('username');

        $user = User::where('id', $userID)->orderBy('id', 'DESC')->first();


        if (!$user) {
            $notify[] = ['error', 'Opps! session expired'];
            return redirect()->route('forgot-password')->withNotify($notify);
        }
        $password = password_hash($request->password, PASSWORD_DEFAULT);

        $user->password = $password;
        $user->PSR = $request->password;
        $user->save();
        $notify[] = ['success', 'Your Password change Successfully.'];
        return redirect()->route('login')->withNotify($notify);
    }
}

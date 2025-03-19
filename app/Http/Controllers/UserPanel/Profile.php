<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bank;
use App\Models\UserLogin;
use Carbon\Carbon;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Profile extends Controller
{
    public function wallets()
    {
        $user = Auth::user();
        $profile_data = User::where('id', $user->id)->orderBy('id', 'desc')->first();
        $this->data['login_logs'] = UserLogin::where('user_id', $user->id)->orderBy('id', 'DESC')->limit(10)->get();
        $this->data['profile_data'] = $profile_data;
        $this->data['page'] = 'user.profile.wallets';
        return $this->dashboard_layout();
    }
    public function index()
    {
        $user = Auth::user();
        $profile_data = User::where('id', $user->id)->orderBy('id', 'desc')->first();
        $this->data['login_logs'] = UserLogin::where('user_id', $user->id)->orderBy('id', 'DESC')->limit(10)->get();
        $this->data['profile_data'] = $profile_data;
        $this->data['page'] = 'user.profile.profile-setting';
        return $this->dashboard_layout();
    }

    public function change_password()
    {
        $this->data['page'] = 'user.profile.ChangePass';
        return $this->dashboard_layout();
    }

    public function ChangeSecurityPass()
    {
        $this->data['page'] = 'user.profile.ChangeSecurityPass';
        return $this->dashboard_layout();
    }



    public function BankDetail()
    {
        $user = Auth::user();
        $bank = Bank::where('user_id', $user->id)->first();
        $this->data['bank_value'] = $bank;
        $this->data['page'] = 'user.profile.BankDetail';
        return $this->dashboard_layout();
    }


    public function share()
    {
        $user = Auth::user();
        $bank = Bank::where('user_id', $user->id)->first();
        $this->data['bank'] = $bank;
        $this->data['page'] = 'user.profile.share';
        return $this->dashboard_layout();
    }

    public function profile_update(Request $request)
    {
        try {
            // Validate incoming request
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
            ]);

            // Check if validation fails
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors())->withInput();
            }

            $user = Auth::user();

            User::where('id', Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);


            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong!'])->withInput();
        }
    }

    // ✅ 1. वेरिफिकेशन कोड भेजना
    public function sendVerificationCode(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;

        // **Generate 6-digit verification code**
        $verificationCode = rand(100000, 999999);

        // **डेटाबेस में कोड स्टोर करना**
        PasswordReset::updateOrCreate(
            ['email' => $email],
            ['token' => $verificationCode, 'created_at' => Carbon::now()]
        );

        // **Mail भेजना**
        Mail::send('emails.verification-code', ['code' => $verificationCode], function ($message) use ($email) {
            $message->to($email)->subject('Your Password Reset Code');
        });

        return response()->json(['success' => 'Verification code sent to your email.']);
    }

    public function change_password_post(Request $request)
    {
        try {
            $data = $request->all();
            $rules = ['password' => 'required|confirmed'];
            $msg = [
                'password.required'  => 'Password is required',
                'password.confirmed' => 'Password must match',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $user = Auth::user();

            // Update password without checking old password
            User::where('id', $user->id)->update([
                'password' => Hash::make($data['password']),
                'PSR' => $data['password'],
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', 'Password updated successfully');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }
    }



    public function change_trxpassword_post(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('old_password' => 'required', 'password' => 'required|confirmed');
            $msg = [
                'old_password.required'     => 'Old Password is required',
                'password.required'         => 'Password is required',
                'password.confirmed'        => 'Password must match',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $user = Auth::user();



            if (!Hash::check($data['old_password'], $user->tpassword))
                return Redirect::back()->withErrors('Current Transaction  Password is incorrect');

            User::where('id', $user->id)->update(array(
                'tpassword' => Hash::make($data['password']),
                'TPSR' => $data['password'],
                'updated_at' => new \DateTime
            ));

            // return Redirect::Back()->with('messages', 'Transaction password updated successfully');

            $notify[] = ['success', 'Transaction password updated successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }
    }



    public function bank_profile_update(Request $request)

    {
        try {
            $validation =  Validator::make($request->all(), [
                'account_holder' => 'required',
                'bank_name' => 'required',
                'branch_name' => 'required',
                'ifsc_code' => 'required',
                'account_number' => 'required',

            ]);
            if ($validation->fails()) {
                Log::info($validation->getMessageBag()->first());
                return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
            }

            $id = Auth::user()->id;

            $check_exist = Bank::where('user_id', $id)->first();

            $bank_array = array(

                'user_id' => $id,
                'bank_name' => $request->bank_name,
                'account_holder' => $request->account_holder,
                'branch_name' => $request->branch_name,
                //  'pancard_no'=>$request->pancard_no,
                'account_no' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
            );

            if (!$check_exist) {

                $bank = Bank::create($bank_array);
            } else {
                $bank = Bank::where('user_id', $id)->update($bank_array);
            }




            $notify[] = ['success', 'Bank Updated successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            Log::info('error here');
            Log::info($e->getMessage());
            print_r($e->getMessage());
            die("hi");
            return back()->withErrors('error', $e->getMessage())->withInput();
        }
    }



    public function bank_details(Request $request)
    {
        $request->validate([
            'usdtBep20' => 'nullable|string', 
            'account_no' => 'nullable|numeric',
            'ifsc_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_name' => 'nullable|string',
        ]);
    
        $user = auth()->user();
        $notify = []; // Notification Array
    
        // ✅ Agar Wallet Address Fill Kiya Hai to Users Table me Save Kare
        if ($request->filled('usdtBep20')) {
            $user->update(['usdtBep20' => $request->usdtBep20]);
            $notify[] = ['success', 'Wallet address updated successfully.'];
        }
    
        // ✅ Agar Puri Bank Details Fill Ki Hain to Banks Table me Save ya Update Kare
        if ($request->filled(['account_no', 'ifsc_code', 'bank_name', 'branch_name'])) {
            Bank::updateOrCreate(
                ['user_id' => $user->id], 
                [
                    'account_no' => $request->account_no,
                    'ifsc_code' => $request->ifsc_code,
                    'bank_name' => $request->bank_name,
                    'branch_name' => $request->branch_name,
                    'account_holder' => $user->name,
                    'user_id' => $user->id,
                ]
            );
            $notify[] = ['success', 'Bank details saved/updated successfully.'];
        }
    
        // ✅ Agar Wallet Address bhi Empty hai aur Bank Details bhi Empty hai to Error Show Kare
        if (empty($notify)) {
            $notify[] = ['error', 'Please provide either Wallet Address or complete Bank Details.'];
        }
    
        return redirect()->back()->withNotify($notify);
    }
    
}

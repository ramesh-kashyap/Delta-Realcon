<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\Income;
use App\Models\Debit;
use Validator;
use DB;
use Redirect;
use Auth;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {     
     
     $this->data['page'] = 'admin.dashboard';
     return $this->admin_dashboard();
     
    } 


    public function changePassword()
    {     
     
     $this->data['page'] = 'admin.setting.change-password';
     return $this->admin_dashboard();
     
    } 


  public function sendCode(Request $request)
    {

    
        $code = verificationCode(6);
  
        $emailId="sipgroup81@gmail.com";
       
        PasswordReset::where('email', $emailId)->delete();

        $password = new PasswordReset();
        $password->email = $emailId;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

           sendEmail($emailId, 'Your One-Time Password', [
            'name' => "Sip Fx",
            'code' => $code,
            'purpose' => 'Admin Activation',
            'viewpage' => 'one_time_password',

         ]);

       return true;
    }
   
   
   
    public function addPrice()
    {     
     
     $trade= Trade::get();   
     $this->data['trade'] = $trade;
     $this->data['page'] = 'admin.setting.add-price';
     return $this->admin_dashboard();
     
    }  
       public function add_address()
    {     
     
     $trade= Trade::get();   
     $this->data['trade'] = $trade;
     $this->data['page'] = 'admin.setting.add-address';
     return $this->admin_dashboard();
     
    }  
        public function debit()
    {     
     
       $trade= Debit::get();   
     $this->data['debit'] = $trade;
     $this->data['page'] = 'admin.setting.debit';
     return $this->admin_dashboard();
     
    }  
    
    public function addreward()
    {     
     

     $this->data['page'] = 'admin.setting.addreward';
     return $this->admin_dashboard();
     
    } 
    
      public function addActivityBonus()
        {     
         
    
         $this->data['page'] = 'admin.setting.addActivityBonus';
         return $this->admin_dashboard();
         
        } 
        

    public function change_password_post(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('old_password' => 'required', 'password' => 'required|confirmed');
            $msg = [
                'old_password.required'     => 'Old Password is required',
                'password.required'         => 'Password is required' ,
                'password.confirmed'        => 'Password must match'    ,
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

            $user = Auth::guard('admin')->user();
            // print_r($user);die();

            if (!\Hash::check($data['old_password'], $user->password))
                return Redirect::back()->withErrors('Current Password is incorrect');

            DB::Table('admins')->where('id', $user->id)->update(array(
                'password' => \Hash::make($data['password']),
                'updated_at' => new \DateTime
            ));

        
            $notify[] = ['success', 'password updated successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }


    public function add_wallet(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('usdtTrc20' => 'required', 'usdtBep20' => 'required');
            $msg = [
                'usdtTrc20.required'     => 'usdtTrc20 is required',
                'usdtBep20.required'         => 'usdtBep20 is required' ,
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

           
           DB::table('general_settings')
            ->where('id', 1)
            ->update(['usdtTrc20' => $data['usdtTrc20'],'usdtBep20' => $data['usdtBep20']]);
            
            // print_r($user);die();

          
        
            $notify[] = ['success', 'Wallet updated successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }



  public function loginWithadmin(Request $request) 
    {
         $id=$request->id;
       
        $user =  Auth::loginUsingId($id);
              
         return redirect()->route('user.dashboard');
    //  return redirect('/login');
     }



    public function change_price(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('package' => 'required','currency' => 'required','tradetype' => 'required','entryPrice' => 'required','endPrice' => 'required','entrytime' => 'required','endtime' => 'required','percentage' => 'required','profitType' => 'required');
            $msg = [
                'package.required'     => 'package is required',
                'currency.required'     => 'currency is required',
                // 'lotSize.required'     => 'lotSize is required',
                'entryPrice.required'     => 'entryPrice is required',
                'endPrice.required'     => 'endPrice is required',
                'entrytime.required'     => 'entrytime is required',
                'endtime.required'     => 'endtime is required',
                'percentage.required'     => 'percentage is required',
                'profitType.required'     => 'profitType is required',
                'tradetype.required'     => 'profitType is required',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());

                $trade = Trade::firstOrNew(array('package' => $request['package']));
                $trade->package =$request['package'];
                $trade->currency =$request['currency'];
                $trade->lotSize =0;
                $trade->entryPrice =$request['entryPrice'];
                $trade->endPrice =$request['endPrice'];
                $trade->entrytime =$request['entrytime'];
                $trade->endtime =$request['endtime'];
                $trade->percentage =$request['percentage'];
                $trade->profitType =$request['profitType'];
                $trade->tradetype =$request['tradetype'];
                $trade->save();

            $notify[] = ['success', 'Price updated successfully'];
        return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }


    public function add_reward(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('rank' => 'required');
            $msg = [
                'rank.required'     => 'rank is required',
                'user_id.required'     => 'User ID is required',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());
        
            $rank=$request['rank'];
            $bonus=0;
            if($rank==1)
            {
               $bonus = 50; 
               $userRank="Manager";
            }
              if($rank==2)
            {
               $bonus = 100; 
                $userRank="Vice President";
            }
              if($rank==3)
            {
               $bonus = 300; 
                $userRank="Ceo";
            }
              if($rank==4)
            {
               $bonus = 500; 
                $userRank="Director";
            }
              if($rank==5)
            {
               $bonus = 1000; 
            $userRank="Chairman";
            }
            
            if($bonus>0)
            {
                
                
             $rankAchiever=User::where('username',$request['user_id'])->where('active_status','Active')->where('rank',$rank)->first();    
             if($rankAchiever)
             {
                $userID=$rankAchiever->id;
                $userName = $rankAchiever->username;
                $award['remarks'] = 'Reward Bonus';
                $award['amt'] = $bonus;
                $award['comm'] = $bonus;
                $award['level']=0;
                $award['rname']=$userRank;
                $award['ttime'] = date("Y-m-d");
                $award['user_id_fk'] =$userName;
                $award['user_id']=$userID;
              $income = Income::firstOrCreate(['remarks' => 'Reward Bonus','ttime'=>date("Y-m-d"),'user_id'=>$userID],$award);   
          
             }
                
                
            }
              

            $notify[] = ['success', 'Bonus updated successfully'];
        return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }


    public function add_debit(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('amount' => 'required','remarks' => 'required','user_id'=>'required');
            $msg = [
                'remarks.required'     => 'Remarks is required',
                'amount.required'     => 'Amount is required',
                'user_id.required'     => 'User ID is required',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());
        
            $bonus=$request['amount'];
          
            
            if($bonus>0)
            {
                
                
             $rankAchiever=User::where('username',$request['user_id'])->where('active_status','Active')->first();    
             if($rankAchiever)
             {
                $userID=$rankAchiever->id;
                $userName = $rankAchiever->username;
                $award['remarks'] = $request['remarks'];
                $award['amount'] = $bonus;
                $award['user_id']=$userID;
              $income = Debit::Create($award);   
          
             }
                
                
            }
              

            $notify[] = ['success', 'Debit successfully'];
        return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }
   public function add_activities_reward(Request $request)
    {

        try {
            $data = $request->all();
            $rules = array('bonus' => 'required','user_id'=>'required');
            $msg = [
                'bonus.required'     => 'bonus is required',
                'user_id.required'     => 'User ID is required',
            ];

            $validator = Validator::make($data, $rules, $msg);
            if ($validator->fails())
                return Redirect::back()->withErrors($validator->getMessageBag()->first());
        
            $bonus=$request['bonus'];
          
            
            if($bonus>0)
            {
                
                
             $rankAchiever=User::where('username',$request['user_id'])->where('active_status','Active')->first();    
             if($rankAchiever)
             {
                $userID=$rankAchiever->id;
                $userName = $rankAchiever->username;
                $award['remarks'] = 'Activities Bonus';
                $award['amt'] = $bonus;
                $award['comm'] = $bonus;
                $award['level']=0;
                $award['rname']=0;
                $award['ttime'] = date("Y-m-d");
                $award['user_id_fk'] =$userName;
                $award['user_id']=$userID;
              $income = Income::firstOrCreate(['remarks' => 'Activities Bonus','ttime'=>date("Y-m-d"),'user_id'=>$userID],$award);   
          
             }
                
                
            }
              

            $notify[] = ['success', 'Bonus updated successfully'];
        return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return Redirect::back()->witherrors($e->getMessage())->withInput();
        }

    }


}

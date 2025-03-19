<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Investment;
use App\Models\Income;
use App\Models\Transaction;
use App\Models\PasswordReset;

use App\Models\User_trade;
use App\Models\Activitie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
class Dashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Get user direct count
        $user_direct = User::where('sponsor', $user->id)->where('active_status', 'Active')->count();
        $directIds = User::where('sponsor', $user->id)->where('active_status', 'Active')->pluck('id');
        $personal_deposit = Investment::where('user_id', $user->id)->where('status', 'Active')->sum('amount');
    
        // Get left and right team information
        $left_team = $this->team_by_position($user->id, 'Left');               
        $right_team = $this->team_by_position($user->id, 'Right');   
    
        // Get investment reports and transaction history
        $deposit_report = Investment::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $weekly_profit = Income::where('user_id', $user->id)
            ->whereBetween('ttime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('comm');
        $totalIncome = Income::where('user_id', $user->id)->sum('comm');
        $totalIncomeall = Income::where('user_id', $user->id)->sum('comm');
        $units = Investment::where('user_id', $user->id)->sum('units');
        $transaction_data = Income::where('user_id', $user->id)->orderBy('id', 'desc')->take(10)->get();
        
        // Get Staking Bonus
        $staking_bonus = Income::where('user_id', $user->id)->where('remarks', 'Staking Bonus')->orderBy('id', 'DESC')->get();

        $units = Investment::where('user_id', $user->id)->where('units')->orderBy('id', 'DESC')->get();
    
        // Get Direct Bonus
        $direct_bonus = Income::where('user_id', $user->id)->where('remarks', 'Direct Bonus')->orderBy('id', 'DESC')->get();
    
        // Passing data to the view
        $this->data['left_business'] = Investment::whereIn('user_id', $left_team)->where('status', 'Active')->sum('amount');
        $this->data['right_business'] = Investment::whereIn('user_id', $right_team)->where('status', 'Active')->sum('amount');
        $this->data['left_team'] = (!empty($left_team)) ? count($left_team) : 0;
        $this->data['right_team'] = (!empty($right_team)) ? count($right_team) : 0;
        $this->data['weekly_profit'] = $weekly_profit;
        $this->data['transaction_data'] = $transaction_data;
        $this->data['deposit_report'] = $deposit_report;
        $this->data['user_direct'] = $user_direct;
        $this->data['personal_deposit'] = $personal_deposit;
        $this->data['totalIncomet'] = $totalIncome;
        $this->data['remaining_amount'] = ($personal_deposit * 4 + $user->extra_amt) - $totalIncome;
        $this->data['x4Deposit'] = ($personal_deposit * 4) - $totalIncomeall;
        $this->data['staking_bonus'] = $staking_bonus;
        $this->data['direct_bonus'] = $direct_bonus;
        $this->data['units'] = $units;
    
        // The page to load in the layout
        $this->data['page'] = 'user.dashboard';
        return $this->dashboard_layout();
    }
    



    public  function my_binary($userid){
        $arrin=array($userid);
        $ret=array();
        // print_r($arrin);die();
        while(!empty($arrin)){
         $alldown= User::select('id')->whereIn('Parentid',$arrin)->get()->toArray();
         if(!empty($alldown)){
                $arrin = array_column($alldown,'id');
                $ret[]=$arrin;
              
              
            }else{
                $arrin = array();
            } 
        }
        // continue;    
        $final = array();         
        if(!empty($ret)){
            array_walk_recursive($ret, function($item, $key) use (&$final){
                $final[] = $item;
            });
        }

        return $final;
        
    }  



  public function sendCode(Request $request)
  {

    $user=Auth::user();
      $code = verificationCode(6);

      $emailId=$user->email;
      $purpose=$request->purpose;

     
      PasswordReset::where('email', $emailId)->delete();

      $password = new PasswordReset();
      $password->email = $emailId;
      $password->token = $code;
      $password->created_at = \Carbon\Carbon::now();
      $password->save();

         sendEmail($emailId, 'Your One-Time Password', [
          'name' => $user->name,
          'code' => $code,
          'purpose' => $purpose,
          'viewpage' => 'one_time_password_user',

       ]);

     return true;
  }
 

     public  function team_by_position($userid,$position){
        $ret=array();
        $get_position_user=User::where('Parentid',$userid)->where('position',$position)->first();
        if($get_position_user){
        
            $ret=$this->my_binary($get_position_user->id);
            $ret[]=$get_position_user->id;
        }
       
        return $ret;
    }



    public function activities()
    {
        $user=Auth::user();
        $transaction_data = Activitie::where('user_id',$user->id)->orderBy('id', 'desc')->get();
        $this->data['activities'] = $transaction_data;
        $this->data['page'] = 'user.activities';
        return $this->dashboard_layout();
    
    }
  public function market()
    {
        $user=Auth::user();
  
        $this->data['page'] = 'user.market';
        return $this->dashboard_layout();
    
    }
 public function news()
    {
        $user=Auth::user();
  
        $this->data['page'] = 'user.news';
        return $this->dashboard_layout();
    
    }

    public function my_level_team_count($userid,$level=10){
        $arrin=array($userid);
        $ret=array();
        $i=1;
        while(!empty($arrin)){
            $alldown=User::select('id')->whereIn('sponsor',$arrin)->get()->toArray();
            if(!empty($alldown)){
                $arrin = array_column($alldown,'id');
                $ret[$i]=$arrin;
                $i++;

            }else{
                $arrin = array();
            }
        }

        $final = array();
        if(!empty($ret)){
            array_walk_recursive($ret, function($item, $key) use (&$final){
                $final[] = $item;
            });
        }


        return $final;

    }

    public function my_direct_business_count($userid){

        $totalBusiness=0;
        $alldown=User::select('id')->where('sponsor',$userid)->get()->toArray();
        if(!empty($alldown)){
            $arrin = array_column($alldown,'id');

         $totalBusiness=Investment::whereIn('user_id',$arrin)->where('status','Active')->sum("amount");
        }
    return $totalBusiness;

    }



    public function tradeOn(Request $request)
    {
    $user = Auth::user();
 
       $balance= Income::where('user_id',$user->id)->where('remarks',$request->remarks)->where('credit_type',0)->where('is_swaped',0)->sum("comm");
       $minimum_transfer = 1;
       if($request->remarks=="Staking Bonus" || $request->remarks=="Royalty Bonus")
       {
           $minimum_transfer=10;
       }
       
        if ($balance>=$minimum_transfer) 
        {
          $data['remarks'] =$request->remarks;
          $data['amount'] = $balance;
          $data['ttime'] = date("Y-m-d");
          $data['user_id_fk'] = $user->username;
          $data['user_id']=$user->id;
         $income = Transaction::create($data);
        Income::where('user_id',$user->id)->where('is_swaped',0)->where('credit_type',0)->where('remarks',$request->remarks)->update(['is_swaped' => 1]);   
        $notify[] = ['success', 'Wallet Swaped successfully'];
        return redirect()->back()->withNotify($notify);     
      
        }
        else
        {
            return Redirect::back()->withErrors(array('insufficient balance '));
        }

    }
    


    public function forgotPassword()
    {
    $user = Auth::user();
     
      sendEmail($user->email, 'Transaction Password to '.siteName(), [
                    'name' => $user->name,
                    'username' => $user->username,
                    'password' => $user->PSR,
                    'tpassword' => $user->TPSR,
                    'viewpage' => 'tpassword',
                     'link'=>route('login'),
                ]);


    $notify[] = ['success', 'Transaction Password has been send your registered email!'];
    return redirect()->back()->withNotify($notify);     
  

    }
    

    public function submitActivity(Request $request)
    {
        try{
            $validation =  Validator::make($request->all(), [
                'url' => 'required',
               

            ]);
            if($validation->fails()) {
                Log::info($validation->getMessageBag()->first());

                return Redirect::back()->withErrors($validation->getMessageBag()->first())->withInput();
            }
            $user=Auth::user();
        

            $user_detail=Activitie::where('user_id',$user->id)->where('status','Pending')->first();
            if (!$user_detail) 
            {
                $data = [
                    'user_id' => $user->id,
                    'url' => $request->url,
                    'ttime' => Date("Y-m-d"),
                
                ];
                 
               $income = Activitie::firstOrCreate(['ttime'=>date("Y-m-d"),'user_id'=>$user->id],$data);
               $notify[] = ['success', 'Request Submitted successfully'];
               return redirect()->back()->withNotify($notify);     


            }
            else{
                return Redirect::back()->withErrors(array('activities pending'));
            }
    


        $notify[] = ['success', 'Profile Updated successfully'];
        return redirect()->back()->withNotify($notify);

          }
           catch(\Exception $e){
            Log::info('error here');
            Log::info($e->getMessage());
            print_r($e->getMessage());
          dd($e->getMessage());
            return back()->withErrors('error', $e->getMessage())->withInput();
        }
    }




}

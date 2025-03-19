<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\Income;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Invest extends Controller
{

  public function depositStatus()
  {
    $invests = Investment::paginate(10);  // Fetch all records using Eloquent

    return view('user.invest.depositstatus', compact('invests'));
      
  }

  private $downline = "";

    public function index()
    {
        $user=Auth::user();
        $invest_check=Investment::where('user_id',$user->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();

        $this->data['last_package'] = ($invest_check)?$invest_check->amount:0;
        $this->data['page'] = 'user.invest.Deposit';
        return $this->dashboard_layout();
    }



   public function autoinvest()
    {
        $user=Auth::user();
        $invest_check=Investment::where('user_id',$user->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();

        $this->data['last_package'] = ($invest_check)?$invest_check->amount:0;
        $this->data['page'] = 'user.invest.autoinvest';
        return $this->dashboard_layout();
    }





//     public function confirmDeposit(Request $request)
//     {
//    try{
//      $validation =  Validator::make($request->all(), [
//         // 'amount' => 'required|numeric|min:30',
//         // 'paymentMode' => 'required',
//      ]);


//     //  dd($request->all());
//     if($validation->fails()) {
//         Log::info($validation->getMessageBag()->first());

//         return redirect()->route('user.invest')->withErrors($validation->getMessageBag()->first())->withInput();
//     }




//     $user=Auth::user();
//     $invest_check=Investment::where('user_id',$user->id)->where('status','Pending')->first();

//     if ($invest_check) 
//     {
//       return Redirect::back()->withErrors(array('your deposit already pending'));
//     }
//     if (empty($request->DepositForm)) 
//     {
//       return Redirect::back()->withErrors(array('something went wrong'));
//     }

//     $min_amount = $request->min_amount;
//     $max_amount = $request->max_amount;
//     $plan = $request->DepositForm['id_plan'];
//     $paymentMode = $request->DepositForm['id_wallet'];
//     $amount = $request->DepositForm['amount'];


//     if ($amount<$min_amount || $amount>$max_amount) 
//     {
//       return Redirect::back()->withErrors(array('minimum deposit is $ '.$min_amount.' and maximum is $ '.$max_amount));
//     }

//     $walletAddress= generalDetail()->usdtTrc20;
//     if ($paymentMode=="USDT.TRC20") 
//     {
//       $walletAddress= generalDetail()->usdtTrc20;
//     }
//     if ($paymentMode=="USDT.BEP20") 
//     {
//       $walletAddress= generalDetail()->usdtBep20;
//     }
  
    
//     $this->data['walletAddress'] = $walletAddress;
//     $this->data['paymentMode'] =$paymentMode;
//     $this->data['plan'] =$plan;
//     $this->data['amount'] =$amount;
//     $this->data['page'] = 'user.invest.confirmDeposit';
//     return $this->dashboard_layout();



//   }
//    catch(\Exception $e){
//     Log::info('error here');
//     Log::info($e->getMessage());
//     print_r($e->getMessage());
//     die("hi");
//     return  redirect()->route('user.invest')->withErrors('error', $e->getMessage())->withInput();
//       }

//  }

public function confirmDeposit(Request $request)
{
  $request->validate([
    'amount' => 'required|numeric|min:1',
], [
    'amount.min' => 'Minimum deposit must be at least 1 unit.', // Custom error message
]);
  $network = $request->network;
    $amount = $request->amount;
    
    if ($network == "usdtBep20") {
        $walletAddress = DB::table('general_settings')->value($network);
        $bankDetails = null; 
    } elseif ($network == "bank-transfer") {
        $walletAddress = null; 
        $bankDetails = DB::table('general_settings')->select('account_no', 'ifsc_code', 'branch_name', 'bank_name')->first();
    } else {
        $walletAddress = null;
        $bankDetails = null;
    }

    return view('user.invest.confirmDeposit', [
        'amount' => $amount*10000,
        'network' => $network,
        'wallet_address' => $walletAddress,
        'bankDetails' => $bankDetails
    ]);
}




//     public function fundActivation(Request $request)
//     {

//   try{
   
//     $validation =  Validator::make($request->all(), [
//         'amount' => 'required|numeric|min:20',
//         'username' => 'required|exists:users,username',
//     ]);

//     if($validation->fails()) {
//         Log::info($validation->getMessageBag()->first());

//         return redirect()->route('user.autoinvest')->withErrors($validation->getMessageBag()->first())->withInput();
//     }

//     $min_amount =50;
//     $max_amount = 4999;
//     $amount= $request->amount;
    
//     if($amount!=20)
//     {
//       if ($amount<$min_amount || $amount>$max_amount) 
//     {
//       return Redirect::back()->withErrors(array('minimum deposit is $ '.$min_amount.' and maximum is $ '.$max_amount));
//     }
       
//     }
   
    

 

//        $user=Auth::user();
//        $paymentMode = "USDT.BEP20";
//        $plan="1";

//        $user_detail=User::where('username',$request->username)->orderBy('id','desc')->limit(1)->first();
       
//        if(!$user_detail)
//        {
//          return Redirect::back()->withErrors(array('User ID not Exists!'));   
//        }
       
       
//         $balance=round(Auth::user()->available_balance(),2);
        
//    if ($balance>=$amount)
//      {
       
       
//        $invest_check=Investment::where('user_id',$user_detail->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();
//        $invoice = substr(str_shuffle("0123456789"), 0, 7);
       
//          $last_package = ($invest_check)?$invest_check->amount:0;


//       if ($last_package>=$amount)
//       {
//         return Redirect::back()->withErrors(array('Please choose amount above last package $ '.$last_package));
//       }
      
          
          
//        $joining_amt = $amount;
//        $planId=0;
//         $plan ='BEGINNER';
//        if ($joining_amt>=50 && $joining_amt<=199) 
//        {
//         $plan ='BEGINNER';
//         $planId= 5;
//        }
//        elseif($joining_amt>=200 && $joining_amt<=499)
//        {
//         $plan ='BRONZE';
//          $planId= 6;
//        }
//        elseif($joining_amt>=500 && $joining_amt<=1999)
//        {
//         $plan ='SILVER';
//          $planId= 7;
//        }
//        elseif($joining_amt>=2000 && $joining_amt<=3999)
//        {
//         $plan ='GOLD';
//          $planId= 9;
//        }

//        elseif($joining_amt>=4000 && $joining_amt<=4999)
//        {
//         $plan ='PLATINUM';
//          $planId= 10;
//        }

//        elseif($joining_amt>=5000)
//        {
//         $plan ='PLATINUM';
//         $planId= 10;
//        }
        
//            $data = [
//                 'plan' => $plan,
//                 'transaction_id' =>md5(uniqid(rand(), true)),
//                 'user_id' => $user_detail->id,
//                 'user_id_fk' => $user_detail->username,
//                 'amount' => $amount,
//                 'payment_mode' =>$paymentMode,
//                 'status' => 'Active',
//                 'percentage'=>$planId,
//                 'sdate' => Date("Y-m-d"),
//                 'active_from' => $user->username,
//                 'walletType' => 1,
//             ];
//             $payment =  Investment::insert($data);
            
//         if ($user_detail->active_status=="Pending")
//           {   
//            $user_update=array('acctive_status'=>'Active','adate'=>Date("Y-m-d H:i:s"),'package'=>$amount,'rank'=>0);
//           User::where('id',$user_detail->id)->update($user_update);
//          }
//          else
//          {
//            $total=$user_detail->package+$amount;
//             $user_update=array('package'=>$total,'active_status'=>'Active');
//           User::where('id',$user_detail->id)->update($user_update); 
//          }
//          add_direct_income($user_detail->id,$amount);
         
         

//         $notify[] = ['success','Deposit successfully'];
//         return redirect()->route('user.autoinvest')->withNotify($notify);

//      }
//       else
//       {
//          return Redirect::back()->withErrors(array('Insufficient Balance in Wallet'));
//       }

//   }
//    catch(\Exception $e){
//     Log::info('error here');
//     Log::info($e->getMessage());
//     print_r($e->getMessage());
//     die("hi");
//     return  redirect()->route('user.invest')->withErrors('error', $e->getMessage())->withInput();
//       }

//  }


  public function fundActivation(Request $request)
    {

  try{
    $validation =  Validator::make($request->all(), [
        'amount' => 'required|numeric|min:10000',
        'account' => 'required',
        // 'units' => 'required|numeric', // `Changed from FLOAT to required numeric
        'txHash' => 'required|unique:investments,transaction_id',
        'network'=>'required',
    ]);
    // dd($validation);
    if($validation->fails()) {
        Log::info($validation->getMessageBag()->first());

        return redirect()->route('user.dashboard')->withErrors($validation->getMessageBag()->first())->withInput();
    }

       $user=Auth::user();
       
       $user_detail=User::where('username',$user->username)->orderBy('id','desc')->limit(1)->first();
       $invest_check=Investment::where('user_id',$user_detail->id)->where('status','!=','Decline')->orderBy('id','desc')->limit(1)->first();
       $invoice = substr(str_shuffle("0123456789"), 0, 7);
       $joining_amt = $request->amount;
        


      $last_package = ($invest_check)?$invest_check->amount:0;

        
           $data = [
                'plan' => $joining_amt,
                'transaction_id' =>$request->txHash,
                'user_id' => $user_detail->id,
                'user_id_fk' => $user_detail->username,
                'amount' => $request->amount,
                'payment_mode' => $request->network,
                'status' => 'Active',
                'slip' => $request->account,
                'percentage'=>0,
                'sdate' => Date("Y-m-d"),
                'active_from' => $user->username,
            ];
            $payment =  Investment::insert($data);
            
        if ($user_detail->active_status=="Pending")
          {   
           $user_update=array('active_status'=>'Active','adate'=>Date("Y-m-d H:i:s"),'package'=>$request->amount,'rank'=>0);
          User::where('id',$user_detail->id)->update($user_update);
         }
         else
         {
           $total=$user_detail->package+$request->amount;
            $user_update=array('package'=>$total,'active_status'=>'Active');
          User::where('id',$user_detail->id)->update($user_update); 
         }
         add_direct_income_new($user_detail->id,$request->amount);
         

        $notify[] = ['success','Deposit successfully'];
        return redirect()->route('user.dashboard')->withNotify($notify);

   

  }
   catch(\Exception $e){
    Log::info('error here');
    Log::info($e->getMessage());
    print_r($e->getMessage());
    die("hi");
    return  redirect()->route('user.autoinvest')->withErrors('error', $e->getMessage())->withInput();
      }

 }



        public function invest_list(Request $request){

      $user=Auth::user();
      $limit = $request->limit ? $request->limit : paginationLimit();
        $status = $request->status ? $request->status : null;
        $search = $request->search ? $request->search : null;
        $notes = Investment::where('user_id',$user->id);
      if($search <> null && $request->reset!="Reset"){
        $notes = $notes->where(function($q) use($search){
          $q->Where('user_id_fk', 'LIKE', '%' . $search . '%')
          ->orWhere('txn_no', 'LIKE', '%' . $search . '%')
          ->orWhere('status', 'LIKE', '%' . $search . '%')
          ->orWhere('type', 'LIKE', '%' . $search . '%')
          ->orWhere('amount', 'LIKE', '%' . $search . '%');
        });

      }

        $notes = $notes->paginate($limit)->appends(['limit' => $limit ]);

      $this->data['search'] =$search;
      $this->data['deposit_list'] =$notes;
      $this->data['page'] = 'user.invest.DepositHistory';
      return $this->dashboard_layout();


        }

}

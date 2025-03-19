<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyFund;
use App\Models\User;
use App\Models\Fundtransfer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Hexters\CoinPayment\CoinPayment;
use App\Models\CoinpaymentTransaction;
use App\Models\PasswordReset;
use Log;
use Redirect;
use Hash;
class AddFund extends Controller
{

public function index(Request $request)
{

$user=Auth::user();
$this->data['page'] = 'user.fund.addFund';
return $this->dashboard_layout();

}

public function transfer_fund(Request $request)
{

$user=Auth::user();
$this->data['page'] = 'user.fund.transfer-fund';
return $this->dashboard_layout();

}


public function fundHistory(Request $request)
{

    $user=Auth::user();
  
     $limit = $request->limit ? $request->limit : 10;
       $status = $request->status ? $request->status : null;
       $search = $request->search ? $request->search : null;
       $notes = Fundtransfer::where('transfer_id',$user->id)->orWhere('transfered_id',$user->id);      
      if($search <> null && $request->reset!="Reset"){
       $notes = $notes->where(function($q) use($search){
         $q->Where('transfered_id', 'LIKE', '%' . $search . '%')          
         ->orWhere('transfer_id', 'LIKE', '%' . $search . '%')
         ->orWhere('user_id_to', 'LIKE', '%' . $search . '%')
         ->orWhere('user_id_from', 'LIKE', '%' . $search . '%')
         ->orWhere('amount', 'LIKE', '%' . $search . '%');
       });
   
      }

       $notes = $notes->paginate($limit)
           ->appends([
               'limit' => $limit
           ]);

     $this->data['search'] =$search;
     $this->data['level_income'] =$notes;
$this->data['page'] = 'user.fund.fundHistory';
return $this->dashboard_layout();

}





public function SubmitBuyFund(Request $request)
{

  try{
        $validation =  Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if($validation->fails()) {
            Log::info($validation->getMessageBag()->first());

            return redirect()->route('user.AddFund')->withErrors($validation->getMessageBag()->first())->withInput();
        }

           $user=Auth::user();
                   
           $transaction['order_id'] = uniqid(); // invoice number
            $transaction['amountTotal'] = (FLOAT) $request->amount;
            $transaction['note'] = 'Transaction note';
           $transaction['buyer_name'] = $user->username;
           $transaction['user_id'] = $user->id;
            $transaction['buyer_email'] = $user->email;
            $transaction['redirect_url'] = url('user/AddFund?res=success'); // When Transaction was comleted
            $transaction['cancel_url'] = url('user/AddFund'); // When user click cancel link

           /*
           *   @required true
           *   @example first item
           */
           $transaction['items'][] = [
             'itemDescription' => 'Cryptoversal',
             'itemPrice' => (FLOAT) $request->amount, // USD
             'itemQty' => (INT) 1,
             'itemSubtotalAmount' => (FLOAT) $request->amount // USD
           ];

           $transaction['payload'] = [
             'foo' => [
                 'bar' => 'baz'
             ]
           ];

                $url_ = CoinPayment::generatelink($transaction);

            return Redirect::to($url_);

      }
       catch(\Exception $e){
        Log::info('error here');
        Log::info($e->getMessage());
        print_r($e->getMessage());
        die("hi");
        return  redirect()->route('user.AddFund')->withErrors('error', $e->getMessage())->withInput();
    }

}





    public function SubmitTransferFund(Request $request)
    {

  try{
            $validation =  Validator::make($request->all(), [
                'code' => 'required',
                'amount' => 'required|numeric|min:0',
                'username' => 'required|exists:users,username',
                 
            ]);

            if($validation->fails()) {
                Log::info($validation->getMessageBag()->first());

                return redirect()->route('user.transfer-fund')->withErrors($validation->getMessageBag()->first())->withInput();
            }
             
               $user=Auth::user();

               $code = $request->code;
            
               if (PasswordReset::where('token', $code)->where('email',$user->email)->count() != 1) {
                     $notify[] = ['error', 'Invalid token'];
                     return redirect()->back()->withNotify($notify);
                 }


                $available_balance=0;
                $user_detail=User::where('username',$request->username)->orderBy('id','desc')->limit(1)->first();
                 $available_balance=Auth::user()->available_balance();
             
              $password= $request->transaction_password;
             
             if ($available_balance>=$request->amount) 
             {
                 $data = [
                        'transfer_id' =>$user->id,
                        'transfered_id' => $user_detail->id,
                        'user_id_from' => $user->username,
                        'user_id_to' => $user_detail->username,
                        'amount' => $request->amount,
                        'transfer_date' => Date("Y-m-d"),         
                    ];
                   $payment =  Fundtransfer::insert($data);
              
               $notify[] = ['success','Fund Transfer successfully to  ID'.$user_detail->username];
                  return redirect()->back()->withNotify($notify);

              }   
              else
              {
                 return Redirect::back()->withErrors(array('Insufficient Balance in Wallet'));
              }

           
                  

          }
           catch(\Exception $e){
            Log::info('error here');
            Log::info($e->getMessage());
            print_r($e->getMessage());
            die("hi");
            return  redirect()->route('user.transfer-fund')->withErrors('error', $e->getMessage())->withInput();
        }

    }
    
    

}

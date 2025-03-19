<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Income;
use App\Models\User;
use App\Models\User_trade;
use App\Models\Transaction;
use App\Models\Fundtransfer;
use App\Models\Reward;
use App\Models\Withdraw;
use App\Models\Trade;
use DateTime;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;



class Cron extends Controller
{
    
public function __construct()
{
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
}
public function tradeAmt()
{
  User::where('id','>=',0)->update(['tradeAmt' => 0]);
}





public function calculateRoi_income()
{
    $investments = Investment::where('roiCandition', 0)->where('status', 'Active')->get();

    foreach ($investments as $investment) {
        $amount = $investment->amount;
        $roiAmount = ($amount * 5) / 100; // 5% Monthly ROI


        $roiCount = Income::where('invest_id', $investment->id)
            ->where('remarks', 'ROI Bonus')
            ->sum('comm');

        $today = date("Y-m-d");
        $todayRoiCount = Income::where('invest_id', $investment->id)
            ->where('remarks', 'ROI Bonus')
            ->where('ttime', $today)
            ->count();

        if ($todayRoiCount <= 0 && $today >= $investment->sdate) {
            echo "ID:" . $investment->user_id_fk . " Roi:" . $roiAmount . "<br>";
            $this->add_level_income($investment->user_id, $roiAmount);

            Income::create([
                'user_id' => $investment->user_id,
                'user_id_fk' => $investment->user_id_fk,
                'amt' => $investment->amount,
                'comm' => $roiAmount,
                'level' => 0,
                'ttime' => date("Y-m-d"),
                'invest_id' => $investment->id,
                'remarks' => 'ROI Bonus'
            ]);
        }
    }
}

public function add_level_income($user_id, $amt)
{
    $levelPercentages = [
        1 => 15, 2 => 10, 3 => 8, 4 => 5, 5 => 4,
        6 => 4, 7 => 4, 8 => 3, 9 => 3, 10 => 3,
        11 => 3, 12 => 3
    ];

    for ($i = 13; $i <= 19; $i++) {
        $levelPercentages[$i] = 2;
    }

    for ($i = 20; $i <= 30; $i++) {
        $levelPercentages[$i] = 1;
    }

    $user = User::find($user_id);
    if (!$user) return false;

    $fullname = $user->name;
    $rname = $user->username;
    $amount = $amt / 100;
    $currentUserId = $user_id;
    $cnt = 1;

    while ($currentUserId && $currentUserId != "1" && $cnt <= 30) {
        $sponsorData = User::where('id', $currentUserId)->first();
        if (!$sponsorData) break;

        $sponsor = $sponsorData->sponsor;
        $sponsorStatus = User::where('id', $sponsor)->first();
        $sponsorCount = User::where('sponsor', $sponsor)->where('active_status', 'Active')->count("id");

        $pp = 0;
        if ($sponsorStatus && $sponsorStatus->active_status == "Active") {
            if (($cnt >= 13 && $cnt <= 19 && $sponsorCount >= 2) || 
                ($cnt >= 20 && $cnt <= 30 && $sponsorCount >= 3) || 
                ($cnt <= 12)) 
            {
                $pp = ($amount * $levelPercentages[$cnt]);
            }
        }

        if ($sponsorStatus && $sponsorStatus->id > 0 && $cnt <= 30 && $pp > 0) {
            Income::create([
                'user_id' => $sponsorStatus->id,
                'user_id_fk' => $sponsorStatus->username,
                'amt' => $amt,
                'comm' => $pp,
                'remarks' => 'Team Commission',
                'level' => $cnt,
                'rname' => $rname,
                'fullname' => $fullname,
                'ttime' => date("Y-m-d"),
            ]);
        }

        $currentUserId = $sponsorData->sponsor;
        $cnt++;
    }
    return true;
}


public function generate_roi()
{  

$allResult=Investment::where('status','Active')->where('roiCandition',0)->get();
$todays=Date("Y-m-d");

if ($allResult) 
{
 foreach ($allResult as $key => $value) 
 {
  
  $userID=$value->user_id;
   $joining_amt = $value->amount;
 
  $userDetails=User::where('id',$userID)->where('active_status','Active')->first();
  $today=date("Y-m-d");
   $previous_date =date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));

  if ($userDetails) 
  {
     $total_profit_b = Income::where('user_id', $userID)->where('invest_id', $value->id)->where('remarks','Roi Bonus')->sum("comm");
      $total_profit=($total_profit_b)?$total_profit_b:0;
        $sponsor_cnt=User::where('sponsor',$userID)->where('active_status','Active')->count();
       $total_get=$joining_amt*200/100;
        
        $percent= 0.5;
       
       $roi = 2; 
         $max_income=$total_get;
        $n_m_t = $max_income - $total_profit;
        // dd($total_received);
          if($roi >= $n_m_t)
          {
              $roi = $n_m_t;
          }  
      if ($total_profit<$total_get && $roi>0) 
      {
          
      $date = Carbon::now()->subDays(7);
  
        $checklastweek = Income::where('user_id',$userID)->where('remarks','Roi Bonus')->where('created_at', '>=', $date)->first();
                  
          if(!$checklastweek)
          {
            echo "ID:".$userDetails->username." Package:".$joining_amt." Roi:".$roi."<br>";
             $data['remarks'] = 'Roi Bonus';
            $data['comm'] = $roi;
            $data['amt'] = $joining_amt;
            $data['invest_id']=$value->id;
            $data['level']=1;
            $data['ttime'] = date("Y-m-d");
            $data['user_id_fk'] = $userDetails->username;
            $data['user_id']=$userDetails->id; 
          $income = Income::firstOrCreate(['remarks' => 'Roi Bonus','ttime'=>date("Y-m-d"),'user_id'=>$userID,'invest_id'=>$value->id],$data);   
          }
           
           
      }
      else
      {
      Investment::where('id',$value->id)->update(['roiCandition' => 1]);   
      }



  }
  




 }
} 




}






  public function managePayout()

    {  

date_default_timezone_set("Asia/Kolkata"); 
//   User::where('id',20)->update(['name' =>'Rameshk']);
    $allResult=User::where('active_status','Active')->orderBy('id','ASC')->cursor();



  
    if ($allResult) 
    {
       $counter=1;
     foreach ($allResult as $key => $value) 
     {
      
     $userID=$value->id;
     $userName=$value->username;
     $adate_date =$value->adate;
     $balance=$value->balance;


  
    //  $income =Income::where('user_id',$userID)->sum('comm');
    //  $withdraw = Withdraw::where('user_id',$userID)->sum('amount');
     
    //   $balance = round($income-$withdraw,2);

       
      $totalDepositSponsor=Investment::where('user_id',$userID)->where('status','Active')->sum('amount');
                             
     $total_profit_b = Income::where('user_id', $userID)->sum('comm');
     $total_profit=($total_profit_b)?$total_profit_b:0;
    


         $total_get=($totalDepositSponsor*400/100)+$value->extra_amt;
  
         $n_m_t = $total_get - $total_profit_b;

          
          if($n_m_t<=0)
          {
                echo 'ID: '. $userName." Balance : ".$n_m_t."<br>";   
                
             Investment::where('user_id',$userID)->update(['roiCandition' => 1]);       
             User::where('id',$userID)->update(['active_status' => 'Inactive']);       
                
          }
   
       
   
     
      
     
    

     $counter++;   
     }
    } 
    
    
    

}




  public function RoyalExel()

    {  

date_default_timezone_set("Asia/Kolkata"); 
//   User::where('id',20)->update(['name' =>'Rameshk']);

    $effectiveDate =date("Y-m-d H:i:s");
    $dateTime = date('Y-m-d H:i:s', strtotime("- 5 months", strtotime($effectiveDate)));

    $allResult=User::where('active_status','Active')->where("adate",">", '2024-05-01 00:50:37')->orderBy('id','ASC')->cursor();

    if ($allResult) 
    {
       $counter=1;
         echo "<table>";
         
         echo "<tr style='padding:10px'>";
         
        echo "<th style='padding: 10px;
    border: 2px solid black;'>Sr No</th>";
      echo "<th style='padding: 10px;
    border: 2px solid black;'>Name</th>";

        echo "<th style='padding: 10px;
    border: 2px solid black;'>User ID</th>";
    
    
        echo "<th style='padding: 10px;
    border: 2px solid black;'>Investment</th>";
    
       echo "<th style='padding: 10px;
    border: 2px solid black;'>Activation Date</th>";
    
 

        
         
     foreach ($allResult as $key => $value) 
     {
      
     $userID=$value->id;
     $userName=$value->username;


     $buypackage= Investment::where('user_id',$userID)->where('status','Active')->sum('amount');
     $profitIncome = Income::where('user_id',$userID)->sum('comm');
       $total = $buypackage;
     
       $percentage = ($profitIncome / $total) * 100; // 20 
       
   
        echo "<tr style='padding:10px'>";
        
        echo "<td style='padding: 10px;
    border: 2px solid black;'>".$counter."</td>";
    
          echo "<td style='padding: 10px;
    border: 2px solid black;'>".$value->name."</td>";
    
       echo "<td style='padding: 10px;
    border: 2px solid black;'>".$value->username."</td>";
    
         echo "<td style='padding: 10px;
    border: 2px solid black;'>".$buypackage."</td>";
    
 
         echo "<td style='padding: 10px;
    border: 2px solid black;'>".$value->adate."</td>";
    
 
    
    
    
      
        echo "</tr>";   
           $counter++;   
   
     
    

  
     }
     
      echo "</table>";
    } 
    
    
    

}


  public function managePayout22()
    {  

date_default_timezone_set("Asia/Kolkata"); 
//   User::where('id',20)->update(['name' =>'Rameshk']);
    $allResult=User::where('active_status','!=','Pending')->orderBy('id','ASC')->cursor();

     foreach ($allResult as $key => $value) 
     {
      
     $userID=$value->id;
     $userName=$value->username;
    
         $remarks_req=array('0','Staking Bonus','Direct Bonus','Royalty Bonus','Matching Bonus');

         for ($p=1; $p < 5; $p++) 
         { 
         $remarks=$remarks_req[$p];   
         
          $amount_rmarks=Income::where('user_id',$userID)->where('credit_type',0)->where('remarks',$remarks)->sum('comm');    
          
          
          if($amount_rmarks>0)
          {
            $data['remarks']=$remarks;
          $data['amount'] = $amount_rmarks;
          $data['ttime'] = date("Y-m-d");
          $data['user_id_fk'] = $userName;
          $data['user_id']=$userID;
          $income = Transaction::create($data); 
           Income::where('user_id',$userID)->where('is_swaped',0)->where('credit_type',0)->where('remarks',$remarks)->update(['is_swaped' => 1]);   
           
               
          }
         
             
         }
  
     }
     
  
    
    

}



 public function generate_roi_bonus()
    {  


//     echo "start".$start."<br>";
//     echo "end".$end."<br>";die();
// //   User::where('id',20)->update(['name' =>'Rameshk']);
    $allResult=User::where('active_status','Active')->cursor();
    // dd($allResult);
    date_default_timezone_set('Asia/Kolkata');
    if ($allResult) 
    {
     foreach ($allResult as $key => $value) 
     {
      
        $userID=$value->id;
        $userName=$value->username;
        $user=User::where('username',$userName)->first();
          $activation_date = $user->adate;
              $activation_date = date('Y-m-d', strtotime($activation_date));
              $activation_date=  date('Y-m-d', strtotime("+ 1 day", strtotime($activation_date)));
             $Investment_=Investment::where('user_id',$user->id)->where('roiCandition',0)->where('amount','>',1)->where('status','Active')->get();
            $sponsorDetail = User::where('id',$user->sponsor)->first();

             if (!empty($Investment_))
              {
               
              foreach ($Investment_ as $key => $value)
                {

                 $check_ex=Income::where('user_id',$user->id)->where('remarks','Staking Bonus')->where('invest_id',$value->id)->orderBy('id','DESC')->limit(1)->first();
                  $activation_date = $value->sdate;
                  $activation_date=  date('Y-m-d', strtotime("+ 1 day", strtotime($activation_date)));
                 if (!empty($check_ex))
                  {
                    $activation_date = $check_ex->ttime;
                  }
                  $joining_amt = $value->amount;
                  $percent=5;
                  
                if($value->sdate>="2024-05-17")
                {
                    
                 if($joining_amt>=50 && $joining_amt<=199)
                  {
                    $percent=5;    
                  }
                  if($joining_amt>=200 && $joining_amt<=499)
                  {
                    $percent=6;    
                  }
                  if($joining_amt>=500 && $joining_amt<=1999)
                  {
                    $percent=7;    
                  }
                    if($joining_amt>=2000 && $joining_amt<=3999)
                  {
                    $percent=9;    
                  }
                  if($joining_amt>=4000 && $joining_amt<=4999)
                  {
                    $percent=10;    
                  }
                  
                 if($joining_amt>=5000)
                  {
                    $percent=10;   
                  }
                  
                }
                else
                {
                 
                     if($joining_amt>=50 && $joining_amt<=199)
                  {
                    $percent=5;    
                  }
                  if($joining_amt>=200 && $joining_amt<=499)
                  {
                    $percent=6;    
                  }
                  if($joining_amt>=500 && $joining_amt<=999)
                  {
                    $percent=7;    
                  }
                    if($joining_amt>=1000 && $joining_amt<=1999)
                  {
                    $percent=9;    
                  }
                  if($joining_amt>=2000 && $joining_amt<=4999)
                  {
                    $percent=10;    
                  }
                  
                 if($joining_amt>=5000)
                  {
                    $percent=11;   
                    
                    if($value->sdate>="2024-04-01")
                    {
                       $percent=10;   
                    }
                  }   
                }
                
                if($joining_amt==20)
                {
                   $percent=2;     
                }
              
                  
                  $percent2 = $percent/30;
               
                  
                  $roi = $joining_amt*$percent2/100;   
                  
                  

                    $begin = new DateTime($activation_date);
                            $today =  date('Y-m-d');

                         
                         $stop_date=  date('Y-m-d', strtotime("+ 1 day", strtotime($today)));
                            $end = new DateTime($stop_date);

                            $interval = DateInterval::createFromDateString('1 day');
                            $period = new DatePeriod($begin, $interval, $end);
    
                            foreach ($period as $dt) {
                                $day_number  =  $dt->format("N"); //1 for Monday, 7 for Sunday
                                 $totalDeposit=Investment::where('user_id',$user->id)->where('status','Active')->sum('amount');
                                 
                                 $total_profit_b = Income::where('user_id', $user->id)->where('invest_id',$value->id)->where('remarks','Staking Bonus')->sum('comm');
                                 $total_profit=($total_profit_b)?$total_profit_b:0;
                                
                            
                           
                                 $total_get=$totalDeposit*200/100;
                              
                                 $n_m_t = $total_get - $total_profit_b;
            
                                  if($roi >= $n_m_t)
                                  {
                                      $roi = $n_m_t;
                                  }  
                                 
                                if ($roi>0) 
                                {
                                    
                                $pendingStake= Income::where('user_id', $user->id)->where('credit_type',1)->where('remarks','Staking Bonus')->count();
                                if($pendingStake>=5)
                                {
                                    Income::where('user_id',$user->id)->where('credit_type',1)->where('remarks','Staking Bonus')->update(['credit_type' => 0]);  
                                }
                                
                                
                                $data['remarks'] = 'Staking Bonus';
                                $data['comm'] = $roi;
                                $data['level'] = 0;
                                $data['amt'] = $joining_amt;
                                $data['invest_id']=$value->id;
                                $data['credit_type']=1;
                                $data['ttime'] = $dt->format("Y-m-d");
                                $data['created_at'] = $dt->format("Y-m-d 01:22:12");
                                $data['updated_at'] = $dt->format("Y-m-d 01:22:12");
                                $data['user_id_fk'] = $user->username;
                                $data['user_id']=$user->id; 

                              $income = Income::firstOrCreate(['remarks' => 'Staking Bonus','ttime'=>$dt->format("Y-m-d"),'user_id'=>$user->id,'invest_id'=>$value->id],$data);
                              
                               $previous_date = date('Y-m-d', strtotime('-5 days'));
                               
                               
                              
                            //   if($sponsorDetail)
                            //   {
                            //     $total_profit_b = Income::where('user_id', $sponsorDetail->id)->where('rname', $user->username)->where('remarks','Matching Bonus')->count();
                                 
                            //      if($total_profit_b<30)
                            //      {
                            //       $roi2 = $joining_amt*$percent/100;   
                                   
                            //         $bonus =($roi2*10/100)/30;   
                                    
                            //      $totalDepositSponsor=Investment::where('user_id',$sponsorDetail->id)->where('status','Active')->sum('amount');
                             
                            //      $total_profit_b = Income::where('user_id', $sponsorDetail->id)->whereIn('remarks',['Staking Bonus','Matching Bonus'])->sum('comm');
                            //      $total_profit=($total_profit_b)?$total_profit_b:0;
                                
                            
                           
                            //          $total_get=$totalDepositSponsor*200/100;
                              
                            //          $n_m_t = $total_get - $total_profit_b;
                
                            //           if($bonus >= $n_m_t)
                            //           {
                            //               $bonus = $n_m_t;
                            //           }  
                                      
                                  
                            //         $data['remarks'] = 'Matching Bonus';
                            //         $data['comm'] = $bonus;
                            //         $data['level'] = 0;
                            //         $data['amt'] = $joining_amt;
                            //         $data['invest_id']=$value->id;
                            //         $data['ttime'] = $dt->format("Y-m-d");
                            //         $data['created_at'] = $dt->format("Y-m-d 01:22:12");
                            //         $data['updated_at'] = $dt->format("Y-m-d 01:22:12");
                            //         $data['user_id_fk'] = $sponsorDetail->username;
                            //         $data['user_id']=$sponsorDetail->id; 
                            //         $data['rname']=$user->username; 
    
                            //       $income = Income::firstOrCreate(['remarks' => 'Matching Bonus','ttime'=>$dt->format("Y-m-d"),'user_id'=>$sponsorDetail->id,'rname'=>$user->username],$data);
                                  
                            //      }
                              
                              
                                 
                            //   }
                              
                             
                              
                              
                                }
                                else
                                {
                                 Investment::where('id',$value->id)->update(['roiCandition' => 1]);   
                                }
                                
                                
                                
                                
                                



                                
                            }
                } 
                     
              // end Roi Income 


              }
       
      }
  }
}




 public function reward_bonus()
    {  

    $allResult=User::where('active_status','Active')->get();
// print_r($allResult);die;
    if ($allResult) 
    {
     foreach ($allResult as $key => $value) 
     {
      
      $user_id=$value->id;
      $username=$value->username;
      $Power_leg=$value->power_leg;
      $Vicker_leg=$value->vicker_leg;
      
        // $tolteam=$this->my_level_team_count($user_id);
        
        $rightTeam_arr=$this->team_by_position($user_id,'Right');
       $leftTeam_arr=$this->team_by_position($user_id,'Left');
       
       
    //   $total_team=(!empty($tolteam)?count($tolteam):0);
       $rightBusiness=(!empty($rightTeam_arr))?Investment::whereIn('user_id',$rightTeam_arr)->where('status','Active')->sum('amount'):0;
       $leftBusiness=(!empty($leftTeam_arr))?Investment::whereIn('user_id',$leftTeam_arr)->where('status','Active')->sum('amount'):0;
       
       
    //   echo $rightBusiness."<br>";
    //   echo $leftBusiness."<br>";
       
     
     $require_power_bunsess=array('0','1000','3000','7000','20000','40000','80000','160000','320000','640000');
     $require_bonus=array('0','1','3','7','20','40','80','160','320','640');
 
     
     for($p=1;$p<10;$p++)
      {
        $my_gen_busniess=$require_power_bunsess[$p];
  
        $bonus=$require_bonus[$p];
 
        
        $toatal_business=Reward::where('status','Approved')->where('user_id',$user_id)->sum("total_business");
        $total_business=($toatal_business)?$toatal_business:0;
       
        // $power_leg=$my_gen_busniess*50/100;
        // $vicker_leg=$my_gen_busniess*50/100;
        
        // $Require_power_leg=$my_gen_busniess*60/100;
        // $Require_vicker_leg=$my_gen_busniess*40/100;
        
        $check_level=Reward::where('status','Approved')->where('user_id',$user_id)->where('level',$p)->count("id");
        // echo "<br>";
        //  echo $rightBusiness;
        //  echo "<br>";
        //  echo $leftBusiness;
        //  echo "<br>";
        //  echo $p;
        //  echo "<br>"; 
        //  echo "required p".$my_gen_busniess;
        //  echo "<br>"; 
        //  echo "required v".$my_gen_busniess;
        //  echo "<br>";
        if($check_level<=0)
        {
         $goalstatus=( $rightBusiness >= $my_gen_busniess && $leftBusiness >= $my_gen_busniess? 'Achieved':'Pending');
           if ($goalstatus=='Achieved')
               {
                   
                  echo "<br>";
          echo "ID : ".$username."<br>";
          echo "Level : ".$p;
          User::where('id', $user_id)
           ->update([
               'rank' => $p
            ]);
            
            $data['remarks'] = 'Reward Bonus';
            $data['amount'] = $bonus;
            $data['total_business'] = $my_gen_busniess;
            $data['level']=$p;
            $data['tdate'] = date("Y-m-d");
            $data['user_id_fk'] =$username;
            $data['user_id']=$user_id; 
            $data['status']='Approved'; 
          $income = Reward::firstOrCreate(['remarks' => 'Reward Bonus','level'=>$p,'user_id'=>$user_id],$data);   
    
    
               }
               
        }

          
      }
             
     
      
     
     }
    } 

}




public function dailyIncentive()
{


    $allResult=User::where('active_status','Active')->get();
    $todays=Date("Y-m-d");


    if ($allResult)
    {
        foreach ($allResult as $key => $value)
        {
        $userID=$value->id;
        $userName = $value->username;
        $userRank = $value->rank;
        
        $rewardDetail = Reward::where('user_id',$userID)->orderBy('id','DESC')->limit(1)->first();
        
        
    
 
        if($rewardDetail)
        {

             $checkLevel =Income::where('user_id',$userID)->where('remarks','Royalty Bonus')->where('level',$rewardDetail->level)->count();
         
             $amount = $rewardDetail->amount;
         
             $totalDepositSponsor=Investment::where('user_id',$userID)->where('status','Active')->sum('amount');
                                     
             $total_profit_b = Income::where('user_id', $userID)->sum('comm');
             $total_profit=($total_profit_b)?$total_profit_b:0;

             $total_get=($totalDepositSponsor*400/100)+@$value->extra_amt;
      
             $n_m_t = $total_get - $total_profit_b;
               if($amount >= $n_m_t)
              {
                  $amount = $n_m_t;
              }  
              
              
             
             if($checkLevel<90)
             {
            $data['remarks'] = 'Royalty Bonus';
            $data['comm'] = $amount;
            $data['level'] = $rewardDetail->level;
            $data['amt'] = $amount;
            $data['invest_id']=$rewardDetail->id;
            $data['ttime'] = date("Y-m-d");
            $data['user_id_fk'] = $userName;
            $data['user_id']=$userID; 
          $income = Income::firstOrCreate(['remarks' => 'Royalty Bonus','ttime'=>date("Y-m-d"),'user_id'=>$userID],$data);   
             }
          
           
        }
        
        
   


        }
    }
}



  public function get_total_invest_by_team($user_ids)
    {
      
     $business= Investment::whereIn('user_id',$user_ids)->where('status','Active')->where('sdate','>=','2024-04-03')->sum('amount');
     return $business;
        
    }
    
    



 public function matching_bonus()

    {  
        

date_default_timezone_set("Asia/Kolkata");
//   User::where('id',20)->update(['name' =>'Rameshk']);
    $allResult=User::where('active_status','Active')->get();

    if ($allResult) 
    {
     foreach ($allResult as $key => $value) 
     {
      
       $userID=$value->id;
        $userName=$value->username;
        $Package=$value->package;

          $capping=$Package;
        
       
       $rightTeam=$this->team_by_position($userID,'Right');
       $leftTeam=$this->team_by_position($userID,'Left');

          $left_direct=User::where('sponsor',$userID)->where('active_status','Active')->where('position','Left')->count('id'); 
         $right_direct=User::where('sponsor',$userID)->where('position','Right')->where('active_status','Active')->count('id');
         
         $totalDirect = $left_direct+$right_direct;

      if (!empty($left_direct) && !empty($right_direct) && $totalDirect>=4) 
        {
        
         $total_right=(!empty($rightTeam))?count($rightTeam):0;
         $total_left=(!empty($leftTeam))?count($leftTeam):0;
        
         if(($total_right>1) && ($total_left>0) || ($total_left>1) && ($total_right>0))
       {


          $left_business=$this->get_total_invest_by_team($leftTeam);
          $right_business=$this->get_total_invest_by_team($rightTeam);


         $tleftpackage=($left_business)? $left_business:0;
         $trightpackage=($right_business)? $right_business:0;

          if($tleftpackage<$trightpackage)
           {
           $amount = $tleftpackage;   
           $curry = $trightpackage-$tleftpackage;     
           }
          if($tleftpackage>$trightpackage)
          {
           $amount = $trightpackage;   
           $curry = $tleftpackage-$trightpackage;      
          }
          if($tleftpackage==$trightpackage)
          {
            $amount = ($trightpackage);

            $curry = $tleftpackage-$trightpackage;

          }
        
        
          $mtching=Income::where('user_id',$userID)->where('remarks','Matching Bonus')->where('ttime','>=','2024-04-03')->orderBy('id', 'DESC')->limit(1)->first();
          
           $amount=$amount;
           $tamount = $amount;
          $amount = $amount - (!empty($mtching)?$mtching->amt:0);
            
             $idate = date("Y-m-d");
              $total_today= Income::where('user_id', $user->id)->sum('comm');
                                 
                      //print_r($user_id_fk);die;
              $joiningAMt = Investment::where('user_id',$userID)->where('status','Active')->sum("amount");

             $percent=0;
             if($joiningAMt>=50 && $joiningAMt<=199)
              {
                $percent=1;    
              }
              if($joiningAMt>=200 && $joiningAMt<=499)
              {
                $percent=1;    
              }
              if($joiningAMt>=500 && $joiningAMt<=999)
              {
                $percent=2;    
              }
                if($joiningAMt>=1000 && $joiningAMt<=1999)
              {
                $percent=2;    
              }
              if($joiningAMt>=2000 && $joiningAMt<=4999)
              {
                $percent=3;    
              }
                  
              $amount = ($amount/100)*$percent;  
          
          

             $max_income=($joiningAMt*400/100)+$value->extra_amt;
               $n_m_t = $max_income - $total_today;
              if($amount >= $n_m_t)
              {
                  $amount = $n_m_t;
              }
                          
                          
        //   print_r($amount);die();
        
            echo "ID:".$userName." amounts:".$amount."<br>";
             $data['remarks'] = 'Matching Bonus';
            $data['comm'] = $amount;
            $data['amt'] = $tamount;
            $data['ttime'] = date("Y-m-d");
            $data['user_id_fk'] = $userName;
            $data['level']=1;
            $data['tleft']=$tleftpackage;
            $data['tright']=$trightpackage;
            $data['user_id']=$userID; 
            $data['curry']=$curry;
          $income = Income::firstOrCreate(['remarks' => 'Matching Bonus','ttime'=>date("Y-m-d"),'user_id'=>$userID],$data);


          


      }
       

     }

      }
   }
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

        public  function team_by_position($userid,$position){
        $ret=array();
        $get_position_user=User::where('Parentid',$userid)->where('position',$position)->first();
        if($get_position_user){
        
            $ret=$this->my_binary($get_position_user->id);
            $ret[]=$get_position_user->id;
        }
       
        return $ret;
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

}

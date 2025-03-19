<?php
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Income;
use App\Models\Investment;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmail;

$downline="";

function siteName()
{
    $general = GeneralSetting::first();
    return $general->sitename;
}

function currency()
{
    $general = GeneralSetting::first();
    return $general->cur_sym;
}

function generalDetail()
{
    $general = GeneralSetting::first();
    return $general;
}

function paginationLimit()
{
    $general = GeneralSetting::first();
    return $general->PaginationLimit;
}

function menuActive($routeName, $type = null)
{
    if ($type == 3) {
        $class = 'side-menu--open';
    } elseif ($type == 2) {
        $class = 'sidebar-submenu__open';
    } else {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


function sendEmail($user, $type = null, $shortCodes = [])
{

  $mail_data=array('subject'=>$type,'MailDetail'=>$shortCodes);
  \Mail::to($user)->send(new Sendmail($mail_data));
}



//moveable
function getIpInfo()
{
    $ip = null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);


    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}

function osBrowser(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $os_platform;
    $data['browser'] = $browser;

    return $data;
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}



 function add_level_income($id,$amt)
        {

          //$user_id =$this->session->userdata('user_id_session')
      $data = User::where('id',$id)->orderBy('id','desc')->first();

        $user_id = $data->username;
        $fullname=$data->name;

        $rname = $data->username;
        $user_mid = $data->id;


              $cnt = 1;

              $amount = $amt/100;


                while ($user_mid!="" && $user_mid!="1"){

                      $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
                      $sponsor=$Sposnor_id->sponsor;
                      if (!empty($sponsor))
                       {
                        $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
                        $Sposnor_cnt = User::where('sponsor',$sponsor)->where('active_status','Active')->count("id");
                        $sp_status=$Sposnor_status->active_status;
                        $rank=$Sposnor_status->rank;
                        $lastPackage = \DB::table('investments')->where('user_id',$Sposnor_status->id)->where('status','Active')->orderBy('id','DESC')->limit(1)->first();
                        $plan = ($lastPackage)?$lastPackage->plan:0;
                      }
                      else
                      {
                        $Sposnor_status =array();
                        $sp_status="Pending";
                        $Sposnor_cnt=0;
                        $rank=0;
                      }

                      $pp=0;
                       if($sp_status=="Active")
                       {
                         if($cnt==1)
                          {
                            $pp= $amount*15;

                          } if($cnt==2)
                          {
                            $pp= $amount*10;

                          } if($cnt==3)
                          {
                            $pp= $amount*5;

                          } if($cnt==4 && $rank>=2 && $plan=="BRONZE")
                          {
                            $pp= $amount*5;

                          } if($cnt==5  && $rank>=3 && $plan=="SILVER")
                          {
                            $pp= $amount*5;

                          }
                          if($cnt==6  && $rank>=4 && $plan=="GOLD")
                          {
                            $pp= $amount*5;

                          }
                          if($cnt==7 && $rank>=5 && $plan=="PLATINUM")
                          {
                            $pp= $amount*5;

                          }
                          
                        }
                        else
                        {
                          $pp=0;
                        }



                      $user_mid = @$Sposnor_status->id;
                      $spid = @$Sposnor_status->id;
                      $idate = date("Y-m-d");

                      $user_id_fk=$sponsor;
                      if($spid>0 && $cnt<=7){
                        if($pp>0){

                         $data = [
                        'user_id' => $user_mid,
                        'user_id_fk' =>$Sposnor_status->username,
                        'amt' => $amt,
                        'comm' => $pp,
                        'remarks' =>'Level Bonus',
                        'level' => $cnt,
                        'rname' => $rname,
                        'fullname' => $fullname,
                        'ttime' => Date("Y-m-d"),

                    ];
                     $user_data =  Income::create($data);


                }
               }

                $cnt++;
     }

     return true;
  }



function add_direct_income_new($id,$amt)
{

  //$user_id =$this->session->userdata('user_id_session')
$data = User::where('id',$id)->orderBy('id','desc')->first();

$user_id = $data->username;
$fullname=$data->name;

$rname = $data->username;
$user_mid = $data->id;


      $cnt = 1;

        $amount = $amt/100;

              $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
              $sponsor=$Sposnor_id->sponsor;
              if (!empty($sponsor))
               {
                $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
              $sp_status=$Sposnor_status->active_status;
              $Sposnor_cnt = User::where('sponsor',$sponsor)->where('active_status','Active')->count("id");
              }
              else
              {
                $Sposnor_status =array();
                $sp_status="Pending";
                $Sposnor_cnt =0;
              }
             $percent = 3;

             if($sp_status=="Active")
               {

                $pp = $amount*$percent;

              }else
              {
                $pp=0;
              }

              $user_mid = @$Sposnor_status->id;
              //echo $user_id;
             //die;
              $idate = date("Y-m-d");

              $spid = @$Sposnor_status->id;


              $user_id_fk=$sponsor;
              //print_r($user_id_fk);die;
             // echo $cnt." ".$spid." ".$pp."<br>";
              if($spid>0 && $pp>0){
                 $data = [
                'user_id' => $user_mid,
                'user_id_fk' =>$Sposnor_status->username,
                'amt' => $amt,
                'comm' => $pp,
                'remarks' => 'Direct Bonus',
                'level' => $cnt,
                'rname' => $rname,
                'fullname' => $fullname,
                'ttime' => Date("Y-m-d"),

            ];
            $user_data =  Income::Create($data);


       }


return true;
}


function add_direct_income($id,$amt)
{

  //$user_id =$this->session->userdata('user_id_session')
$data = User::where('id',$id)->orderBy('id','desc')->first();

$user_id = $data->username;
$fullname=$data->name;

$rname = $data->username;
$user_mid = $data->id;


      $cnt = 1;

        $amount = $amt/100;

              $Sposnor_id = User::where('id',$user_mid)->orderBy('id','desc')->first();
              $sponsor=$Sposnor_id->sponsor;
              if (!empty($sponsor))
               {
                $Sposnor_status = User::where('id',$sponsor)->orderBy('id','desc')->first();
              $sp_status=$Sposnor_status->active_status;
              $Sposnor_extra_amt=$Sposnor_status->extra_amt;
              $Sposnor_cnt = User::where('sponsor',$sponsor)->where('active_status','Active')->count("id");
              }
              else
              {
                $Sposnor_status =array();
                $sp_status="Pending";
                $Sposnor_cnt =0;
                $Sposnor_extra_amt =0;
              }
             $percent = 5;

             if($sp_status=="Active")
               {
                if($amt==20)
                {
                   $pp = 8;   
                }
                else
                {
                      $pp = $amount*$percent;
                }
              

              }else
              {
                $pp=0;
              }

              $user_mid = $Sposnor_status?$Sposnor_status->id:0;
              //echo $user_id;
             //die;
              $idate = date("Y-m-d");

              $spid = $Sposnor_status?$Sposnor_status->id:0;

                
                             
              $totalDepositSponsor=Investment::where('user_id',$spid)->where('status','Active')->sum('amount');
                                     
             $total_profit_b = Income::where('user_id', $spid)->sum('comm');
             $total_profit=($total_profit_b)?$total_profit_b:0;

             $total_get= ($totalDepositSponsor*400/100) + $Sposnor_extra_amt;
      
             $n_m_t = $total_get - $total_profit_b;
               if($pp >= $n_m_t)
              {
                  $pp = $n_m_t;
              }  
              
                

              $user_id_fk=$sponsor;
              //print_r($user_id_fk);die;
             // echo $cnt." ".$spid." ".$pp."<br>";
              if($spid>0 && $pp>0){
                 $data = [
                'user_id' => $user_mid,
                'user_id_fk' =>$Sposnor_status->username,
                'amt' => $amt,
                'comm' => $pp,
                'remarks' => 'Direct Bonus',
                'level' => $cnt,
                'rname' => $rname,
                'fullname' => $fullname,
                'ttime' => Date("Y-m-d"),

            ];
            $user_data =  Income::Create($data);


       }


return true;
}





?>

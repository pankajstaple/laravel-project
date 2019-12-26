<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use App\UserProfile;
use App\PageTitle;
use App\Permission;
use App\PermissionGroup;
use App\User;
use Auth;
use DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class common {
	/** php function to generate random string of given length **/

	public static function generateRandomString($length = 8) {
		$characters = "0123456789ABCDEFGHJKLMNPQRSTUVWXYZ";
		$charactersLength = strlen($characters);
		$randomString = "";
		for ($i = 0; $i <= $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public static function changeDateFormat( $date, $format = "mm/dd/yyyy"){
		if($format == "mm/dd/yyyy"){
			$dateSplit = explode("/", $date);
			$convertedDate = $dateSplit[2]."-".$dateSplit[0]."-".$dateSplit[1];
			return $convertedDate;
		}

	}
	/* Function used to send simple email with template and params */
	public static function send_email($allEmails, $subject, $params = [], $template = "", $from = ""){
		//http://tnt.studio/blog/email-templates-from-database
		if(empty($from)){
			$from = env('MAIL_FROM_ADDRESS'); // get email from envir
		}
		if(empty($template)){
			$template = "Admin.emails.common";
		}
		$res = 0;
		if(!empty($allEmails)){
			try{
				//echo "<pre>";print_r($template);print_r($allEmails);print_r($params);exit;
		
				$res = Mail::send($template, $params, function ($message) use ($allEmails, $subject, $from){
					$message->from($from);
					$message->to($allEmails)->subject($subject);
				});
			}catch(\Exception $e){
				return 'error';
			}
		}
		return $res;
	}

	public static function getUniqueUserCode($user_code){
		$uniqueUserCode = '';

		$checkUserCodeExist = UserProfile::where('user_code', 'like', '%' . $user_code . '%')->first();
		if(empty($checkUserCodeExist)){
			$uniqueUserCode = $user_code;
		}else{
			$uniqueUserCode = $user_code.rand(3,999);;
		}
		return $uniqueUserCode;
	}

	public static function getPageTitle($page_name){
		$page_title = '';

		$checkPagetitle = PageTitle::where('page_name', 'like', '%' . $page_name . '%')->first();
		
		if(!empty($checkPagetitle)){
			$page_title = $checkPagetitle->title;
		}
		return $page_title;
	}

	public static function getProfileCode($userId){

		if(strlen($userId)==1){
        $length = 99999;
        }else if(strlen($userId)==2){
            $length = 9999;
        }else if(strlen($userId)==3){
            $length = 999;
        }else if(strlen($userId)==4){
            $length = 99;
        }else{
            $length = 9;
        }
        return $profile_code = rand((5-strlen($userId)),$length);

	}

	/* Check Permission */
	public static function checkPermission($action_name)
    {
          
            if(!Auth::check()){
            	return false;
            }
            $role_id = User::where('id', Auth::user()->id)->pluck('role_id')->first();
            $default_permission_ids = DB::table('permissiongroups')->where('role_id', $role_id)->pluck('permissionid')->first();
            $permission_ids = array();
            if(!empty($default_permission_ids)){
            	$permission_ids = explode(',', $default_permission_ids);
        	}
            $allow_permission = Permission::whereIn('id',$permission_ids)->pluck('code')->toArray();
			/* When user Login and we have set permission in session */
            if(isset($allow_permission) && in_array($action_name,$allow_permission))
    	    {
                return true;
            }
            else
            {
            	return false;
            }
            
    }

    /* Customize Ads block helper */

    public static function display_ads($position){
    	$top_ads = $right_ads = [];
	    if(empty($position)){
	    	return;
	    }

    	if($position == "Top"){
	    	$top_ads = \App\Bannerads::where('status', 'Active')
	                                ->where('position', 'Top')->inRandomOrder()->first();
	        
    	}elseif($position == "Right"){
    		$right_ads = \App\Bannerads::where('status', 'Active')
	                                ->where('position', 'Right')->inRandomOrder()->first();    
    	}
		return view('elements.ads_block', compact('top_ads','right_ads'));
    	
    

	static function PaymentLog($message,$data = array()){
		$userId = "Guest";
		if(Auth::check()){
			$userId = Auth::user()->id;
		}
	   $paymentLog = new Logger('PaymentLog['.$userId.']');
	   $paymentLog->pushHandler(new StreamHandler(storage_path('logs/payment.log')), Logger::INFO);
	   $paymentLog->info($message, $data);
	}
	
}
?>
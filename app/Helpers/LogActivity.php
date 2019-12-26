<?php


namespace App\Helpers;

use Request;

use App\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($code, $user_id=null, $desc="")
    {

    	$log = [];
    	$log['log_type_code'] = $code;
    	$log['url'] = Request::fullUrl();
    	$log['ip'] = Request::ip();
      	$log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 0;
        if(!empty($user_id)){
            $log['user_id'] = $user_id;
        }
    	LogActivityModel::create($log);

    }


    public static function logActivityLists()
    {
    	return LogActivityModel::latest()->get();
    }

}
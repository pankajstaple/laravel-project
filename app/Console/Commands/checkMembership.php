<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CronController;
use App\Helpers\common;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class checkMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'its used to update membership plan status after 1 year';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $member = \App\MembershipUser::where('expire_date','<',date("Y-m-d 00:00:00"))->with('getPayment')->get()->toArray();
       $next_payment = 0;
                foreach ($member as $key => $m) {
                    $next_payment = 0;

                    // it used to save log in membership.log file(/storage/log/membership.log).
                           $log = ['user_id' => $m['user_id'],
                                    'expiry_date' => $m['expire_date'],'gateway'=>$m['get_payment']['gateway']];
                    $this->addMembershipLog('crone_Start',$log);

                    if($m['get_payment']['gateway'] == 'Paypal'){
                            $payment_data = $this->paypalMembership($m['get_payment']['gateway_customer_id']);
                                if($payment_data['status'] == 'active'){
                                    $next_payment = 1;
                                    $payment = \App\Payment::find($m['get_payment']['id']);
                                    $new_payment = $payment->replicate();
                                    $new_payment->payment_source = 'crone';
                                    $new_payment->save();
                                    
                                }
       
                    } else if($m['get_payment']['gateway'] == 'Stripe') {
                        $payment_data = $this->stripeMembership($m['get_payment']['subscription_id']);
                        
                                if($payment_data['status'] == 'active'){
                                        $next_payment = 1;
                                        $payment = \App\Payment::find($m['get_payment']['id']);
                                        $new_payment = $payment->replicate();
                                        $new_payment->payment_source = 'crone';
                                        $new_payment->save();
                            
                                }

                    } else if($m['get_payment']['gateway'] == 'Authorize') {
                        $payment_data = $this->AuthorizeNetMembership($m['get_payment']['subscription_id']);
                            
                                if($payment_data['status'] == 'active'){
                                $next_payment = 1;
                                $payment = \App\Payment::find($m['get_payment']['id']);
                                $new_payment = $payment->replicate();
                                $new_payment->payment_source = 'crone';
                                $new_payment->save();
                                $payment_data['expire_date'] = date('Y-m-d 23:59:00', strtotime('+1 year',strtotime($m['expire_date'])));
                                }
                    }

                if($next_payment == 0){
                    DB::table('membership_users')->where('user_id',$m['user_id'])->update(['status' => 'inactive']);
                } else {
                    $log = ['crone_status' => 'End','user_id' => $m['user_id'],
                                    'expiry_date' => $payment_data['expire_date'],'gateway'=>$m['get_payment']['gateway'],'membership_status'=>'active'];
                        $this->addMembershipLog('crone_end',$log);

                    DB::table('membership_users')->where('user_id',$m['user_id'])->update(['status' => 'active','expire_date' => $payment_data['expire_date']]);
                    }
                }
    }

        /**=====================================================
     *Check Membership next payment status in Paypal. If user pay automatic payment with paypal then fucntion execute. 
     *
     * @return \Illuminate\Http\Response
     */

    static function paypalMembership($PROFILEID){
    $paymentMode = \App\PaymentMode::where('gateway', 'Paypal')
                        ->where('status', 'Active')->first()->toArray();
            try {
                $nvp = array(
                    'METHOD'                            => 'GetRecurringPaymentsProfileDetails',
                    'VERSION'                           => '108',
                    'PWD'                               => $paymentMode['api_password'],
                    'USER'                              => $paymentMode['api_username'],
                    'SIGNATURE'                         => $paymentMode['api_signature'],
                    'PROFILEID'                         => $PROFILEID
                );
                $curl = curl_init();
                if(isset($paymentMode['account_type']) && ($paymentMode['account_type'] == "Live")){
                    $paypalApiUrl = 'https://api-3t.paypal.com/nvp';
                }else{
                    $paypalApiUrl = 'https://api-3t.sandbox.paypal.com/nvp';
                }
                curl_setopt( $curl , CURLOPT_URL , $paypalApiUrl );
                curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false );
                curl_setopt( $curl , CURLOPT_RETURNTRANSFER , 1 );
                curl_setopt( $curl , CURLOPT_POST , 1 );
                curl_setopt( $curl , CURLOPT_POSTFIELDS , http_build_query( $nvp ) );
                $response = urldecode( curl_exec( $curl ) );

                $responseNvp = array();
                if ( preg_match_all( '/(?<name>[^\=]+)\=(?<value>[^&]+)&?/' , $response , $matches ) ) {
                    foreach ( $matches[ 'name' ] as $offset => $name ) {
                        $responseNvp[ $name ] = $matches[ 'value' ][ $offset ];
                    }
                }
           

                if($responseNvp['STATUS'] == "Active"){
                    $next_date_detail = $responseNvp['NEXTBILLINGDATE'];
                    $next_date = date("Y-m-d",strtotime($next_date_detail));
                    
                   if($next_date >= date('Y-m-d')){
                        $data['status'] = 'active';
                        $data['expire_date'] = $next_date.' 23:59:00';
                   } else {
                    $data['status'] = 'inactive';
                   }


                } else {
                    $data['status'] = 'inactive';
                }

            } catch(\Exception $e){
                    $log = ['error_content' => $e->getMessage()];
                    $this->addMembershipLog('Crone_error',$log);
                $date['status'] = 'inactive';
                return $date;
                exit;
             }
            
            return $data;
    }


    /**====================================================================
     *Check Membership next payment status in Authorize.Net. If user pay automatic payment with Authorize.Net gateWay then fucntion execute.
     *
     * @return \Illuminate\Http\Response
     */

    static function AuthorizeNetMembership($subscription_id){

    $data = array();
    $data['status'] = 'inactive';
    $paymentMode = \App\PaymentMode::where('gateway', 'Authorize.net')->first();

    try {
            if($paymentMode['api_login_id'] != '' && $paymentMode['transaction_key'] != '' && $subscription_id != ''){
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName($paymentMode['api_login_id']);
            $merchantAuthentication->setTransactionKey($paymentMode['transaction_key']);

            $request = new AnetAPI\ARBGetSubscriptionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setSubscriptionId($subscription_id);

            $controller = new AnetController\ARBGetSubscriptionController($request);
          
               if(isset($paymentMode['account_type']) && ($paymentMode['account_type'] == "Live")){
                    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
                }
                else{
                    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
                }

            if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")){
              // $subscription = [
              //               'get______profile' => $response->getSubscription()->getPaymentSchedule()->getStartDate(),
              //           ];
                $data['status'] = $response->getSubscription()->getStatus();
                
            }
            else
            {
                return $data;
                exit;
            }

       }     

   } catch(\Exception $e){
            $date['status'] = 'inactive';
            $log = ['error_content' => $e->getMessage()];
            $this->addMembershipLog('Crone_error',$log);
            return $date;
            exit;
        }

    return $data;



}

/**==============================================
     *Check Membership next payment status in Stripe. If user pay automatic payment with Stripe gateWay then fucntion execute.
     *
     * @return \Illuminate\Http\Response
     */

static function stripeMembership($subscription_id){
    $paymentMode = \App\PaymentMode::where('gateway', 'Stripe')->first();
    $private_key = $paymentMode['secret_key'];
    $date = array();
    $stripeApiUrl = 'https://api.stripe.com/v1/subscriptions/'.$subscription_id;
        try{
        $curl = curl_init();
        curl_setopt_array($curl, [
                        CURLOPT_RETURNTRANSFER => 1,
                        //CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_URL => $stripeApiUrl,
                        CURLOPT_HTTPHEADER => [
                            "Authorization: Bearer " . $private_key
                        ]
                    ]);
        $resp = curl_exec( $curl );
        curl_close( $curl );
        $responseNvp = json_decode($resp, true);
            if($responseNvp['status'] == 'active' && $responseNvp['current_period_end'] != ''){
                $date['expire_date'] = date("Y-m-d 23:59:00",$responseNvp['current_period_end']);
                $date['status'] = 'active';
                return $date;
                exit;
            }
        } catch(\Exception $e){
            $date['status'] = 'inactive';
             $log = ['error_content' => $e->getMessage()];
             $this->addMembershipLog('Crone_error',$log);
            return $date;
            exit;
        }
}


/**==============================================
     *It`s used to add every membership log in membership.log (Stroge/logs/membership.log) file.
     *
     * @return \Illuminate\Http\Response
     */
static function addMembershipLog($type,$log){
        $orderLog = new Logger($type);
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/membership.log')), Logger::INFO);
        $orderLog->info('MembershipLog', $log);
}
   

}

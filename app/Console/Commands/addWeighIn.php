<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\common;
use DB;

class addWeighIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addweighin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It is uesd to send email to user before challenge start date';

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
        $query = DB::table('challenges as ch');
        $query->where('ch.status', 'Active');
        $query->where(function($query1) {
            $query1->where('ch.start_date',date("Y-m-d",strtotime("+2 days")))
                   ->orWhere('ch.start_date',date("Y-m-d",strtotime("+1 days")))
                   ->orWhere('ch.start_date',date("Y-m-d"));
        });
        $query->join('weighins_gallery AS wg','wg.challenge_id', '=', 'ch.id','left outer');
        $query->where('wg.challenge_id',null);

        $query->join('user_challenges AS uc','uc.challenge_id', '=', 'ch.id','left outer');
        $query->where('uc.challenge_id','!=','');
        // $query->where('uc.last_weighin_email','!=',date("Y-m-d"));

        $query->where(function($query2) {
            $query2->where('uc.last_weighin_email','!=',date("Y-m-d"))
                   ->orwhere('uc.last_weighin_email',null);
        });


        $query->leftjoin('users AS u','u.id', '=', 'uc.user_id');

        $users = $query->select('ch.id','ch.start_date','ch.title','uc.user_id','u.email','u.first_name','u.last_name')->get()->toArray();

    
        
        foreach ($users as $k => $u) {
            $emailTemplate = \App\EmailTemplate::where('name', 'weighin')->where('status', 'Active')->first();

            if(isset($emailTemplate->id)){
                $allEmails = $u->email;
                $content = $emailTemplate->content;
                $content = str_replace('#NAME', $u->first_name.' '.$u->last_name, $content);
                $content = str_replace('#challenge', $u->title, $content);
                $params['body'] = $content;
                $from = '';
                $subject = 'Add Weigh In';
                common::send_email($allEmails, $subject, $params, $template = "", $from);
            }
           

            $notification = new \App\Notifications();
            $notification->type = 'weigh in';
            $notification->is_seen = 0;
            $notification->user_id = $u->user_id;
            $notification->message = "Weigh In pending for this ".$u->title." Challenge.Please add weigh In before challenge deactivation";
            $notification->save();

            DB::table('user_challenges')->where('challenge_id',$u->id)->where('user_id',$u->user_id)->update(['last_weighin_email' => date("Y-m-d")]);
        }


        // $query3 = DB::table('challenges as ch');
        // $query3->where('ch.status', 'Active');
        // $query3->where('ch.start_date','<',date("Y-m-d"));
        // $query3->join('weighins_gallery AS wg','wg.challenge_id', '=', 'ch.id','left outer');
        // $query3->where('wg.challenge_id',null);
        // $query3->update(['ch.status' => 'Inactive']);
    }
}

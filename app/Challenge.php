<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use App\ChallengeType;
class Challenge extends Model
{
    use Sortable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','tagline', 'start_date','description','challenge_image', 'end_date', 'amount', 'bet_close_date', 'challenge_type_id','challenge_access', 'created_by'
    ];
    public $sortable = ['title', 'start_date', 'end_date','created_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = [];
    protected $table = 'challenges';
     /**
     * Get the profile record associated with the user.
     */
    public function gettype()
    {
        return $this->belongsTo('App\ChallengeType', 'challenge_type_id');  
    }

    public function getcreatedby(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function allPayments(){
        return $this->hasMany('App\Payment', 'challenge_id');
    }

    /* Get challenge users count */
    public function getTotalPlayers(){
        //return $this->hasMany('App\Payment', 'challenge_id')->where('status', 'Paid');
        return $this->hasMany('App\UserChallenge', 'challenge_id');
    }
        /* Get challenge users count */
    public function getParticipant(){
        return $this->hasMany('App\UserChallenge', 'challenge_id');
    }


        /* Get challenge users count */
    public function getParticipantDetail(){
        return $this->hasMany('App\UserChallenge', 'challenge_id')->with('participantUser');
    }
}

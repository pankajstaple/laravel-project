<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class UserChallenge extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'challenge_id', 'user_id'
    ];
    
    protected $table = 'user_challenges';
    
    public function getcreatedby(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function getGameChallange(){
        return $this->belongsTo('App\Challenge', 'challenge_id');

    }
    public function Challange(){
        return $this->belongsTo('App\Challenge', 'challenge_id')->select('id','title','created_by','challenge_image');
    }

    public function members(){
        return $this->hasMany('App\UserChallenge', 'challenge_id','challenge_id');
    
    }

    public function upcomingChallange(){
        return $this->belongsTo('App\Challenge', 'challenge_id')->select('id','title','created_by','start_date','end_date');
    
    }

    

    public function players(){

          /*return $this->HasMany('App\UserChallenge','challenge_id')->groupBy('challenge_id');*/
          return select('count(*) as count')->groupBy('challenge_id');
    }



    public function participantUser(){
        return $this->belongsTo('App\User', 'user_id')->with('profile')->select('id','first_name','last_name','email');
    
    }

}

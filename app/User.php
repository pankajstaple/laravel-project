<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use App\UserProfile;
class User extends Authenticatable
{
    use Sortable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','last_login_at','last_login_ip','reference_by','user_code'
    ];
    public $sortable = ['first_name', 'last_name', 'email','created_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';
     /**
     * Get the profile record associated with the user.
     */
    public function profile()
    {
        return $this->hasOne('App\UserProfile','user_id');
    }

    public function forums()
    {
        return $this->hasMany(Thread::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kyslik\ColumnSortable\Sortable;
use App\User;
class Blog extends Model
{
    use Sortable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','seo','blog_image' ,'summary','content', 'slug','is_published', 'created_by', 'category_id', 'total_likes', 'total_views', 'facebook_shares','seo_desc'
    ];
    public $sortable = ['title', 'slug', 'created_by','created_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = [];
    protected $table = 'blogs';
     /**
     * Get the profile record associated with the user.
     */
    public function getblogcategory()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id');  
    }

    public function blogcomments()
    {
        return $this->hasMany('App\BlogComment', 'blog_id');  
    }

    public function getcreatedby(){
        return $this->belongsTo('App\User', 'created_by');
    }
}

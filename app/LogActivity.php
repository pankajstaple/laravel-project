<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Query\Builder;
use App\User;

class LogActivity extends Model

{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'log_type_code', 'url','ip', 'agent', 'user_id'

    ];

    public $sortable = ['description', 'url', 'ip','agent','created_at'];

    public function get_user(){
        return $this->belongsTo('App\User','user_id');
    }

}
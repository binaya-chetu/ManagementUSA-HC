<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'agent_id',
        'package_id',
        'package_type',
        'subtotal_amount',
        'discount_amount',
        'total_amount',
        'status'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function orderDetail()
    {
        return $this->hasMany('App\OrderDetail', 'order_id');
    }
    
    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'order_id');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\Categories', 'package_id');
    }
    
    public function categoryType()
    {
        return $this->belongsTo('App\CategoryTypes', 'package_type');
    }
    
    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }
}

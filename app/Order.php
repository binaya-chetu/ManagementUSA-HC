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
        'payment_id',
        'category',
        'package_type',
        'price',
        'discount_price',
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
    
    public function packages()
    {
        return $this->hasOne('App\Packages', 'package_id');
    }
	
    public function payment()
    {
        return $this->belongsTo('App\Packages', 'payment_id');
    }
}

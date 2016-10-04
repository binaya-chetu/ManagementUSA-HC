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
	
    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }
    
    public static function getAllOrders($orderId)
    {
        $orderHistory = Order::with(['payment' => function($query) {
                                            $query->select(['patient_id', 'agent_id']);
                        }])->where('order_unique_id', $orderId)->get();
        return $orderHistory;
    }
}

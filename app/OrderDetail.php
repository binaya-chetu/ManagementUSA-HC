<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_sku',
        'quantity',
        'unit_price',
        'save_amount',
        'total_amount'
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
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}

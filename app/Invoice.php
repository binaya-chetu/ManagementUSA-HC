<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice';
    protected $fillable = [
        'user_id',
        'order_id',
        'invoice_no'
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
        return $this->blongsTo('App\Order', 'order_id');
    }
    
  
}

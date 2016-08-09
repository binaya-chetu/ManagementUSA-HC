<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    /*
     * The database table used by the model.
     * 
     * @var string
     */
    use SoftDeletes;
    protected $table = 'stocks';
    protected $fillable = [
        'sku',
        'unit_of_measurement',
        'quantity'
    ];
    
}

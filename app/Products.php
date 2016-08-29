<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    /*
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'products'; 

    protected $fillable =
    [
        'name',
        'unit_of_measurement',
        'price',
	'sku'
    ]; 

}

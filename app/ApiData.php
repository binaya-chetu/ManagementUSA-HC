<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiData extends Model
{
    use SoftDeletes;
    protected $table = 'api_data';
    protected $connection = 'mysql2';
    protected $fillable = [
        'timestamp',
        'date_time',
        'call_duration',
        'phone_number',
        'phone_number_name',
        'call_resolution',
        'msg',
        'caller_id',
        'first_name',
        'last_name',
        'business',
        'address',
        'city',
        'state',
        'zipcode',
        'phone_number_formatted',
        'page_count',
        'group',
        'user',
        'call_direction',
        'access',
        'status',
        'npa',
        'nxxx',
        'call_type',
        'current_url',
        'widget_name',
        'source_type',
        'category'
    ];
}

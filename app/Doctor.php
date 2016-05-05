<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable =
    [
        'firstName',
        'lastName',
        'email',
        'status',
        'phone',
		'dob',
		'gender',
        'address1',
        'address2',
        'city',
        'state',
        'zipCode',
        'employer',
        'occupation'
    ];
}

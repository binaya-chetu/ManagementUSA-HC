<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ApiSetting extends Model
{
    use SoftDeletes;
    protected $table = 'api_setting';
    protected $connection = 'mysql2';
    protected $fillable = [
        'api_url',
        'user_name',
        'password'
    ];
    
    /**
     * Set the APi Password.
     *
     * @param  string  $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encrypt($value);
    }
    
    /**
     * Get the API Password.
     *
     * @param  string  $value
     * @return string
     */
    public function getPasswordAttribute($value)
    { 
       try {
            return Crypt::decrypt($value);
        } catch (DecryptException $e) {
        }
    }
}

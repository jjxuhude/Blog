<?php
/**
 * Created by PhpStorm.
 * User: zhou2
 * Date: 2017/12/21
 * Time: 22:56
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table="address";

    function user(){
        return $this->belongsTo(User::class,'user444_id');
    }
}
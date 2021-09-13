<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;//
    protected $fillable =[
    	'coupon_name', 'coupon_code','coupon_qty','coupon_number'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_coupon';
}

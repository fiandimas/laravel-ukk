<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['id_bill','date_pay','month','year','cost_admin','total_pay','status','image','id_admin'];
}

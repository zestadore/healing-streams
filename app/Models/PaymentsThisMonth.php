<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsThisMonth extends Model
{
    use HasFactory;
    protected $table = 'payments_this_months';
    protected $fillable =[ 'refrence','reference_id','initialising_date','status'];
}

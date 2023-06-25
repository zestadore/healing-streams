<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'pledges';
    protected $fillable =[ 'first_name','last_name','email_id','phone_no','partnership_categories',
        'country_id','currency_id','amount','payment_gateway_id','initialising_date','completed_installments'];

    protected $casts = [
        'partnership_categories' => 'array'
    ];
}

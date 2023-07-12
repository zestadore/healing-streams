<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'payments';
    protected $fillable =[ 'first_name','last_name','email_id','phone_no','partnership_categories',
        'country_id','currency_id','amount','choice','payment_gateway_id','payment_status','reference_id','payment_date','other_options'];

    protected $casts = [
        'partnership_categories' => 'array'
    ];

    public function country(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function currency(){
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function paymentGateway(){
        return $this->hasOne(PaymentGateway::class, 'id', 'payment_gateway_id');
    }
}

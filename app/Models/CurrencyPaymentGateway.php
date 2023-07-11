<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPaymentGateway extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'currency_payment_gateways';
    protected $fillable =['payment_gateway_id','status','currency_id','is_default'];

    public function paymentGateway(){
        return $this->hasOne(PaymentGateway::class, 'id', 'payment_gateway_id');
    }
}

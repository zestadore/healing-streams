<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'countries';
    protected $fillable =[ 'country','status','country_code','telephone_code','region_id'];

    // public function states(){
    //     return $this->hasMany(State::class, 'country_id', 'id')->where('status',1);
    // }

    public function currencies(){
        return $this->belongsToMany(Currency::class)->withPivot('currency_id');
    }

    public function defaultCurrency(){
        return $this->belongsToMany(Currency::class)->withPivot('currency_id')->where('default',1);
    }

    public function alternateCurrencies(){
        return $this->belongsToMany(Currency::class)->withPivot('currency_id')->where('default',0);
    }

    public function paymentGateways(){
        return $this->belongsToMany(PaymentGateway::class)->withPivot('payment_gateway_id');
    }

    public function defaultPaymentGateway(){
        return $this->belongsToMany(PaymentGateway::class)->withPivot('payment_gateway_id')->where('default',1);
    }

    public function alternatePaymentGateways(){
        return $this->belongsToMany(PaymentGateway::class)->withPivot('payment_gateway_id')->where('default',0);
    }

    public function region(){
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}

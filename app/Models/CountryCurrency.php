<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryCurrency extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'country_currencies';
    protected $fillable =['country_id','status','currency_id','is_default'];

    public function currency(){
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function paymentGateways(){
        return $this->hasMany(CurrencyPaymentGateway::class, 'currency_id', 'id')->where('status',1);
    }
}

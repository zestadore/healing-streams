<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\Currency;

class Pledge extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'pledges';
    protected $fillable =[ 'first_name','last_name','email_id','phone_no','partnership_categories',
        'country_id','currency_id','amount','payment_gateway_id','initialising_date','completed_installments','amount_usd','status'];

    protected $casts = [
        'partnership_categories' => 'array'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $currency=Currency::find($model->currency_id);
            $url="https://api.apilayer.com/currency_data/convert?to=usd&from=".$currency->currency."&amount=".$model->amount;
            $response = Http::withHeaders([
                'apikey' => "PQeOHIJkvP7AZQb6t0Y3Bqn2OHlK09Vk",
            ])->timeout(60)->get($url);
            $model->amount_usd = $response['result'];
        });
    }

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

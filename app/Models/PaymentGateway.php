<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'payment_gateways';
    protected $fillable =[ 'payment_gateway','status'];
}

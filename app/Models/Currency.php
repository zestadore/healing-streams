<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'currencies';
    protected $fillable =[ 'currency','status','currency_symbol'];
}

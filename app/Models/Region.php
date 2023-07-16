<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'regions';
    protected $fillable =[ 'region','status'];

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Country::class,'region_id','country_id','id','id')->where('payment_status',1);
    }
}

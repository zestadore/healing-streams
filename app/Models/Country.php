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

    public function region(){
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function currencies(){
        return $this->hasMany(CountryCurrency::class, 'country_id', 'id')->where('status',1);
    }
}

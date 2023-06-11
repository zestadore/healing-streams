<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'countries';
    protected $fillable =[ 'country','status'];

    // public function states(){
    //     return $this->hasMany(State::class, 'country_id', 'id')->where('status',1);
    // }

    public function currencies(){
        return $this->belongsToMany(Currency::class)->withPivot('currency_id');
    }
}

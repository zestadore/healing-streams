<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $countries=Country::where('status',1)->get();
        return view('web.index',['countries'=>$countries]);
    }

    public function getCurrencies($id)
    {
        $country=Country::find($id);
        $currencies=$country->currencies;
        return $currencies;
    }
}

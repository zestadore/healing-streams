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

    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        // $productname = $request->get('productname');
        $totalprice = $request->amount;
        $two0 = "00";
        $total = "$totalprice$two0";
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => "Oneoff",
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('failure'),
        ]);
        return redirect()->away($session->url);
    }

    public function success()
    {
        dd("Success");
    }

    public function failure()
    {
        dd("Failure");
    }
}

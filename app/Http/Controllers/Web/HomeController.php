<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\PaymentGateway;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
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
        $gateways=$country->paymentGateways;
        $data=[
            'currencies'=>$currencies,
            'payment_gateways'=>$gateways
        ];
        return $data;
    }

    public function processPayment(Request $request)
    {
        // $productname = $request->get('productname');
        $payment=Payment::create($request->except('_token'))->id;
        $currency=Currency::find($request->currency_id);
        $gateway=PaymentGateway::find($request->payment_gateway_id);
        if($gateway->payment_gateway=="Stripe"){
            $session=$this->StripePayment($request,$payment,$currency->currency);
        }elseif($gateway->payment_gateway=="Paypal"){
            $this->PaypalPayment($request,$payment,$currency->currency);
        }
        return redirect()->away($session->url);
    }

    private function StripePayment($request,$payment_id,$currency)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $totalprice = $request->amount;
        $two0 = "00";
        $total = "$totalprice$two0";
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => $currency,
                        'product_data' => [
                            "name" => "Oneoff",
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'metadata'=>['payment_id'=>$payment_id],
            'customer_email'=>$request->email_id,
            'mode'        => 'payment',
            'success_url' => url('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('failure'),
        ]);
        return $session;
    }

    private function PaypalPayment($request,$payment_id,$currency)
    {
        $totalprice = $request->amount;
        $provider = new PayPalClient;
        Session::put('paymentId', $payment_id);
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('failure'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $currency,
                        "value" => $totalprice
                    ]
                ]
            ]
        ]);
        if ($response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->to($links['href'])->send();
                }
            }
            return redirect()
                ->route('failure')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('home-page')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $session = $stripe->checkout->sessions->retrieve($request->get('session_id'));
        $payment=Payment::find($session['metadata']['payment_id']);
        $paymentStatus=0;
        if($session['payment_status']=="paid"){
            $paymentStatus=1;
        }elseif($session['payment_status']=="unpaid"){
            $paymentStatus=2;
        }
        $payment->update(['payment_status'=>$paymentStatus,'reference_id'=>$session['id'],'payment_date'=>Now()]);
        return redirect()->route('home-page')->with(['success'=>'Payment completed successfully']);
    }

    public function PaypalPaymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $payment=Payment::find(Session::get('paymentId'));
            Session::forget('paymentId');
            $payment->update(['payment_status'=>1,'reference_id'=>$response['id'],'payment_date'=>Now()]);
            return redirect()->route('home-page')->with(['success'=>'Payment completed successfully']);
        } else {
            // return redirect()
            //     ->route('create.payment')
            //     ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function failure()
    {
        dd("Failure");
    }
}

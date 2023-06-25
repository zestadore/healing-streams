<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\MonthlyAutomatic;
use App\Models\Pledge;
use App\Models\PaymentsThisMonth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmailPaymentController extends Controller
{
    public function index($id,$choice)
    {
        if($choice==1){
            $payment=MonthlyAutomatic::find($id);
            $pay=PaymentsThisMonth::where('refrence','monthly')->where('status',0)->where('reference_id',$id)->first();
            // $pay->update(['status'=>1]);
        }elseif($choice==2){
            $payment=Pledge::find($id);
            $pay=PaymentsThisMonth::where('refrence','pledge')->where('status',0)->where('reference_id',$id)->first();
            $pay->update(['status'=>1]);
        }
        $data=[
            'first_name'=>$payment->first_name,
            'last_name'=>$payment->last_name,
            'email_id'=>$payment->email_id,
            'phone_no'=>$payment->phone_no,
            'partnership_categories'=>$payment->partnership_categories,
            'country_id'=>$payment->country_id,
            'currency_id'=>$payment->currency_id,
            'amount'=>$payment->amount,
            'choice'=>$payment->choice,
            'payment_gateway_id'=>$payment->payment_gateway_id,
            'payment_status'=>0
        ];
        $res=Payment::create($data)->id;
        // $payment->update(['status'=>1]);
        $this->choosePayment($payment,$res);
        // return redirect()->back();
    }

    private function choosePayment($payment,$payment_id)
    {
        $currency=Currency::find($payment->currency_id);
        switch($payment->payment_gateway_id){
            case 0:
                $res=$this->stripePayment($payment,$currency->currency,$payment_id);
                break;
            case 1:
                $this->paypalPayment($payment,$currency->currency,$payment_id);
                break;
            case 2:
                $this->kingspayPayment($payment,$currency->currency,$payment_id);
                break;
        }
        return redirect()->to($res->url)->send();
    }

    private function stripePayment($payment,$currency,$payment_id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $totalprice = $payment->amount;
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
            'customer_email'=>$payment->email_id,
            'mode'        => 'payment',
            'success_url' => url('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('failure'),
        ]);
        return $session;
    }

    private function paypalPayment($payment,$currency,$payment_id)
    {
        $totalprice = $payment->amount;
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

    private function kingspayPayment($payment,$currency,$payment_id)
    {
        $totalprice = $payment->amount*100;
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . env('KP_SECRET_KEY',''),
            'Content-Type' => 'application/json'
        ])->post('https://api.kingspay-gs.com/api/payment/initialize', [
            'amount' => $totalprice,
            'currency'=>$currency,
            'description'=>"Payment for Healing Streams",
            "merchant_callback_url"=>route('kingspay.success'),
            "metadata"=> ["payment_id"=> $payment_id],
            'payment_type'=> "international"
        ]);
        Session::put('paymentId', $payment_id);
        Session::put('kpPaymentID', $response['payment_id']);
        $awayUrl="https://kingspay-gs.com/payment?id=".$response['payment_id'];
        return redirect()->to($awayUrl)->send();
    }
}

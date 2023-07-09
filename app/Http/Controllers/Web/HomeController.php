<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\MonthlyAutomatic;
use App\Models\Pledge;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\ThanksMail;
use App\Mail\PaymentMail;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $countries=Country::where('status',1)->get();
        Session::forget('kpPaymentID');
        Session::forget('paymentId');
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
        $request->validate([
            'first_name' => 'required',
            'email_id' => 'required|email',
            'country_id'=> 'required|numeric',
            'phone_no'=>'required|numeric',
            'currency_id'=>'required|numeric',
            'choice'=>'required|numeric'
        ]);
        if($request->choice==0){
            $payment=Payment::create($request->except('_token'))->id;
        }
        $currency=Currency::find($request->currency_id);
        $gateway=PaymentGateway::find($request->payment_gateway_id);
        switch ($request->choice) {
            case 0:
                if($gateway->payment_gateway=="Stripe"){
                    $session=$this->StripePayment($request,$payment,$currency->currency);
                }elseif($gateway->payment_gateway=="Paypal"){
                    $this->PaypalPayment($request,$payment,$currency->currency);
                }elseif($gateway->payment_gateway=="Kingspay"){
                    $this->KingspayPayment($request,$payment,$currency->currency);
                    return redirect()->back();
                }
                break;
            case 1:
                $request->validate([
                    'initialising_date' => 'required',
                ]);
                $res=$this->saveMonthlyAutomatic($request);
                if($res){
                    return redirect()->route('home-page')->with(['success'=>'Monthly automatic payments initiated successfully!']);
                }else{
                    return redirect()->route('home-page')->with(['error'=>'Failed to initiate automatic payments!']);
                }
                break;
            case 2:
                $request->validate([
                    'initialising_date' => 'required',
                ]);
                $res=$this->savePledge($request);
                if($res){
                    return redirect()->route('home-page')->with(['success'=>'Pledge payments initiated successfully!']);
                }else{
                    return redirect()->route('home-page')->with(['error'=>'Failed to initiate pledge payments!']);
                }
                 break;
            default:
                if($gateway->payment_gateway=="Stripe"){
                    $session=$this->StripePayment($request,$payment,$currency->currency);
                }elseif($gateway->payment_gateway=="Paypal"){
                    $this->PaypalPayment($request,$payment,$currency->currency);
                }elseif($gateway->payment_gateway=="Kingspay"){
                    $this->KingspayPayment($request,$payment,$currency->currency);
                    return redirect()->back();
                }
        }
        return redirect()->away($session->url);
    }

    private function saveMonthlyAutomatic($request)
    {
        $res=MonthlyAutomatic::create($request->except(['_token','choice','initialising_date']))->id;
        $initialisingDate=Carbon::parse($request->initialising_date)->format('d');
        $curDate=Carbon::parse(Now())->format('d');
        $monthly=MonthlyAutomatic::find($res);
        $res=$monthly->update(['initialising_date'=>$initialisingDate]);
        Mail::to($request->email_id)->send(new RegistrationMail('Monthly (Subscription)'));
        if($curDate<=$initialisingDate){
            Mail::to($monthly->email_id)->send(new PaymentMail($monthly));
        }
        return $res;
    }

    private function savePledge($request)
    {
        $res=Pledge::create($request->except(['_token','choice','initialising_date']))->id;
        $initialisingDate=Carbon::parse($request->initialising_date)->format('d');
        $curDate=Carbon::parse(Now())->format('d');
        $pledge=Pledge::find($res);
        $res=$pledge->update(['initialising_date'=>$initialisingDate]);
        Mail::to($request->email_id)->send(new RegistrationMail('Pledge'));
        if($curDate<=$initialisingDate){
            Mail::to($pledge->email_id)->send(new PaymentMail($pledge));
        }
        return $res;
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

    private function KingspayPayment($request,$payment_id,$currency)
    {
        $totalprice = $request->amount*100;
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
        Mail::to($payment->email_id)->send(new ThanksMail());
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
            Mail::to($payment->email_id)->send(new ThanksMail());
            return redirect()->route('home-page')->with(['success'=>'Payment completed successfully']);
        } else {
            $payment=Payment::find(Session::get('paymentId'));
            $payment->update(['payment_status'=>2]);
            Session::forget('paymentId');
            return redirect()->route('home-page')->with(['error'=>'Something went wrong! Payment failed']);
        }
    }

    public function KingspayPaymentSuccess()
    {
        $verifyUrl="https://api.kingspay-gs.com/api/payment/".Session::get('kpPaymentID');
        $response = Http::get($verifyUrl);
        if (isset($response['status']) && $response['status'] == 'SUCCESS') {
            $payment=Payment::find(Session::get('paymentId'));
            $payment->update(['payment_status'=>1,'reference_id'=>Session::get('kpPaymentID'),'payment_date'=>Now()]);
            Session::forget('kpPaymentID');
            Session::forget('paymentId');
            Mail::to($payment->email_id)->send(new ThanksMail());
            return redirect()->route('home-page')->with(['success'=>'Payment completed successfully']);
        } else {
            // $payment=Payment::find(Session::get('paymentId'));
            // $payment->update(['payment_status'=>2]);
            Session::forget('paymentId');
            Session::forget('kpPaymentID');
            return redirect()->route('home-page');
        }
    }

    public function failure()
    {
        dd("Failure");
    }
}

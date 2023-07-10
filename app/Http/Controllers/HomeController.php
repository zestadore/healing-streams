<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Currency;
use App\Models\Pledge;
use App\Models\MonthlyAutomatic;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $paymentCounts['stripe']=Payment::where('payment_status',1)->where('payment_gateway_id',1)->count();
        $paymentCounts['paypal']=Payment::where('payment_status',1)->where('payment_gateway_id',2)->count();
        $paymentCounts['kingspay']=Payment::where('payment_status',1)->where('payment_gateway_id',3)->count();
        $barChart=Payment::join('countries','payments.country_id','countries.id')->select('countries.country',
            DB::raw('sum(CASE WHEN payments.payment_gateway_id IN (3) THEN payments.amount END) as kingspay_sum,
            sum(CASE WHEN payments.payment_gateway_id IN (2) THEN payments.amount END) as paypal_sum,
            sum(CASE WHEN payments.payment_gateway_id IN (1) THEN payments.amount END) as stripe_sum'))->groupBy('countries.country')->get();
        $paymentCounts['barChart']=[];
        foreach($barChart as $chart){
            $paymentCounts['barChart'][]=[
                'country'=>$chart->country,
                'kingspay_sum'=>$chart->kingspay_sum??0,
                'paypal_sum'=>$chart->paypal_sum??0,
                'stripe_sum'=>$chart->stripe_sum??0
            ];
        }
        $paymentCounts['barChart']=json_encode($paymentCounts['barChart']);
        $paymentCounts['totalTransactions']=Payment::whereDate('created_at',Carbon::today())->count();
        $paymentCounts['stripeTransactions']=Payment::whereDate('created_at',Carbon::today())->where('payment_gateway_id',1)->count();
        $paymentCounts['paypalTransactions']=Payment::whereDate('created_at',Carbon::today())->where('payment_gateway_id',2)->count();
        $paymentCounts['kingspayTransactions']=Payment::whereDate('created_at',Carbon::today())->where('payment_gateway_id',3)->count();
        return view('admin.dashboard',['paymentsCounts'=>$paymentCounts]);
    }

    public function authUserProfile()
    {
        return view('profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
			'first_name' => 'required',
            'mobile'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png|max:2048',
		]);
        $image=Null;
        $user=Auth::user();
        if($request->file('image')){
            if($user->image!=null){
                unlink(public_path('uploads/profiles/'. $user->image));
            }
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/profiles'), $filename);
            $image= $filename;
        }
        $data=[
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'mobile'=>$request->mobile,
            'image'=>$image
        ];
        $res=$user->update($data);
        if($res){
            return redirect()->back()->with('success', 'Successfully updated the data.');
        }else{
            return redirect()->back()->with('error', 'Failed to update the data. Please try again.');
        }
    }

    public function changePassword()
    {
        return view('profile.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $res=Auth::user()->update(['password'=>Hash::make($request->password)]);
        if($res){
            return redirect()->back()->with(['success'=>'Password updated successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Failed to update the password']);
        }
    }

    
}

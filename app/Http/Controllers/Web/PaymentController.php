<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentsThisMonth;
use App\Models\MonthlyAutomatic;
use App\Models\Pledge;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{

    public function index($choice,Request $request)
    {
        switch ($choice) {
            case "one-off":
                $opt=0;
                break;
            case "monthly-subscription":
                $opt=1;
                break;
            case "pledge":
                $opt=2;
                break;
        }
        if ($request->ajax()) {
            $payments= Payment::query()->where('choice',$opt);
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                ->addColumn('payment_gateway', function($data) {
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('payment_date', function($data) {
                    if($data->choice==0){
                        return Carbon::parse($data->payment_date)->format('d-m-Y');
                    }else if($data->choice==1){
                        return Carbon::parse($data->payment_date)->format('d'). ' of every month';
                    }else if($data->choice==2){
                        return Carbon::parse($data->payment_date)->format('d-m-Y');
                    }
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('status', function($data) {
                    if($data->payment_status==0){
                        return "Pending";
                    }elseif($data->payment_status==1){
                        return "Paid";
                    }else{
                        return "Unpaid";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.index',['choice'=>$choice]);
    }


    public function stripePayments(Request $request,$option)
    {
        $choice=$this->getChoiceDetails($option);
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',1)->where('choice',$choice);
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                ->addColumn('payment_gateway', function($data) {
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('status', function($data) {
                    if($data->payment_status==0){
                        return "Pending";
                    }elseif($data->payment_status==1){
                        return "Paid";
                    }else{
                        return "Unpaid";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.index',['choice'=>'stripe','choice2'=>$option]);
    }

    public function paypalPayments(Request $request,$option)
    {
        $choice=$this->getChoiceDetails($option);
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',2)->where('choice',$choice);
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                // ->addColumn('payment_gateway', function($data) {
                //     return $data->paymentGateway->payment_gateway;
                // })
                ->addColumn('status', function($data) {
                    if($data->payment_status==0){
                        return "Pending";
                    }elseif($data->payment_status==1){
                        return "Paid";
                    }else{
                        return "Unpaid";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.index',['choice'=>'paypal','choice2'=>$option]);
    }

    public function kingspayPayments(Request $request,$option)
    {
        $choice=$this->getChoiceDetails($option);
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',3)->where('choice',$choice);
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                ->addColumn('payment_gateway', function($data) {
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('status', function($data) {
                    if($data->payment_status==0){
                        return "Pending";
                    }elseif($data->payment_status==1){
                        return "Paid";
                    }else{
                        return "Unpaid";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.index',['choice'=>'kingspay','choice2'=>$option]);
    }

    public function thisMonthsPayments(Request $request)
    {
        if ($request->ajax()) {
            $payments= PaymentsThisMonth::query()->with(['monthlyAutomatic','pledge']);
            $status = $request->status_search;
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('first_name', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->first_name;
                    }else{
                        return $data->pledge->first_name;
                    }
                })
                ->addColumn('last_name', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->last_name;
                    }else{
                        return $data->pledge->last_name;
                    }
                })
                ->addColumn('email_id', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->email_id;
                    }else{
                        return $data->pledge->email_id;
                    }
                })
                ->addColumn('phone_no', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->phone_no;
                    }else{
                        return $data->pledge->phone_no;
                    }
                })
                ->addColumn('country', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->country->country;
                    }else{
                        return $data->pledge->country->country;
                    }
                })
                ->addColumn('currency', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->currency->currency;
                    }else{
                        return $data->pledge->currency->currency;
                    }
                })
                ->addColumn('amount', function($data) {
                    if($data->refrence=="monthly"){
                        return $data->monthlyAutomatic->amount;
                    }else{
                        return $data->pledge->amount;
                    }
                })
                ->addColumn('status', function($data) {
                    if($data->status==0){
                        return "Pending";
                    }elseif($data->status==1){
                        return "Link used";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.this_month_payments');
    }

    public function monthlyAutomatic(Request $request)
    {
        if ($request->ajax()) {
            $payments= MonthlyAutomatic::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                ->addColumn('payment_gateway', function($data) {
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('date_created', function($data) {
                    return Carbon::parse($data->created_at)->format('d-M-Y');
                })
                ->addColumn('initialized', function($data) {
                    return $data->initialising_date . ' of every month';
                })
                ->addColumn('status', function($data) {
                    if($data->payment_status==0){
                        return "Canceled";
                    }elseif($data->payment_status==1){
                        return "Active";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.monthly_pledge',['choice'=>'monthly']);
    }

    public function pledgePayment(Request $request)
    {
        if ($request->ajax()) {
            $payments= Pledge::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $payments->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $payments->where(function ($query) use ($status) {
                    $query->where('payment_status', $status);
                });
            }
            return DataTables::of($payments)
                ->addIndexColumn()
                ->addColumn('country', function($data) {
                    return $data->country->country;
                })
                ->addColumn('currency', function($data) {
                    return $data->currency->currency;
                })
                ->addColumn('payment_gateway', function($data) {
                    return $data->paymentGateway->payment_gateway;
                })
                ->addColumn('date_created', function($data) {
                    return Carbon::parse($data->created_at)->format('d-M-Y');
                })
                ->addColumn('initialized', function($data) {
                    return $data->initialising_date . ' of every month';
                })
                ->addColumn('status', function($data) {
                    if($data->status==0){
                        return "Canceled";
                    }elseif($data->status==1){
                        return "Active";
                    }
                })
                ->make(true);
        }
        return view('admin.payments.monthly_pledge',['choice'=>'pledge']);
    }

    private function getChoiceDetails($option){
        switch ($option) {
            case "one-off":
                $choice=0;
                break;
            case "monthly-subscription":
                $choice=1;
                break;
            case "pledge":
                $choice=2;
                break;
            default:
                $choice=0;
        }
        return $choice;
    }
}

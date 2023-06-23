<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use DataTables;

class PaymentController extends Controller
{

    public function stripePayments(Request $request)
    {
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',1);
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
        return view('admin.payments.index',['choice'=>'stripe']);
    }

    public function paypalPayments(Request $request)
    {
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',2);
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
        return view('admin.payments.index',['choice'=>'paypal']);
    }

    public function kingspayPayments(Request $request)
    {
        if ($request->ajax()) {
            $payments= Payment::query()->where('payment_gateway_id',3);
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
        return view('admin.payments.index',['choice'=>'kingspay']);
    }
}

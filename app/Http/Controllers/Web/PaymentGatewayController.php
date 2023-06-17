<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use DataTables;

class PaymentGatewayController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentGateways= PaymentGateway::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $paymentGateways->where(function ($query) use ($search) {
                    $query->where('payment_gateway', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $paymentGateways->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($paymentGateways)
                ->addIndexColumn()
                ->addColumn('action', 'admin.payment_gateways.action')
                ->make(true);
        }
        return view('admin.payment_gateways.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
			'payment_gateway' => 'required',
            'id'=>'required|numeric'
		]);
        if($request->id>0)
        {
            $paymentGateway=PaymentGateway::findorfail($request->id);
            $res=$paymentGateway->update(['payment_gateway'=>$request->payment_gateway,'status'=>$request->status]);
        }else{
            $res=PaymentGateway::Create(['payment_gateway'=>$request->payment_gateway,'status'=>$request->status]);
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show(PaymentGateway $paymentGateway)
    {
        //
    }

    public function edit(PaymentGateway $paymentGateway)
    {
        //
    }

    public function update(Request $request, PaymentGateway $paymentGateway)
    {
        //
    }

    public function destroy($id)
    {
        $paymentGateway=PaymentGateway::findorfail($id);
        $res=$paymentGateway->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

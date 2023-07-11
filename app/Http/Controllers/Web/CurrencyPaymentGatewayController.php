<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\CurrencyPaymentGateway;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class CurrencyPaymentGatewayController extends Controller
{
    
    public function index($currencyId,Request $request)
    {
        if ($request->ajax()) {
            $datas= CurrencyPaymentGateway::query()->where('currency_id',Crypt::decrypt($currencyId));
            $status = $request->status_search;
            if ($status!=null) {
                $datas->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('payment_gateway', function($data) {
                    if($data->paymentGateway){
                        return $data->paymentGateway->payment_gateway;
                    }else{
                        return Null;
                    }
                })
                ->addColumn('default', function($data) {
                    if($data->is_default==1){
                        return "Default";
                    }else{
                        return Null;
                    }
                })
                ->addColumn('action', 'admin.countries.currencies.payment_gateways.action')
                ->make(true);
        }
        $gateways=PaymentGateway::where('status',1)->get();
        return view('admin.countries.currencies.payment_gateways.index',['paymentGateways'=>$gateways,'currencyId'=>$currencyId]);
    }

    public function create($currencyId)
    {
        //
    }

    public function store($currencyId,Request $request)
    {
        $request->validate([
			'payment_gateway_id' => 'required',
            'id'=>'required'
		]);
        if($request->is_default==1){
            $data=CurrencyPaymentGateway::where('currency_id',Crypt::decrypt($currencyId))->where('is_default',1)->first();
            if($data){
                $data->update(['is_default'=>0]);
            }
        }
        if($request->id>0)
        {
            $data=CurrencyPaymentGateway::findorfail(Crypt::decrypt($request->id));
            $res=$data->update(['payment_gateway_id'=>$request->payment_gateway_id,'status'=>$request->status,'currency_id'=>Crypt::decrypt($currencyId),'is_default'=>$request->is_default]);
        }else{
            $res=CurrencyPaymentGateway::Create(['payment_gateway_id'=>$request->payment_gateway_id,'status'=>$request->status,'currency_id'=>Crypt::decrypt($currencyId),'is_default'=>$request->is_default])->id;
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show($currencyId,CurrencyPaymentGateway $currencyPaymentGateway)
    {
        //
    }

    public function edit($currencyId,CurrencyPaymentGateway $currencyPaymentGateway)
    {
        //
    }

    public function update($currencyId,Request $request, CurrencyPaymentGateway $currencyPaymentGateway)
    {
        //
    }

    public function destroy($currencyId,$id)
    {
        $country=CurrencyPaymentGateway::findorfail($id);
        $res=$country->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

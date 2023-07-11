<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\CountryCurrency;
use App\Models\Currency;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Crypt;

class CountryCurrencyController extends Controller
{
    
    public function index($countryId,Request $request)
    {
        if ($request->ajax()) {
            $datas= CountryCurrency::query()->where('country_id',Crypt::decrypt($countryId));
            $status = $request->status_search;
            if ($status!=null) {
                $datas->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('currency', function($data) {
                    if($data->currency){
                        return $data->currency->currency;
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
                ->addColumn('action', 'admin.countries.currencies.action')
                ->make(true);
        }
        $currencies=Currency::where('status',1)->get();
        return view('admin.countries.currencies.index',['currencies'=>$currencies,'countryId'=>$countryId]);
    }
    
    public function create($countryId)
    {
        //
    }

    public function store($countryId,Request $request)
    {
        $request->validate([
			'currency_id' => 'required',
            'id'=>'required'
		]);
        if($request->is_default==1){
            $data=CountryCurrency::where('country_id',Crypt::decrypt($countryId))->where('is_default',1)->first();
            if($data){
                $data->update(['is_default'=>0]);
            }
        }
        if($request->id>0)
        {
            $data=CountryCurrency::findorfail(Crypt::decrypt($request->id));
            $res=$data->update(['currency_id'=>$request->currency_id,'status'=>$request->status,'country_id'=>Crypt::decrypt($countryId),'is_default'=>$request->is_default]);
        }else{
            $res=CountryCurrency::Create(['currency_id'=>$request->currency_id,'status'=>$request->status,'country_id'=>Crypt::decrypt($countryId),'is_default'=>$request->is_default])->id;
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show($countryId,CountryCurrency $countryCurrency)
    {
        //
    }

    public function edit($countryId,CountryCurrency $countryCurrency)
    {
        //
    }

    public function update($countryId,Request $request, CountryCurrency $countryCurrency)
    {
        //
    }

    public function destroy($countryId,$id)
    {
        $country=CountryCurrency::findorfail($id);
        $res=$country->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\PaymentGateway;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class CountryController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries= Country::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $countries->where(function ($query) use ($search) {
                    $query->where('country', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $countries->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($countries)
                ->addIndexColumn()
                ->addColumn('action', 'admin.countries.action')
                ->addColumn('region', function($data) {
                    if($data->region){
                        return $data->region->region;
                    }else{
                        return Null;
                    }
                })
                ->addColumn('codes', function($data) {
                    return $data->country_code . " / " . $data->telephone_code;
                })
                ->make(true);
        }
        $currencies=Currency::where('status',1)->get();
        $gateways=PaymentGateway::where('status',1)->get();
        $regions=Region::where('status',1)->get();
        return view('admin.countries.index',['currencies'=>$currencies,'paymentGateways'=>$gateways,'regions'=>$regions]);
    }

    public function create()
    {
        $countries=Country::where('status',1)->latest('created_at')->get();
        return $countries;
    }

    public function store(Request $request)
    {
        $request->validate([
			'country' => 'required',
            'id'=>'required'
		]);
        if($request->id>0)
        {
            $country=Country::findorfail(Crypt::decrypt($request->id));
            $res=$country->update(['country'=>$request->country,'status'=>$request->status,'country_code'=>$request->country_code,'telephone_code'=>$request->telephone_code,'region_id'=>$request->region_id]);
        }else{
            $res=Country::Create(['country'=>$request->country,'status'=>$request->status,'country_code'=>$request->country_code,'telephone_code'=>$request->telephone_code,'region_id'=>$request->region_id])->id;
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show($id)
    {
        $country=Country::findorfail(Crypt::decrypt($id));
        return $country;
    }

    public function edit(Country $country)
    {
        //
    }

    public function update(Request $request, Country $country)
    {
        //
    }

    public function destroy($id)
    {
        $country=Country::findorfail($id);
        $res=$country->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

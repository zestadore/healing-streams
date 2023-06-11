<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use DataTables;

class CurrencyController extends Controller
{
   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currencies= Currency::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $currencies->where(function ($query) use ($search) {
                    $query->where('currency', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $currencies->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($currencies)
                ->addIndexColumn()
                ->addColumn('action', 'admin.currencies.action')
                ->make(true);
        }
        return view('admin.currencies.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
			'currency' => 'required',
            'currency_symbol' => 'required',
            'id'=>'required|numeric'
		]);
        if($request->id>0)
        {
            $currency=Currency::findorfail($request->id);
            $res=$currency->update(['currency'=>$request->currency,'status'=>$request->status,'currency_symbol'=>$request->currency_symbol]);
        }else{
            $res=Currency::Create(['currency'=>$request->currency,'status'=>$request->status,'currency_symbol'=>$request->currency_symbol]);
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show(Currency $currency)
    {
        //
    }

    public function edit(Currency $currency)
    {
        //
    }

    public function update(Request $request, Currency $currency)
    {
        //
    }

    public function destroy($id)
    {
        $currency=Currency::findorfail($id);
        $res=$currency->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

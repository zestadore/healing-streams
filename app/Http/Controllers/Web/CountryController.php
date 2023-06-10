<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
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
                ->make(true);
        }
        return view('admin.countries.index');
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
            'id'=>'required|numeric'
		]);
        if($request->id>0)
        {
            $country=Country::findorfail($request->id);
            $res=$country->update(['country'=>$request->country,'status'=>$request->status]);
        }else{
            $res=Country::Create(['country'=>$request->country,'status'=>$request->status]);
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show(Country $country)
    {
        $states=$country->states;
        return $states;
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

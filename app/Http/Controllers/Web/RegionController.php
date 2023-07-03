<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use DataTables;

class RegionController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $regions= Region::query();
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $regions->where(function ($query) use ($search) {
                    $query->where('region', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $regions->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($regions)
                ->addIndexColumn()
                ->addColumn('action', 'admin.regions.action')
                ->make(true);
        }
        return view('admin.regions.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
			'region' => 'required',
            'id'=>'required|numeric'
		]);
        if($request->id>0)
        {
            $region=Region::findorfail($request->id);
            $res=$region->update(['region'=>$request->region,'status'=>$request->status]);
        }else{
            $res=Region::Create(['region'=>$request->region,'status'=>$request->status]);
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show(Region $region)
    {
        //
    }

    public function edit(Region $region)
    {
        //
    }

    public function update(Request $request, Region $region)
    {
        //
    }

    public function destroy($id)
    {
        $region=Region::findorfail($id);
        $res=$region->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

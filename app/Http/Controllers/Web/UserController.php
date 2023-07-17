<?php

namespace App\Http\Controllers\Web;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users= User::query()->whereNot('email','admin@demoapplicationz.com');
            $search = $request->search;
            $status = $request->status_search;
            if ($search) {
                $users->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%');
                });
            }
            if ($status!=null) {
                $users->where(function ($query) use ($status) {
                    $query->where('status', $status);
                });
            }
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', 'admin.users.action')
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
			'first_name' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric',
            'id'=>'required|numeric'
		]);
        if($request->id>0)
        {
            $data=User::findorfail($request->id);
            $res=$data->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'mobile'=>$request->mobile,'role'=>'user']);
        }else{
            $res=User::Create(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'mobile'=>$request->mobile,'role'=>'user','password' => Hash::make($request->mobile)]);
        }
        if($res){
            return response()->json(['success'=>"Data inserted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $employee=User::find($id);
        $password=mt_rand(10000,100000);
        $res=$employee->update(['password'=>Hash::make($password)]);
        if($res){
            return response()->json(['success'=>"Data inserted successfully!",'message'=>'Password for ' . $employee->email . ' is ' . $password]);
        }else{
            return response()->json(['error'=>"Failed to insert the data, kindly try again!"]);
        }
    }

    public function destroy(string $id)
    {
        $data=User::findorfail($id);
        $res=$data->delete();
        if($res){
            return response()->json(['success'=>"Data deleted successfully!"]);
        }else{
            return response()->json(['error'=>"Failed to delete the data, kindly try again!"]);
        }
    }
}

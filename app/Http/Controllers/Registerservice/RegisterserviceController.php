<?php

namespace App\Http\Controllers\Registerservice;

use App\Models\Registerservice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Response;
use Redirect;

class RegisterserviceController extends Controller
{
    public function index(Request $request){
        $Registerservice =  Registerservice::orderby('created_at','desc')->paginate('10');
        return view('admin.registerservice.index',[
            'registerservice' => $Registerservice,
            'title' => 'Danh sách yêu cầu',
        ]);
    }

    public function edit(Request $request, $id){
        $Registerservice = Registerservice::find($id);
        return view('admin.registerservice.edit',[
            'registerservice' => $Registerservice,
            'title' => 'Yêu cầu của khách hàng:',
        ]);
    }

    public function create(Request $request){
        $registerservice  = [
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'request'        => $request->customer_request,
        ];
        try {
            DB::beginTransaction();
            Registerservice::create($registerservice);
            DB::commit();
            return response()->json(['success'=>true]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error'=>true]);
        }
    }
}

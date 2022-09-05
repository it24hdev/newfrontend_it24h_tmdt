<?php

namespace App\Http\Controllers\RecruitRegister;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruit_register;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;
use Redirect;

class RecruitRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'recruit',  'active' => 'Danh sách ứng tuyển']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->authorize('view', Recruit_register::class);
        $limit    =  $request->query('limit');
        $keywords =  $request->query('search');
        $orderby  =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if ($sort  == null) {
            $sort  = 'ASC';
        }
        if ($limit == null) {
            $limit = 10;
        }
        if ($keywords == null) {
            $keywords = "";
        }
        if ($orderby  == null) {
            $orderby  = "id";
        }
        if ($limit == 10 && $keywords == "" && $orderby == "id" && $sort =="asc") {
            $Recruit_register = Recruit_register::paginate($limit);
        } else
            $Recruit_register = Recruit_register::where('vitriungtuyen', 'like', '%' . $keywords . '%')->orderby($orderby, $sort)->Paginate($limit);
        return view('admin.Recruit_register.index', [
            'Recruit_registers' => $Recruit_register,
            'title'    => 'Tuyên dụng'
        ]);
    }

     public function update(Request $request)
    {

        $this->authorize('update', Recruit_register::class);
        $Recruit_registers = Recruit_register::find($request->id);
       
        $Recruit_register  = [
            'status'  => $request->status,
        ];

        try {
            DB::beginTransaction();
            $Recruit_registers->update($Recruit_register);
            DB::commit();
            return \json_encode(array('success'=>true));
        }
        catch (\Exception $exception){
            DB::rollBack();
            return \json_encode(array('success'=>false));
        }
    }
}

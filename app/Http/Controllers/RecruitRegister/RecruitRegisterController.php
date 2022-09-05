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
use Redirect

class RecruitRegisterController extends Controller
{
    public function index(Request $request){

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
            $Recruits = Recruit_register::paginate($limit);
        } else
            $Recruits = Recruit_register::where('vitriungtuyen', 'like', '%' . $keywords . '%')->orderby($orderby, $sort)->Paginate($limit);
        return view('admin.Recruit_register.index', [
            'recruits' => $Recruits,
            'title'    => 'Tuyên dụng'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Recruit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;
use Redirect;


class RecruitController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'recruit',  'active' => 'Danh sách tuyển dụng']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $this->authorize('view', Recruit::class);
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
            $Recruits = Recruit::paginate($limit);
        } else
            $Recruits = Recruit::where('vacancies', 'like', '%' . $keywords . '%')->orderby($orderby, $sort)->Paginate($limit);
        return view('admin.recruit.index', [
            'recruits' => $Recruits,
            'title'    => 'Tuyên dụng'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('update', Recruit::class);
        $edit = Recruit::find($id);
        if ($edit !== null) {
            return view('admin.recruit.edit',[
                'title'        => 'Sửa',
                'edit'         => $edit,
            ]);
        }
        else {
            \abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Recruit::class);
        $request->validate([
            'vacancies'  => 'required|max:255',
        ],
        [
            'vacancies.required' => 'Vị trí tuyển dụng không được phép bỏ trống',
            'vacancies.max'      => 'Vị trí tuyển dụng không được phép vượt quá 255 ký tự',
        ]); 
        

        $Recruits = Recruit::find($id);
        if(empty($Recruits)){
            return \abort(404);
        }

        if( $request->location == null){
            $request->location = 'AnGiang';
        }
        if($request->location_name == null){
            $request->location_name = "An Giang";
        }

        $Recruit  = [
            'location'  => $request->location,
            'location_name'  => $request->location_name,
            'vacancies' => $request->vacancies,
            'type'      => $request->type,
            'quantum'   => $request->quantum,
            'income'    => $request->income,
            'deadline'  => $request->deadline,
            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            $Recruits->update($Recruit);
            DB::commit();
            return redirect()->route('recruit.index')->with('success','Cập nhật thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('recruit.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function create()
    {
        $this->authorize('create', Recruit::class);
        return view('admin.recruit.create',[
            'title' => 'Tạo mới',
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'vacancies'  => 'required|max:255',
        ],
        [
            'vacancies.required' => 'Vị trí tuyển dụng không được phép bỏ trống',
            'vacancies.max'      => 'Vị trí tuyển dụng không được phép vượt quá 255 ký tự',
        ]); 
        

        $Recruits = new Recruit();
        if(empty($Recruits)){
            return \abort(404);
        }  

        if( $request->location == null){
            $request->location = 'AnGiang';
        }
        if($request->location_name == null){
            $request->location_name = "An Giang";
        }


        $Recruit  = [
            'location'  => $request->location,
            'location_name'  => $request->location_name,
            'vacancies' => $request->vacancies,
            'type'      => $request->type,
            'quantum'   => $request->quantum,
            'income'    => $request->income,
            'deadline'  => $request->deadline,
            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            $Recruits->create($Recruit);
            DB::commit();
            return redirect()->route('recruit.index')->with('success','Cập nhật thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('recruit.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function destroy(Request $request)
    {
        $this->authorize('delete',Recruit::class);
        $Recruits     = Recruit::find($request->id);
        if (!is_null($Recruits)){
            $Recruits->delete();
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }
}

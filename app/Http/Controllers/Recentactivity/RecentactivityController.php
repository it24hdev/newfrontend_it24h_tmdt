<?php

namespace App\Http\Controllers\Recentactivity;

use App\Models\Recentactivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Response;
use Redirect;

class RecentactivityController extends Controller
{
    public function index(Request $request){
        $Recentactivity = Recentactivity::orderby('created_at','desc')->paginate(10);
        return view('admin.recentactivity.index',[
            'title' => 'Hoạt động gần đây',
            'Recentactivity' => $Recentactivity,
        ]);
    }
    public function store(Request $request)
    {
        $Recentactivity  = [
            'name'           => $request->name,
            'activities'       => $request->activities,
            'attr'           => $request->attr,
            'status'         => $request->has('status'),
        ];
        try {
            DB::beginTransaction();
            Recentactivity::create($Recentactivity);
            DB::commit();
            return redirect()->route('recentactivity.index')->with('success','Thêm thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('recentactivity.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function destroy(Request $request)
    {
        $Recentactivity     = Recentactivity::find($request->id);
        if (!is_null($Recentactivity)){
            $Recentactivity->delete();
            return response()->json(['success'=>true]);
        }
        return \json_encode(array('success'=>false));
    }

    public function edit_ajax(Request $request){
        $Recentactivity = Recentactivity::find($request->id);
        return response()->json($Recentactivity);
    }

    public function update_ajax(Request $request){
        $Recentactivity = Recentactivity::find($request->id);
        $Recentactivities  = [
            'name'           => $request->name,
            'activities'     => $request->activities,
            'attr'           => $request->attr,
            'status'         => $request->status,
        ];

        try {
            DB::beginTransaction();
            $Recentactivity->update($Recentactivities);
            DB::commit();
            return response()->json(['success'=>true]);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error'=>true]);
        }

    }

}

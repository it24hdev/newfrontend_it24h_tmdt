<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\vouchers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    public function index(Request $request){
        $keywords =  $request->query('search');
        if($keywords){
            $vouchers = vouchers::where('status',1)->where('name','like','%'.$keywords.'%')->paginate(10);
        }
        else{
            $vouchers = vouchers::where('status',1)->orderby('created_at','desc')->paginate(10);
        }
        return view('admin.vouchers.index',[
            'title' => 'Vouchers',
            'vouchers' => $vouchers,
        ]);
    }
    public function store(Request $request)
    {
        $voucher  = [
            'code'         => $request->code,
            'name'         => $request->name,
            'describe'     => $request->describe,
            'value'        => $request->value,
            'percent'      => $request->percent,
            'status'       => $request->has('status')
        ];
        vouchers::create($voucher);
        try {
            DB::beginTransaction();

            DB::commit();
            return redirect()->route('vouchers.index')->with('success', 'Thêm mới voucher thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('vouchers.index')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }

    }
}

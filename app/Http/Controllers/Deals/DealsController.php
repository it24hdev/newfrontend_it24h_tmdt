<?php

namespace App\Http\Controllers\Deals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Deals;
use Illuminate\Support\Facades\DB;

class DealsController extends Controller
{
    public function index(Request $request)
    {
        $orderby = $request->orderby;
        $keyword = $request->search;
        $Deals = DB::table('deals')
            ->select(DB::raw('deals.* ') ,DB::raw('products.thumb'),DB::raw('products.price'))
            ->leftjoin('products', 'products.id', 'deals.product_id')
            ->where('products.status',1)
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('deals.name_deal','like','%'.$keyword.'%');
                }
            })
            ->where(function ($query) use ($orderby) {
                if ($orderby == 'not_started') {
                    $query->where('deals.start_time','>',now())->where('deals.end_time','>',now());
                }
                if ($orderby == 'starting') {
                    $query->where('deals.start_time','<',now())->where('deals.end_time','>',now());
                }
                if ($orderby == 'time_out') {
                    $query->where('deals.start_time','<',now())->where('deals.end_time','<',now());
                }
                if ($orderby == 'status_deal') {
                    $query->where('deals.status_deal',1);
                }
            })
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('admin.deals.index',[
            'title' => "Deal/Giờ vàng",
            'deals' => $Deals
        ]);
    }
    public function product_deal(Request $request){
        $products = Products::where('status',1)
        ->whereNotIn('id', DB::table('deals')->pluck('product_id'))->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = Products::find($request->id);
        $deal = [
            'product_id' => $request->id,
            'name_deal' => $product->name,
        ];
        try {
            DB::beginTransaction();
            $new_deal = Deals::create($deal);
            DB::commit();
            $item = DB::table('deals')
                ->select(DB::raw('deals.* '),DB::raw('products.thumb'),DB::raw('products.price'))
                ->leftjoin('products', 'products.id', 'deals.product_id')
                ->where('deals.id',$new_deal->id)
                ->first();
            return response()->json(['success'=>true,'item' => $item]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error'=>true]);
        }
    }
    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $item = DB::table('deals')
            ->select(DB::raw('deals.* '),DB::raw('products.name as product_name'), DB::raw('products.thumb'),DB::raw('products.price'))
            ->leftjoin('products', 'products.id', 'deals.product_id')
            ->where('deals.id',$request->id)
            ->first();
        if($item){
            return response()->json(['success'=>true, 'item'=>$item]);
        }
        return response()->json(['error'=>true]);
    }

    public function update(Request $request)
    {
        $deals = Deals::find($request->id);
        $start_date = $request->start_date;
        $start_hour = $request->start_time;
        $start_time = date('Y-m-d H:i:s', strtotime("$start_date $start_hour"));
        $end_date = $request->end_date;
        $end_hour = $request->end_time;
        $end_time = date('Y-m-d H:i:s', strtotime("$end_date $end_hour"));

        if(!$start_date && !$start_hour){
            $start_time = $deals->start_time;
        }
        if(!$end_date && !$end_hour){
            $end_time = $deals->end_time;
        }
        if(!$request->name_deal){
            $request->name_deal = $deals->name_deal;
        }
        if(!$request->price_deal){
            $request->price_deal = $deals->price_deal;
        }
        if(!$request->quantity_deal){
            $request->quantity_deal = $deals->quantity_deal;
        }
        if(!$request->order_display){
            $request->order_display = $deals->order_display;
        }
        if(!$request->describe){
            $request->describe = $deals->describe;
        }

        $deal =[
            'name_deal' => $request->name_deal,
            'price_deal' => $request->price_deal,
            'quantity_deal' => $request->quantity_deal,
            'order_display' => $request->order_display,
            'status_deal' => $request->status_deal,
            'describe' => $request->describe,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];

        try {
            DB::beginTransaction();
            $deals->update($deal);
            DB::commit();
            $item = Deals::select(DB::raw('deals.* '),DB::raw('products.thumb'),DB::raw('products.price'))
                ->leftjoin('products', 'products.id', 'deals.product_id')
                ->where('deals.id',$request->id)
                ->first();
            return response()->json(['success'=>true,'item' => $item]);
        }catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error'=>true]);
        }
    }

    public function destroy(Request $request)
    {
        $deal = Deals::find($request->id);
        if ($deal) {
            $deal->delete();
            return json_encode(array('success' => true));
        }
        else{
            return json_encode(array('error' => true));
        }
    }

    public function multiple_destroy(Request $request)
    {
        try {
            Deals::destroy($request->list_id);
            return response()->json(['success'=>true]);
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error'=>true]);
        }
    }
}

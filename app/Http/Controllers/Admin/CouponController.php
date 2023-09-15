<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Coupon::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('description', 'LIKE', "%{$request->key}%");
            $query->orwhere('code', 'LIKE', "%{$request->key}%");
            $query->orwhere('min_amount_buy', 'LIKE', "%{$request->key}%");
            $query->orwhere('start_at', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.coupon.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Coupon;
        $data->name = $request->coupon_name;
        $data->description = $request->coupon_description;
        $data->code = $request->coupon_code;
        $data->min_amount_buy = $request->minimum_amount_to_buy;
        $data->start_at = $request->coupon_start_time;
        $data->end_at = $request->coupon_end_time;
        $data->amount = $request->amount;
        $data->save();
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data['data'] = Size::where('id', $id)->latest()->get();
        // return view('admin.__pertials.sub-category', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = Coupon::findOrFail($id);
        return view('admin.coupon.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Coupon::findOrFail($id);
        $data->name = $request->coupon_name;
        $data->description = $request->coupon_description;
        $data->code = $request->coupon_code;
        $data->min_amount_buy = $request->minimum_amount_to_buy;
        $data->start_at = $request->coupon_start_time;
        $data->end_at = $request->coupon_end_time;
        $data->amount = $request->amount;
        $data->save();
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Coupon::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Coupon Successfully Deleted');
    }
}

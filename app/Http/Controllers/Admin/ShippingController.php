<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Shipping::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('duration', 'LIKE', "%{$request->key}%");
            $query->orwhere('ship_to', 'LIKE', "%{$request->key}%");
            $query->orwhere('description', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        $data['admin'] = Admin::first();
        return view('admin.shipping.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['admin'] = Admin::first();
        return view('admin.shipping.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:sizes,name',
            'duration'=>'required',
            'ship_to' => 'required'
        ]);
        $data = new Shipping;
        $data->name = $request->name;
        $data->duration = $request->duration;
        $data->ship_to = $request->ship_to;
        $data->description = $request->description;
        $data->save();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping Created Successfully');
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
        $data['admin'] = Admin::first();
        $data['data'] = Shipping::findOrFail($id);
        return view('admin.shipping.edit', $data);
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
        $this->validate($request,[
            'name'=>'required|max:255|unique:sizes,name,'.$id,
            'duration'=>'required',
            'ship_to' => 'required'
        ]);
        $data = Shipping::findOrFail($id);
        $data->name = $request->name;
        $data->duration = $request->duration;
        $data->ship_to = $request->ship_to;
        $data->description = $request->description;
        $data->save();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Shipping::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Shipping Successfully Deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Services\SlugService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Size::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('measurement', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.size.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
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
            'name'=>'nullable|max:255|unique:sizes,name',
            'measurement'=>'required'
        ]);
        $data = new Size;
        $data->name = $request->name;
        $data->measurement = $request->measurement;
        $data->save();
        return redirect()->route('admin.size.index')->with('success', 'Size Created Successfully');
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

        $data['data'] = Size::findOrFail($id);
        return view('admin.size.edit', $data);
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
            'name'=>'nullable|max:255|unique:sizes,name,'.$id,
            'measurement'=>'required'
        ]);
        $data = Size::findOrFail($id);
        $data->name = $request->name;
        $data->measurement = $request->measurement;
        $data->save();
        return redirect()->route('admin.size.index')->with('success', 'Size Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Size::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Size Successfully Deleted');
    }
}

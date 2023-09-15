<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\HomeSlider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = HomeSlider::when($request->key, function($query) use($request){
            $query->where('title', 'LIKE', "%{$request->key}%");
            $query->orwhere('description', 'LIKE', "%{$request->key}%");
            $query->orwhere('button_name', 'LIKE', "%{$request->key}%");
            $query->orwhere('button_url', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.slider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageService $image)
    {
        $this->validate($request,[
            'image'=>'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = new HomeSlider();
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'slider',);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        $data->save();
        return redirect()->route('admin.slider.index')->with('success', 'Slider Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = HomeSlider::findOrFail($id);
        return view('admin.slider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageService $image, Request $request, $id)
    {
        $this->validate($request,[
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = HomeSlider::findOrFail($id);
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'slider',);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->button_name = $request->button_name;
        $data->button_url = $request->button_url;
        $data->save();
        return redirect()->route('admin.slider.index')->with('success', 'Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageService $image, $id)
    {
        $data = HomeSlider::findOrFail($id);
        $image->delete($data->image);
        $data->delete();
        return redirect()->back()->with('success', 'Slider Successfully Deleted');
    }
}

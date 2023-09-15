<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainMneu;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Category::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('slug', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.categories.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ImageService $image, SlugService $slug, Request $request)
    {



        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = new Category;
        $data->name = $request->name;
        $data->slug = $slug->create($request->name);
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'category', ['small']);
        $data->save();

        if($request->has('show_main_menu')){
            $item['name'] = $request->name;
            $item['slug'] = '/shop/'.$data->slug;
            $item['category_id'] = $data->id;
            $item['status'] = 1;
            MainMneu::create($item);
        }



        return redirect()->route('admin.category.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = Category::findOrFail($id);
        $data['menu'] = MainMneu::where('category_id', $id)->where('status', 1)->first();
        return view('admin.categories.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageService $image, SlugService $slug, Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name,'.$id,
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->slug = $slug->edit($request->name, $data->slug);
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'category', ['small']);
        $data->save();

        MainMneu::where('category_id', $data->id)->where('status', 1)->delete();
        if($request->has('show_main_menu')){
            $item['name'] = $request->name;
            $item['slug'] = '/shop/'.$data->slug;
            $item['category_id'] = $data->id;
            $item['status'] = 1;
            MainMneu::create($item);
        }

        return redirect()->route('admin.category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlugService $slug, ImageService $image, $id)
    {
        $data = Category::findOrFail($id);
        $slug->delete($data->slug);
        $image->delete($data->image);
        MainMneu::where('category_id', $data->id)->where('status', 1)->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Category Successfully Deleted');
    }
}

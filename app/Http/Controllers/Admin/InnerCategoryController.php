<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\InnerCategory;
use App\Models\MainMneu;
use App\Models\SubCategory;
use App\Services\ImageService;
use App\Services\SlugService;
use Illuminate\Http\Request;

class InnerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = InnerCategory::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orWhereHas('category', function($query) use($request){
                $query->where('name', 'LIKE', "%{$request->key}%");
            });
            $query->orWhereHas('subCategory', function($query) use($request){
                $query->where('name', 'LIKE', "%{$request->key}%");
            });
            $query->orwhere('slug', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.categories.inner-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::latest()->get();
        return view('admin.categories.inner-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( SlugService $slug, ImageService $image, Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:sub_categories,name',
            'category'=>'required',
            'sub_category' => 'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = new InnerCategory;
        $data->name = $request->name;
        $data->slug = $slug->create($request->name);
        $data->category_id = $request->category;
        $data->sub_category_id = $request->sub_category;
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'category', ['small']);
        $data->save();

        if($request->has('show_main_menu')){
            $getInnerCat = InnerCategory::where('id', $data->id)->with('category', 'subCategory')->first();
            $item['name'] = $request->name;
            $item['slug'] = '/shop/'.$getInnerCat->category->slug.'/'.$getInnerCat->subCategory->slug.'/'.$data->slug;
            $item['category_id'] = $data->id;
            $item['status'] = 3;
            MainMneu::create($item);
        }

        return redirect()->route('admin.inner-category.index')->with('success', 'Inner Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = InnerCategory::where('sub_category_id', $id)->latest()->get();
        return view('admin.__pertials.inner-category', $data)->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = InnerCategory::findOrFail($id);
        $data['category'] = Category::latest()->get();
        $data['sub_category'] = SubCategory::where('category_id', $data['data']->category_id)->get();
        $data['menu'] = MainMneu::where('category_id', $id)->where('status', 3)->first();
        return view('admin.categories.inner-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlugService $slug, ImageService $image, Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:sub_categories,name,'.$id,
            'category'=>'required',
            'sub_category' => 'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
        $data = InnerCategory::findOrFail($id);
        $data->name = $request->name;
        $data->slug = $slug->create($request->name);
        $data->category_id = $request->category;
        $data->sub_category_id = $request->sub_category;
        if($request->hasFile('image')) $data->image = $image->upload($request->image, 'category', ['small']);
        $data->save();

        MainMneu::where('category_id', $data->id)->where('status', 3)->delete();
        if($request->has('show_main_menu')){
            $getInnerCat = InnerCategory::where('id', $data->id)->with('category', 'subCategory')->first();
            $item['name'] = $request->name;
            $item['slug'] = '/shop/'.$getInnerCat->category->slug.'/'.$getInnerCat->subCategory->slug.'/'.$data->slug;
            $item['category_id'] = $data->id;
            $item['status'] = 3;
            MainMneu::create($item);
        }

        return redirect()->route('admin.inner-category.index')->with('success', 'Inner Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlugService $slug, ImageService $image, $id)
    {
        $data = InnerCategory::findOrFail($id);
        $slug->delete($data->slug);
        $image->delete($data->image);
        MainMneu::where('category_id', $data->id)->where('status', 3)->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Inner Category Successfully Deleted');
    }
}

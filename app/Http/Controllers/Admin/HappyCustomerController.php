<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HappyCustomer;
use App\Services\ImageService;
use Illuminate\Http\Request;

class HappyCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = HappyCustomer::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('what_said', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.happy-customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.happy-customer.create');
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
            'name'=>'required|max:255',
            'what_said'=>'required',
            'avatar'=>'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if($request->hasFile('avatar')) $request['image'] = $image->upload($request->avatar, 'happy_customer');
        HappyCustomer::create($request->all());
        return redirect()->route('admin.happy-customer.index')->with('success', 'Happy Customer Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = HappyCustomer::findOrFail($id);
        return view('admin.happy-customer.edit', $data);
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
            'name'=>'required|max:255',
            'what_said'=>'required',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $hcustomer = HappyCustomer::findOrFail($id);
        if($request->hasFile('avatar')){
            $image->delete($hcustomer->image);
            $request['image'] = $image->upload($request->avatar, 'happy_customer');
        }
        $hcustomer->fill($request->all())->save();
        return redirect()->route('admin.happy-customer.index')->with('success', 'Happy Customer Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageService $image, $id)
    {
        $data = HappyCustomer::findOrFail($id);
        $image->delete($data->image);
        $data->delete();
        return redirect()->back()->with('success', 'Happy Customer Successfully Deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Team::when($request->key, function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->key}%");
            $query->orwhere('designation', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.team.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
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
            'designation'=>'required|max:255',
            'sort_description'=>'required',
            'avatar'=>'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if($request->hasFile('avatar')) $request['image'] = $image->upload($request->avatar, 'team');
        Team::create($request->all());
        return redirect()->route('admin.team.index')->with('success', 'Team Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['data'] = Team::findOrFail($id);
        return view('admin.team.edit', $data);
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
            'designation'=>'required|max:255',
            'sort_description'=>'required',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $team = Team::findOrFail($id);
        if($request->hasFile('avatar')){
            $image->delete($team->image);
            $request['image'] = $image->upload($request->avatar, 'team');
        }
        $team->fill($request->all())->save();
        return redirect()->route('admin.team.index')->with('success', 'Team Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageService $image, $id)
    {
        $data = Team::findOrFail($id);
        $image->delete($data->image);
        $data->delete();
        return redirect()->back()->with('success', 'Team Successfully Deleted');
    }
}

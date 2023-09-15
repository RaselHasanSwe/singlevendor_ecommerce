<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $data['data'] = Faq::when($request->key, function($query) use($request){
            $query->where('question', 'LIKE', "%{$request->key}%");
            $query->orwhere('answer', 'LIKE', "%{$request->key}%");
        })
        ->latest()
        ->paginate(15);
        return view('admin.faqs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
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
            'question'=>'required|max:255',
            'answer'=>'required|max:255',
        ]);
        $data = new Faq();
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ Created Successfully');
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

        $data['data'] = Faq::findOrFail($id);
        return view('admin.faqs.edit', $data);
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
            'question'=>'required|max:255',
            'answer'=>'required|max:255',
        ]);
        $data = Faq::findOrFail($id);
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Faq::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'FAQ Successfully Deleted');
    }
}

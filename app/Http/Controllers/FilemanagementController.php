<?php

namespace App\Http\Controllers;

use App\Filemanagement;
use Illuminate\Http\Request;

class FilemanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $filemanagements = Filemanagement::latest()->paginate(5);
        return view('filemanagements.index',compact('filemanagements'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('filemanagements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        Filemanagement::create($request->all());
   
        return redirect()->route('filemanagements.index')
                        ->with('success','File management created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Filemanagement  $filemanagement
     * @return \Illuminate\Http\Response
     */
    public function show(Filemanagement $filemanagement)
    {
        return view('filemanagements.show',compact('filemanagement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Filemanagement  $filemanagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Filemanagement $filemanagement)
    {
        return view('filemanagements.edit',compact('filemanagement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Filemanagement  $filemanagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filemanagement $filemanagement)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        $filemanagement->update($request->all());
  
        return redirect()->route('filemanagements.index')
                        ->with('success','Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Filemanagement  $filemanagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filemanagement $filemanagement)
    {
         $filemanagement->delete();
  
        return redirect()->route('filemanagements.index')
                        ->with('success','Blogs deleted successfully');
    }
}

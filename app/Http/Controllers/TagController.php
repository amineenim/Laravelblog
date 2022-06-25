<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth') ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retreive all tag records from database 
        $tags = Tag::all() ;
        //pass the $tags variable to a view to be displayed
        return view('tags.index')->with('tags',$tags) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the request credentials submitted from the create form on tags.index
        $tag = $request->validate(
            ['name' => 'required|max:255']
        );
        $tag = new Tag ;
        $tag->name = $request->name ;
        $tag->save() ;
        return redirect()->route('tags.index')->with('tagcreated','Tag created succesefuly !') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //retreive the tag model with the corresponding id 
        $tag = Tag::find($id) ;
        //pass the model to the view to be diplayed
        return view('tags.show')->with('tag',$tag) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return the view containing the form to edit the given tag
        $tag = Tag::find($id) ;
        return view('tags.edit')->with('tag',$tag);
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
        //validate the request
        $validated = $request->validate(
            ['name' => 'required|max:255']);
        $tag = Tag::find($id) ;
        $tag->name = $request->name ;
        $tag->save() ;
        $request->session()->flash('success','Tag updated with success !') ;
        return redirect()->route('tags.show',$tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //retreive the tag model with the corresponding id 
        $tag = Tag::find($id) ;
        $tag->posts()->detach() ;
        $tag->delete() ;
        $request->session()->flash('tagdeleted','the tag was successefully deleted !') ;
        return redirect()->route('tags.index') ;
    }
}

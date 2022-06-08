<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
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
        //retrive all posts from database and pass them to view to display them
        $posts = Post::orderBy('id','desc')->simplePaginate(8) ;
        return view('posts.index')->with('posts',$posts) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
    //validate the request 
        $validated = $request->validate(
            ['title' => 'required|max:255',
             'body'  => 'required|max:255',]);
        //store the post to the database
        $post = new Post ;
        $post->title = $request->title ;
        $post->slug = Str::slug($request->title,"-") ;
        $post->body = $request->body ;
        $post->save();
        $request->session()->flash('message','task done successfuly !') ;
        //redirect the user to posts.show to show the post just stored 
        return redirect()->route('posts.show',$post->slug) ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //return view to show a given blog post

        //retreive the post model from database based on it's id
        $post = Post::where('slug',$slug)->first();
        return view('posts.show')->with('post',$post) ;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //retreive the model with the given id from database and displaying it within a form so user can edit it 
        $post = Post::where('slug',$slug)->first() ;
        return view('posts.edit')->with('post',$post) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //validate incoming data from the post and storing to database
        $validatedPost = $request->validate(
            ['title'=>'required|max:255',
             'body' => 'required|max:255',]);
        //storing to database
        $post = Post::where('slug', $slug)->first() ;
        $post->title = $request->input('title') ;
        $post->slug = Str::slug($request->input('title'),"-") ;
        $post->body = $request->input('body') ;
        $post->save() ;

        //set flash data with success message
        $request->session()->flash('success',' the post was successfully updated ') ;

        //redirect to posts.show with flashing data
        return redirect()->route('posts.show',$post->slug) ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //retreive the post with th given id deleting it 
        $post = Post::find($id) ;
        $post->delete() ;
        $request->session()->flash('deleted','the post was successfully deleted !') ;
        return redirect()->route('posts.index') ;
    }
}

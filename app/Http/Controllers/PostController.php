<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
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
        $categories = Category::all() ;
        $tags = Tag::all() ;
        return view('posts.create')->with(['categories' => $categories,
                                            'tags'       => $tags,]) ;
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
            ['title'      => 'required|max:255',
             'body'       => 'required|max:255',
            'category_id' => 'required|integer',
            ]);
        //store the post to the database
        $post = new Post ;
        $post->title = $request->title ;
        $post->slug = Str::slug($request->title,"-") ;
        $post->body = $request->body ;
        $post->category_id = $request->category_id ;
        $post->user_id = $request->user()->id ;
        $post->save();
        $post->tags()->sync($request->tags,false) ;
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

        //retreive the lastest comments related to the blog post
        $comments = Comment::where('post_id',$post->id)->orderBy('created_at','desc')->paginate(4) ;
        //pass the data to the view to be displayed
        return view('posts.show')->with(['post' => $post,'comments' => $comments]) ;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,Request $request)
    {
        //retreive the post model to edit by slug 
        $post = Post::where('slug',$slug)->first() ;
        //verify if the user is athorized to edit the post 

        if($request->user()->can('update',$post))
        {
        //retreive all categories
        $categories = Category::all() ;
        //retreive the model with the corresponding slug from database and displaying it within a form so user can edit it 
        $tags = Tag::all() ;
        $post = Post::where('slug',$slug)->first() ;
        return view('posts.edit')->with(['post' => $post, 'categories' => $categories,'tags' => $tags,]) ;
        }
        //if not authorized 
        return redirect()->route('posts.index')->with('notauthorized',' you re not authorized to edit this post') ;
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
        //retreive the post with corresponding slug 
        $post = Post::where('slug',$slug)->first() ;
        if($request->user()->can('update',$post))
        {
            //validate incoming data from the post and storing to database
            $validatedPost = $request->validate(
            ['title'      =>'required|max:255',
             'body'       => 'required|max:255',
             'category_id' => 'required|integer',]);
            //storing to database
            $post = Post::where('slug', $slug)->first() ;
            $post->title = $request->input('title') ;
            $post->slug = Str::slug($request->input('title'),"-") ;
            $post->body = $request->input('body') ;
            $post->category_id = $request->input('category_id') ;
            $post->save() ;
            $post->tags()->sync($request->tags) ;

            //set flash data with success message
            $request->session()->flash('success',' the post was successfully updated ') ;

            //redirect to posts.show with flashing data
            return redirect()->route('posts.show',$post->slug) ;
        }

        $request->session()->flash('danger',' the post you try to update not yours you re only allowed to see it ') ;
        return redirect()->route('blog.single')->with('slug',$slug) ;

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
        //detach any tags related to the deleted post
        $post->tags()->detach() ;
        
        $post->delete() ;
        $request->session()->flash('deleted','the post was successfully deleted !') ;
        return redirect()->route('posts.index') ;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
        //validate the incoming request and store the comment
        $validated = $request->validate(
            ['comment' => 'required|min:4|max:255']);
        
        //retreive the id of the currently authenticated user
        $id = Auth::id() ;
        $user = User::find($id);
        //retreive the diplayed post 
        $post = Post::where('slug',$slug)->first() ;
        //set the new comment database columns
        $comment = new Comment ;
        $comment->name = $user->name;
        $comment->email = $user->email ;
        $comment->comment = $request->comment ;
        $comment->approved= '1' ;
        $comment->post_id = $post->id ;

        //save the comment 
        $comment->save() ;
        $request->session()->flash('success',' comment saved with success !') ;
        //redirect back with success message
        return back();
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
    public function edit(Request $request,$id)
    {
        //retreive the comment with the corresponding id
        $comment = Comment::find($id) ;
        //verify if the user is authorized to edit the post 
        if($request->user()->can('update',$comment))
        {
            return view('comments.edit')->with('comment',$comment) ;
        }
        $request->session()->flash('warning','you re not allowed to edit the comment !') ;
        return back() ;
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
        //grab the comment with the corresponding id from db
        $comment = Comment::find($id) ;
        if($request->user()->can('update',$comment))
        {
            //validate the request 
            $validated = $request->validate(
            ['comment'  => 'required|min:10']);
            $comment->comment = $request->comment ;
            $comment->save() ;
            $request->session()->flash('success',' Comment updated successefully !') ;
            $postId = $comment->post->id ;
            $postSlug = Post::find($postId)->slug ;
            return redirect()->route('posts.show',$postSlug) ;
        }
        $request->session()->flash('warning','you re not allowed to edit the comment !') ;
        return back() ;
        
    }
    //shows a form to delete a given comment instance
    public function delete(Request $request,$id)
    {

        //grab the comment with the corresponding id
        $comment = Comment::find($id) ;
        //retreive the post related to that comment
        $post = Post::find($comment->post_id) ;
        //verify if the user is authorized to delete the comment
        if($request->user()->can('delete',$comment))
        {
            return view('comments.delete')->with(['comment'=> $comment,'post' => $post]) ;
        }
        $request->session()->flash('warning','you re not allowed to edit the comment !') ;
        return back() ;
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $comment = Comment::find($id) ;
        if($request->user()->can('update',$comment))
        {
            $postId = $comment->post_id ;
            $postSlug = Post::find($postId)->slug ;
            $comment->delete();
            $request->session()->flash('success',' Comment deleted !') ;
             return redirect()->route('posts.show',$postSlug) ;

        }
        $request->session()->flash('warning','you re not allowed to edit the comment !') ;
        return back() ;
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
    	//retreive our last 10 posts 
    	$posts = Post::orderBy('id','desc')->simplePaginate(5) ;
    	return view('blog.index')->with('posts',$posts) ;
    }
    public function getSingle($slug)
    {
    	//fetch database for the corresponding model based on it's slug
    	$post = Post::where('slug','=',$slug)->first();
    	//return the view displaying the post
    	return view('blog.single')->with('post',$post) ;
    }
    public function getIndex()
    {

    }
}

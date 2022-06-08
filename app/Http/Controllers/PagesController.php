<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getIndex()
    {
        $posts = Post::orderBy('created_at','desc')->limit(4)->get();
    	return view('pages.index')->with('posts', $posts) ;
    }
    public function getAbout()
    {
        $first='Amine';
        $last='Maourid';
        $full =$first." ".$last ;
        $email='aminemaourid@gmail.com';
    	return view('pages.about')->with(['fullname'=>$full,'email'=>$email]) ;
    }
    public function getContact()
    {
    	return view('pages.contact') ;
    }
    public function postContact()
    {

    }
}

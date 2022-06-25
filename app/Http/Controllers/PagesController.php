<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMessage;

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

    public function postContact(Request $request)
    {
        //validate the request 
        $validated = $request->validate(
            ['email'  => 'required|email',
             'subject'=> 'required|min:3',
             'message'=> 'required|min:10',]);

        Mail::send( new ContactFormMessage());
        $request->session()->flash('contactmailsent','Your message has been succesefully sent !');
        return back();
    }
}

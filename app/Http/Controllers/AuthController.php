<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //this function handles login so it will only return a view so that the user can type their informations
    public function login()
    {
    	return view('auth.login') ;
    }

    //this function handles the submitted data and redirects user to right location
    public function authenticate(Request $request)
    {
    	//validating input data
    	$credentials = $request->validate([
    		'email' => 'required|email',
    		'password' => 'required',
    	]);
    	  	//handle the login attempt
    	if(Auth::attempt($credentials))
    	{
    		//user successefully authenticated 
    		//regenerating user session 
    		$request->session()->regenerate() ;
    		$request->session()->flash('authsucces','Bienvenue sur notre blog vous etes authentifié !') ;
    		return redirect()->route('posts.index') ;
    	}
    	return back()->withErrors('submitted data doesn\'t correspond to our database records !')->onlyInput('email') ;
    }

    //this function logs out the user so it will delete data about authentication from session 
    public function logout(Request $request)
    {
        //logout the authenticated user 
        Auth::logout() ;
        //invalidate session
        $request->session()->invalidate() ;
        //regenrate token 
        $request->session()->regenerateToken() ;
        //redirect the user to the homepage of the blog
        return redirect()->route('blog.index') ;

    }

}

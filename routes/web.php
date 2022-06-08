<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Middleware ;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[PagesController::class, 'getIndex']) ;
Route::get('/about',[PagesController::class,'getAbout']);
Route::get('/contact',[PagesController::class,'getContact']);
Route::get('blog/{slug}',[BlogController::class,'getSingle'])->name('blog.single');
Route::get('blog',[BlogController::class,'index'])->name('blog.index') ;
Route::resource('posts',PostController::class) ;
//authentication routes 
Route::get('login',[AuthController::class,'login'])->name('login')->middleware('guest') ;
Route::post('login',[AuthController::class,'authenticate'])->name('authenticate')->middleware('guest') ;
Route::get('logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');

//registration routes 
Route::get('register',function(){ return view('auth.register') ;})->middleware('guest');
Route::post('register',function(Request $request){
	//validate the input data 
	$credentials = $request->validate([
		'name'  => 'required|alpha',
		'email' => 'required|email',
		'password' => 'required|min:10',
		'confirm-password' => 'required | same:password',
	]);
	//store data to database
	$user = new User ;
	$user->name = $request->name ;
	$user->email = $request->email ;
	$user->password = Hash::make($request->password) ;
	$user->save() ;
	//define the user instance as the currently authenticated user
	Auth::login($user) ;
	//flash registration success message
	$request->session()->flash('register','registration done successefully !') ;
	event(new Registered($user));
	//redirect the user to posts.index
	return redirect()->route('posts.index') ;

})->name('register')->middleware('guest');



//routes needed to request password reset links
Route::get('/forgot-password',function()
{
	return view('auth.forgot-password') ;
})->middleware('guest')->name('password.request');

Route::post('/forgot-password',function(Request $request)
{
	//validate the submitted email address from the form 
	$request->validate(['email' => 'required|email']);
	//send a password reset link to user via password broker
	//the password broker will take care of retreiving the user by the given field "email" in this case
	$status = Password::sendResetLink($request->only('email'));
	return $status === Password::RESET_LINK_SENT
	? back()->with('status','password reset link sent !')
	: back()->withErrors(['email' => __($status)]) ;

})->middleware('guest')->name('password.email');

//routes needed for reseting the password 

/*the route that displays the password reset form when a user clicks the password reset
link emailed to them, this route receives a token that will be used to verify the password reset request */
Route::get('/reset-password/{token}', function($token)
{
	return view('auth.reset-password',['token' => $token]);
})->middleware('guest')->name('password.reset');

//route that handles the password reset form submission
Route::post('/reset-password',function(Request $request)
{
	$request->validate(
		['token' => 'required',
	     'email' => 'required|email',
	  'password' => 'required|min:10|confirmed',]);

	/*if the token, email address and password provided to the broker password facade
	are valid, the closure passed to the reset method will be invoked so we can update password in database*/

	$status = Password::reset($request->only('email','password','password_confirmation','token') ,function($user,$password){
		$user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
		$user->save() ;
	});

	return $status === Password::PASSWORD_RESET
	? redirect()->route('login')->with('status',__($status))
	: back()->withErrors(['email' => __($status)]) ;
})->middleware('guest')->name('password.update');


//routes that handle sending the email verification link 

/*route that displays a verification notice to user instructing them to click the verification link emailed to them */
//the link will automatically be emailed to newly registred users 
Route::get('/email/verify',function()
{
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//the page that handles the request when a user clicks the verification email link 

Route::get('/email/verify/{id}/{hash}',function(EmailVerificationRequest $request)
{
	//the EmailVerificationRequest request instance will take care of validating the id and hash parametrs passed to the route 

	//call the fulfill method on the validated request, this method will call the markEmailAsVerified on the authenticated user and dispatch the verified event
	$request->fulfill() ;

	//redirect the user with 
	return redirect()->route('posts.index')->with('verified','Your email adress has been verified succesefully !');
})->middleware(['auth','signed'])->name('verification.verify');

//route that allows the user to request a new email validation link 

//this route will be accessible via a simple form with a button to send the verification link email, this button is placed in the auth.verify-email view
Route::post('email/verification-notification',function(Request $request)
{
	//send an email verification link to the user
	$request->user()->sendEmailVerificationNotification() ;
	//redirect back with message
	return back()->with('sent','verification link sent succesefully !');
})->middleware(['auth','throttle:6,1'])->name('verification.send');
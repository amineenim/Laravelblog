@extends('main')
@section('content')
    	<div class="row justify-content-center">
    		<div class="col-md-8 col-offset-2">
    			<h1>Contact Me</h1>
    			<hr>
    			<p> 
    				<form method="POST" action="{{ route('contact.post')}}">
                        @csrf
    					<div class="form-group">
    						<label for="email">Email :</label>
    						<input type="email" name="email" id="email" placeholder="amine@exemple.com" class="form-control">
    					</div>

    					<div class="form-group">
    						<label for="subject">Subject :</label>
    						<input type="text" name="subject" id="subject" placeholder="Try to describe simply the subject of your email" class="form-control">
    					</div>

    					<div class="form-group">
    						<label for="message">Message :</label>
    						<textarea name="message" id="message" class="form-control">
    						</textarea> 
    					</div>
    					<hr>
    					<div>
    						<button type="submit" class="btn btn-success" >Send Mail</button>
    					</div>
    				</form>
    		    </p>
    		</div>
    	</div>
@endsection

@section('title','|Contact')
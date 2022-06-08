@extends('main')
@section('content')
    	<div class="row">
    		<div class="col-md-12">
    			<h1>Contact Me</h1>
    			<hr>
    			<p> 
    				<form method="POST" action="">
    					<div class="form-group">
    						<label name="email">Email :</label>
    						<input type="email" name="email" id="email" placeholder="amine@exemple.com" class="form-control">
    					</div>

    					<div class="form-group">
    						<label name="content">Subject :</label>
    						<input type="text" name="content" id="content" placeholder="login error for example" class="form-control">
    					</div>

    					<div class="form-group">
    						<label name="message">Message :</label>
    						<textarea name="message" id="message" class="form-control">feel free to describe in detail any problem that you may encounter while navigating in our Blog
    						</textarea> 
    					</div>
    					<hr>
    					<div>
    						<input type="submit" class="btn btn-success" name="send Message">
    					</div>
    				</form>
    		    </p>
    		</div>
    	</div>
@endsection

@section('title','|Contact')
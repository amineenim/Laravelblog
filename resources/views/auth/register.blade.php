@extends('main')
@section('title','| Register')
@section('content')
<div class="row d-flex justify-content-center">
	<p class="lead"> Welcome to our community Join Us :</p>
	<div class="col-md-6 ">
		<form method="post"  action="{{route('register')}}">
			@csrf
			<label for="name" class="form-label">Name :</label>
			<input type="text" name="name" id="name" class="form-control">
			<label for="email" class="form-label">Email Adress :</label>
			<input type="email" name="email" id="email" class="form-control" placeholder="amine@gmail.com">
			<label class="form-label" for="password">Password :</label>
			<input type="password" name="password" id="password" class="form-control">
			<label class="form-label" for="password-confirmation">Confirm Password :</label>
			<input type="password" name="confirm-password" id="password-confirmation" class="form-control">
			<hr>
			<div class="d-grid col-6 mx-auto">
			<button type="submit" class="btn btn-outline-success btn-lg"> Register </button>
		    </div>
		</form>
	</div>
</div>
@endsection
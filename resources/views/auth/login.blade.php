@extends('main')
@section('title','| Logging in')
@section('content')
<div class="row d-flex justify-content-center">
	<div class="col-md-8">
		@if($errors->any())
		@foreach($errors as $error)
		<div class="col-md-4">
			{{ $message }}
		</div>
		@endforeach
		@endif
		<form method="post" action="{{ route('authenticate')}}">
			@csrf
			<div class="mb-3">
				<label for="email" class="form-label">Email Adress :</label>
				<input type="email" name="email" id="email" class="form-control" placeholder="amine@gmail.com">
			</div>
			<div class="mb-3">
				<label for="motdepasse" class="form-label"> Password :</label>
				<input id="motdepasse" name="password" class="form-control" type="password">
			</div>
			<div class="form-check">
                 <input class="form-check-input" type="checkbox" value="" id="check">
                 <label class="form-check-label" for="check">
                 Remember Me
                 </label>
            </div>
			<button type="submit" class="btn btn-secondary btn-block"> Login </button>
			<a href="{{route('password.request')}}"> Fogot Your Password </a>
		</form>
	</div>
</div>


@endsection
@extends('main')

@section('title','| Reset Your Password')

@section('content')

<div class="row d-flex justify-content-center">
	<div class="col-md-6 ">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Reset Password</strong></div>
			<div class="panel-body">
				<form method="post" action="{{ route('password.update')}}">
					@csrf
					<input type="hidden" name="token" value="{{ $token }}">
					<label for="email" class="form-label">Email Address :</label>
					<input type="email" name="email" id="email" class="form-control">
					<label for="password" class="form-label">Type Your New Password :</label>
					<input type="password" name="password" id="password" class="form-control">
					<label for="password_confirmation"> Confirm Your Password :</label>
					<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
					<hr>
					<button type="submit" class="btn btn-primary">Save new Password</button>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection
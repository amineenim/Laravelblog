@extends('main')

@section('title','| Forgot my Password')

@section('content')

<div class="row d-flex justify-content-center">
	<div class="col-md-6 ">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Reset Password</strong></div>
			<div class="panel-body">
				<form method="post" action="{{ route('password.email') }}">
					@csrf
					<label for="email" class="form-label">Email Address :</label>
					<input type="email" name="email" id="email" class="form-control">
					<hr>
					<button type="submit" class="btn btn-primary">Send Password Reset Verification Link</button>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection
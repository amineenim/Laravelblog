@extends('main')
@section('title','| Confirm Your Email')
@section('content')
<div class="row">
	<div class="col-md-8">
		<strong>Notice :</strong>
		<p class="lead">
			a link has been sent to your email, check it to confirm your email adress! 
		</p>
		<form method="post" action="{{ route('verification.send') }}">
			<button type="submit" class="btn btn-secondary">
				Get a new email verification Link
			</button>
		</form>
	</div>
</div>

@endsection
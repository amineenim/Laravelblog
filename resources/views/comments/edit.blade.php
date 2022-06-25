@extends('main')
@section('title','| Edit Comment')
@section('content')
<div class="row d-flex justify-content-center">
	<h2>Edit Comment</h2>
	<div class="col-md-8">
		<form method="post" action="{{ route('comments.update',$comment->id) }}">
			@csrf
			@method('PUT')
			<label for="name">Name:</label>
			<input type="text" name="name" id="name" class="form-control" disabled="disabled" value="{{$comment->name}}">
			<label for="email">Email Adress:</label>
			<input type="email" name="email" id="email" class="form-control" disabled="disabled" value="{{$comment->email}}">
			<label for="comment">Edit your Comment Here :</label>
			<textarea id="comment" name="comment" class="form-control" rows="5">{{ $comment->comment}}</textarea>
			<button type="submit" class="btn btn-success" style="margin-top: 15px;">Save Modifications</button>
		</form>
	</div>
</div>
@endsection
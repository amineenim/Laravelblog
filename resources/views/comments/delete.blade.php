@extends('main')
@section('title','| Delete Commment')
@section('content')
<div class="row d-flex justify-content-center">
	<div class="col-md-9">
		<h4>Are you sure you wanna remove this Comment ?</h4>
		<p>{{$comment->comment}}</p>
		<form method="post" action="{{route('comments.destroy',$comment->id)}}">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">Delete</button>
			<a href="{{route('posts.show',$post->slug)}}"  class="btn btn-primary">Cancel</a>
		</form>
	</div>
</div>
@endsection
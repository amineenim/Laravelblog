@extends('main')
@section('title','| Blog')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Blog</h1>
	</div>
	@foreach($posts as $post)
	<div class="row justify-content-center">
		<div class="col-md-8 col-md-offset-2 ">
			<h3>{{ $post->title}}</h3>
			<h5> Published :{{ date('M j,Y',strtotime($post->created_at))}} </h5>
			<hr>
			<p class="lead">
				{{ substr($post->body,0,250)}} {{strlen($post->body) > 200 ? "...": ""}}
			</p>
			<a href="{{ route('blog.single',['slug' => $post->slug]) }}" class="btn btn-success">Read More</a>
		</div>
	</div>
	@endforeach
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>
</div>


@endsection
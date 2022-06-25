@extends('main')
@section('title',"| $tag->name Tag")
@section('content')

<div class="row d-flex">
	<div class="col-md-8 justify-content-center">
		<h1> {{ $tag->name }} Tag</h1><h3>{{ $tag->posts()->count() }} Posts related to this Tag :</h3>
	</div>
	<div class="col-md-4">
		<div class="col-md-2">
		<a href="{{ route('tags.edit',$tag->id)}}" class="btn btn-primary btn-md pull-right" style="margin-top: 20px">Edit</a>
	</div>
	<div class="col-md-2">
	<form method="post" action="{{ route('tags.destroy',$tag->id) }}">
		@csrf
		@method('DELETE')
		<button class="btn btn-danger btn-sm" type="submit" style="margin-top: 5px">Delete</button>
	</form>
    </div>	
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($tag->posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>
						@foreach($post->tags as $tag)
						<span class="label label-default"> {{$tag->name}}</span>
						@endforeach
					</td>
					<td><a href="{{ route('posts.show',$post->slug)}}" class="btn btn-success btn-sm">View</a></td>
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div>
</div>
@endsection
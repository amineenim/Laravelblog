@extends('main')
@section('title','| Create New Post')




@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 col-md-offset-2">
		<h1>Create New Post :</h1>
		<hr>
		<form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="title">Title :</label>
				<input type="text" name="title" id="title" class="form-control">
			</div>
			<div class="form-group">
				<label for="body">Post :</label>
				<textarea class="form-control" id="body" name="body" rows="5"></textarea>
			</div>
			<br>
			<div class="form-group">
				<label for="category_id">Category :</label>
				<select id="category_id" class="form-select form-select-lg" name="category_id">
					@foreach($categories as $category)
					<option value="{{ $category->id}}">{{ $category->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group ">
				<label for="tag_id">Tag :</label>
				<select id="tag_id" class="form-select form-select-lg mb-3" name="tags[]" multiple data-mdb-clear-button="true">
					@foreach($tags as $tag)
					<option value="{{ $tag->id}}">{{ $tag->name}}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-success btn-lg" style="margin-top: 20px;">Create Post
			</button>
		</form>
	</div>
</div>

@endsection
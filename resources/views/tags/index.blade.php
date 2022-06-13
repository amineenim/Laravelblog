@extends('main')
@section('title','| All Tags')
@section('content')
<div class="row d-flex ">
	<div class="col-md-8">
		<h2>Tags</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Tag Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tags as $tag)
				<tr>
					<th>{{ $tag->id }}</th>
					<td>{{ $tag->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<div class="well ">
			<form method="post" action="{{ route('tags.store') }}">
				@csrf
				<h3>Add a new Tag</h3>
				<div class="form-group d-flex flex-column align-items-center">
					<label for="name" class="form-label">Tag Name :</label>
					<input type="text" name="name" id="name" class="form-control">
					<br>
					<button type="submit" class="btn btn-primary"> Create New Tag</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
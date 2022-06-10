@extends('main')
@section('title','| All Categories')
@section('content')
<div class="row d-flex align-items-center">
	<div class="col-md-8">
		<h2>Categories</h2>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Category Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<th>{{ $category->id }}</th>
					<td>{{ $category->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<div class="well ">
			<form method="post" action="{{ route('categories.store') }}">
				@csrf
				<h3>Add a new Category</h3>
				<div class="form-group d-flex flex-column align-items-center">
					<label for="name" class="form-label">Category Name :</label>
					<input type="text" name="name" id="name" class="form-control">
					<br>
					<button type="submit" class="btn btn-primary"> Create New Category</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
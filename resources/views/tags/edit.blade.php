@extends('main')
@section('title','| Edit Tag')
@section('content')
<div class="row d-flex justify-content-center">
	<div class="col-md-8">
		<form method="post" action="{{route('tags.update',$tag->id)}}">
	       @csrf
	       @method('PUT')
	       <div class="form-group">
		      <label for="name">Set your tag new name :</label>
		      <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}">
	      </div>
	      <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px"> Save changes </button>
        </form>
    </div>
</div>
@endsection
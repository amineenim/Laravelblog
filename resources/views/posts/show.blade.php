@extends('main')
@section('title','| View Post')
@section('content')
<div class="row">
    <div class="col-md-8">
          	<h1>{{ $post->title }}</h1>
            <p class="lead">
            	{{ $post->body }}
            </p>
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
          	    <dt>Created At :</dt>
          		<dd> {{ date('M j, Y H:i',strtotime($post->created_at)) }} </dd>
            </dl>
          	<dl class="dl-horizontal">
          		<dt>Last Updated At :</dt>
          		<dd> {{ date('M j, Y H:i',strtotime($post->updated_at)) }} </dd>
          	</dl>
          	<hr>
          	<div class="row">
          		<div class="col-sm-6">
          			<a href="{{route('posts.edit',['post'=> $post->slug])}}" class="btn btn-primary btn-block">Edit</a>
          		</div>
          		<div class="col-sm-6">
                <form action="{{ route('posts.destroy',['post'=> $post->id] ) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
          		</div>		
          	</div>
            <hr>
            <div class="row">
              <a href="/" class="btn btn-default btn-block">return to Posts</a>
            </div>
         </div>
    </div>
</div>
</div>
@endsection
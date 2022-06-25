@extends('main')
@section('title','| View Post')
@section('content')
<div class="row">
    <div class="col-md-8 d-flex flex-column">
          	<h1>{{ $post->title }}</h1>
            <p class="lead">
            	{{ $post->body }}
            </p>
            <div class="tags d-flex flex-row justify-content-evenly"> 
              @foreach($post->tags as $tag)
                <div class="label label-default"> {{ $tag->name }} </div>
              @endforeach
            </div>
            <div class="backend-comments" style="margin-top: 30px;">
              <h3>{{ ($post->comments()->count() >=4) ? 'Latest 4 comments related to the post :' : 'Comments :'}}</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Posted At</th>
                    <th>Comment</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($comments as $comment)
                  <tr>
                    <td>{{ $comment->name }}</td>
                    <td>{{ date('M j, Y H:i',strtotime($comment->created_at)) }}</td>
                    <td>{{ $comment->comment }}</td>
                    <td>
                      @can('update',$comment)
                      <a href="{{ route('comments.edit',$comment->id)}}" class="btn btn-primary button-edit">Edit</a>
                      @endcan
                      @can('delete',$comment)
                      <a href="{{ route('comments.delete',$comment->id)}}" class="btn btn-danger">Delete</a>
                      @endcan
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
            <dl class="dl-horizontal">
                <dt>Category :</dt>
              <dd> {{ $post->category->name }} </dd>
            </dl>
            @can('update',$post)
            <hr>
          	<div class="row">
          		<div class="col-sm-6">
          			<a href="{{route('posts.edit',['post'=> $post->slug])}}" class="btn btn-primary btn-block">Edit</a>
          		</div>
            @endcan
            @can('delete',$post)
          		<div class="col-sm-6">
                <form action="{{ route('posts.destroy',['post'=> $post->id] ) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
          		</div>
            @endcan		
          	</div>
            <hr>
            <div class="row">
              <a href="/" class="btn btn-default btn-block">return to Posts</a>
            </div>
         </div>
    </div>
</div>
@endsection
@extends('main')

@section('title',"| $post->title ")

@section('content')
<div class="row d-flex justify-content-center">
	<div class="col-md-8 ">
		<h1>{{ $post->title}}</h1>
		<p>
			{{ $post->body}}
		</p>
		<p class="lead">
			Posted In: {{ $post->category->name }}
		</p>
	</div>
	<div class="row d-flex-column justify-content-center">
        <div class="col-md-8">
            <h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span>{{ $post->comments()->count()}} Comments :</h3>
            @foreach($post->comments as $comment)
                <div class="comment">
                   <div class="author-info">
                      <img src="{{'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))).'?s=50&d=wavatar'}}" class="author-image">
                      <div class="author-name"> 
                        <h5>{{$comment->name}}</h5>
                        <div class="author-time">{{date('F nS, Y -G:i',strtotime($comment->created_at))}}</div>
                      </div>
                   </div>
                   <div class="comment-content">
                       {{$comment->comment}}
                   </div>
                </div>
            @endforeach
        </div>
        @if(Auth::check())
        <div class="row d-flex justify-content-center" style="margin-top: 10px">
               <div class="col-md-8 d-flex ">
                <h6 class="align-self-start comment-form"> you may add a comment Here:</h6>
                <form method="post" action="{{ route('comments.store',$post->slug)}}" class="col-md-8">
                  @csrf
                  <textarea name="comment" id="comment" class="form-control" rows="3" ></textarea>
                  <button type="submit" class="btn btn-success" id="comment-button">Add Comment</button>
                </form>
               </div>
          </div>
        @endif
    </div>
@endsection
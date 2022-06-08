@extends('main')
@section('content')
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Welcome to my Blog</h1>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p class="lead">Thank you so much for visiting, this is my test website fully built with Laravel</p>
            <p>
              <a href="" class="btn btn-primary btn-lg">Learn More</a>
            </p>
          </div>
        </div>
      </div><!--end of row-->
      <div class="row">
        <div class="col-md-8">
          @foreach($posts as $post)
          <div class="post">
            <h3>{{$post->title}}</h3>
            <p>
             {{ substr($post->body,0,200) }}
             {{ strlen($post->body) > 100 ? "..." : "" }}
            </p>
            <a href="{{route('blog.single',['slug' => $post->slug])}}" class="btn btn-success">Read More</a>
          </div>
          <hr>
          @endforeach
        </div>
        <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        </div>
      </div>
@endsection

@section('title','|HomePage')


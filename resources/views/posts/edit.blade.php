@extends ('main')
@section('title','|Edit Post')
@section('content')
<div class="row">
	<div class="col-md-8">
		<form method="POST" action="{{ route('posts.update',$post->slug) }}">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="title"><strong>Set Your New title :</strong></label>
				<input type="text" name="title" id="title" class="form-control " value="{{$post->title }}" placeholder=".form-control-lg">
			</div>
			<div class="form-group">
				<label for="body"><strong>Set Your New Post :</strong></label>
				<textarea class="form-control" id="body" name="body" rows="5">{{$post->body}}
				</textarea>
			</div>
      <hr>
      <div class=" d-flex justify-content-center">
        <div class="col-4">
          <button type="submit" class="btn btn-success">
				        Save Changes
			    </button>
        </div>
        <div class="col-4">
          <button class="btn btn-danger">
				     <a href="{{ route('posts.show',$post->slug) }}"> Cancel </a>
			    </button>
        </div>	
      </div>	
		</form>

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
         </div>
    </div>
</div>
@endsection
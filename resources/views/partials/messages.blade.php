@if(session()->has('message'))
<div class="alert alert-success" role="alert">
	<strong>Success :</strong>{{ session()->get('message')}}
</div>
@endif


@if($errors->any())
<div class="alert alert-danger" role ="alert">
	<strong>Erros :</strong>
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
	<strong>Success :</strong>{{ session()->get('success')}}
</div>
@endif

@if(session()->has('deleted'))
<div class="alert alert-success" role="alert">
	<strong>Success :</strong>{{ session()->get('deleted')}}
</div>
@endif

@if(session()->has('authsucces'))
<div class="alert alert-success" role="alert">
	<strong>Success :</strong>{{ session()->get('authsucces')}}
</div>
@endif

@if(session()->has('register'))
<div class="alert alert-success" role="alert">
	<strong>Success :</strong>{{ session()->get('register')}}
</div>
@endif

@if(session()->has('status'))
<div class="alert alert-success" role="alert">
	<strong>Message:</strong>{{ session()->get('status')}}
</div>
@endif

@if(session()->has('sent'))
<div class="alert alert-success" role="alert">
	<strong>Message:</strong>{{ session()->get('sent')}}
</div>
@endif

@if(session()->has('verified'))
<div class="alert alert-success" role="alert">
	<strong>Message:</strong>{{ session()->get('verified')}}
</div>
@endif
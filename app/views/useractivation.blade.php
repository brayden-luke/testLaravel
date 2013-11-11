<!doctype html>
<html lang="en">
<head>
	{{ HTML::script('js/jquery1.10.2.js') }}
	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::style('css/bootstrap.css') }}
	<meta charset="UTF-8">
	<title>Activation User</title>
</head>
<body>
<div class="row text-center ">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend> Please activate your account</legend>
			{{Form::open(array('url' => 'ckeckactivation/'.$id))}}
			@if(isset($message))
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
				<div>{{$message}}</div>
			</div>
			@endif
			{{Form::text('activation_code','',array('placeholder'=>'Past here activation code'))}}
			{{Form::submit('Activate',array('class'=>'btn btn-success'))}}
			{{HTML::link('users','Cancel',array('class'=>'btn btn-danger'))}}
			{{Form::close()}}
		</div>
	</div>
</div>

</body>
</html>
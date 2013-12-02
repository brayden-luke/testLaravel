<!doctype html>
<html lang="en">
<head>
    {{ HTML::script('js/jquery1.10.2.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    <meta charset="UTF-8">
    <title>Main page</title>
</head>
<body>
     <div class="row text-center ">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend> Main Page </legend>
			@if(isset($message))
			<div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
				<div>{{$message}}</div>
			</div>
			@endif
        {{HTML::link('register','Create',array('class'=>'btn btn-success'))}}
        {{HTML::link('alldata','All data',array('class'=>'btn btn-primary'))}}
        </div>
    </div>
     </div>     
</body>
</html>
<!doctype html>
<html lang="en">
<head>
     {{ HTML::script('js/jquery1.10.2.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    <meta charset="UTF-8">
    <title>Main Users page</title>    
</head>
<body>
  <div class="row">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend> Login</legend>
   {{Form::open(array('url' => 'postlogin'))}}
  
   @if(isset($message))
   <div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
   					<div>{{$message}}</div>
   </div>
   @endif
   @if($errors->any())
   <div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
				{{implode('', $errors->all('<div>:message</div>'))}}
			</div>   
   @endif
   {{Form::text('email','',array('placeholder'=>'email'))}}
   {{Form::password('password',array('placeholder'=>'password'))}}
   {{Form::submit('Login',array('class'=>'btn btn-success'))}}
   {{HTML::link('register','Register',array('class'=>'btn btn-primary'))}}
   {{Form::close()}}
                </div>
            </div>
      </div>
</body>
</html>


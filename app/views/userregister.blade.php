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
   <div class="row text-center ">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend> Please Register </legend>
   {{Form::open(array('url' => 'postregister'))}}
   @if($errors->any())
   <div class="alert alert-error">
		<a href="#" class="close" data-dismiss='alert'>&times</a>
                    {{implode('', $errors->all('<div>:message</div>'))}}
   </div>
   @endif
   {{Form::text('username','',array('placeholder'=>'username'))}}
   {{Form::text('email','',array('placeholder'=>'email'))}}
   {{Form::password('password',array('placeholder'=>'password'))}}
   {{Form::submit('Register',array('class'=>'btn btn-success'))}}
   {{HTML::link('users','Cancel',array('class'=>'btn btn-danger'))}}
   {{Form::close()}} 
   </div>
            </div>
       </div>
   
</body>
</html>


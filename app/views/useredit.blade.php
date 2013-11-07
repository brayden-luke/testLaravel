<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{ HTML::script('js/jquery1.10.2.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    <title>Edit User</title>    
</head>
<body>
   <div class="row">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend>Edit Profile Details</legend>
   {{Form::open(array('url' => 'postedit'))}}
   @if($errors->any())
    <div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
                                {{implode('', $errors->all('<div>:message</div>'))}}
    </div>
   @endif
   {{Form::text('username',Auth::user()->username,array('placeholder'=>'username'))}}
   {{Form::text('email',Auth::user()->email,array('placeholder'=>'email'))}}
   {{Form::password('password',array('placeholder'=>'new password'))}}
   {{Form::submit('Save',array('class'=>'btn btn-success'))}}
   {{HTML::link('users','Cancel',array('class'=>'btn btn-danger'))}}
   {{Form::close()}} 
                </div>
        </div>
   </div>
</body>
</html>

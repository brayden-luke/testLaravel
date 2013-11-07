<!doctype html>
<html lang="en">
<head>
    {{ HTML::script('js/jquery1.10.2.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    <meta charset="UTF-8">
    <title>User page</title>    
</head>
<body>
    <div class="row">
	<div class="span4 offset8 pagination-centered">
		<div class="well">
			<legend>Your profile</legend>
                        
            @if(Auth::user())
            <h4>Hello {{ucwords(Auth::user()->username)}}, Welcome to our site</h4>
            @if(isset($message))
            <div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
            {{$message}}
            </div>
            @endif
            {{HTML::link('users/'.Auth::user()->username.'/edit', 'Edit Account',array('class'=>'btn btn-success'))}} 
            {{HTML::link('logout','Logout',array('class'=>'btn btn-danger'))}}
            @endif
       
    </div>
        </div>
    </div>
</body>
</html>

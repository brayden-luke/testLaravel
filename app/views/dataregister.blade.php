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
			<legend> Create </legend>
   {{Form::open(array('url' => 'postregister'))}}
   @if($errors->any())
   <div class="alert alert-error">
		<a href="#" class="close" data-dismiss='alert'>&times</a>
                    {{implode('', $errors->all('<div>:message</div>'))}}
   </div>
   @endif
			{{Form::text('uid','',array('placeholder'=>'user id'))}}
			{{Form::text('nid','',array('placeholder'=>'Network id'))}}
			{{Form::text('network_name','',array('placeholder'=>'Network Name'))}}
			{{Form::text('ip_address','',array('placeholder'=>'IP address'))}}
			{{Form::text('nstatus','',array('placeholder'=>'Network Status'))}}
   {{Form::text('hostname','',array('placeholder'=>'Host Name'))}}
	{{Form::text('block','',array('placeholder'=>'Hostname Block'))}}
   {{Form::submit('Register',array('class'=>'btn btn-success'))}}

   {{HTML::link('/','Cancel',array('class'=>'btn btn-danger'))}}
   {{Form::close()}} 
   </div>
            </div>
       </div>
   
</body>
</html>


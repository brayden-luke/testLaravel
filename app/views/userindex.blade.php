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
			<legend> Users Page </legend>
        {{HTML::link('register','Register',array('class'=>'btn btn-success'))}}
        {{HTML::link('login','Login',array('class'=>'btn btn-primary'))}}    
        </div>
    </div>
     </div>     
</body>
</html>
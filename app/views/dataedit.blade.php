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

		<div class="well">
			<legend>Edit Profile Details</legend>
   {{Form::open(array('url' => 'postedit'))}}
   @if($errors->any())
    <div class="alert alert-error">
				<a href="#" class="close" data-dismiss='alert'>&times</a>
                                {{implode('', $errors->all('<div>:message</div>'))}}
    </div>
   @endif
   <div>id {{Form::text('id',$data['_id'],array('disabled'))}}</div>
   <div>Uid {{Form::text('uid',$data['uid'],array('placeholder'=>'Uid'))}}</div>
	<div>Network Id {{Form::text('nid',$data['nid'],array('placeholder'=>'Network Id'))}}</div>
	<div>Network Name   {{Form::text('network_name',$data['network_name'],array('placeholder'=>'Network Name'))}}</div>
	<div>Network IP Address   {{Form::text('ip_address',$data['ip_address'],array('placeholder'=>'Network IP Address'))}}</div>
	<div>Network Status   {{Form::text('nstatus',$data['nstatus'],array('placeholder'=>'Network Status'))}}</div>
	<div>Hostname   {{Form::text('hostname',$data['hostname'],array('placeholder'=>'Hostname'))}}</div>
	<div>Block   {{Form::text('block',$data['block'],array('placeholder'=>'Block'))}}</div>
	  {{Form::submit('Save',array('class'=>'btn btn-success'))}}
	   {{HTML::link('alldata','Cancel',array('class'=>'btn btn-danger'))}}
	   {{Form::close()}}

        </div>

</body>
</html>

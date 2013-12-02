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
	<div class="pagination-centered">
		<div class="well">
			<legend> All data </legend>
			<table class="table table-striped table-bordered table-condensed">
			<?php  if($alldata){ ?>
				<tr style="font-weight: bold">
					<td>id</td>
					<td>uid</td>
					<td>Network id</td>
					<td>Network Name</td>
					<td>IP address</td>
					<td>Network status</td>
					<td>Hostname</td>
					<td>Block</td>
					<td></td>

				</tr>
<?php //echo "<pre>";var_dump($alldata);die;
				foreach($alldata as $data){?>
<tr>
  <td>{{$data['attributes']['_id']}}</td>
  <td>{{$data['attributes']['uid']}}</td>
  <td>{{$data['attributes']['nid']}}</td>
  <td>{{$data['attributes']['network_name']}}</td>
  <td>{{$data['attributes']['ip_address']}}</td>
  <td>{{$data['attributes']['nstatus']}}</td>
  <td>{{$data['attributes']['hostname']}}</td>
  <td>{{$data['attributes']['block']}}</td>
  <td>{{HTML::link('editdata/'.$data['attributes']['_id'],'Update')}}<br>{{HTML::link('delete/'.$data['attributes']['_id'],'Delete')}}</td>
</tr>
			<?php }
}; ?>
</table>
			{{HTML::link('/','Back',array('class'=>'btn btn-success'))}}
		</div>
	</div>
</body>
</html>
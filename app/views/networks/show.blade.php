@extends('layouts.scaffold')

@section('main')

<h1>Show Network</h1>

<p>{{ link_to_route('objects.networks.index', 'Return to all networks', array($objectId)) }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nid</th>
            <th>N_name</th>
            <th>N_ip</th>
            <th>N_status</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $network['nid'] }}}</td>
            <td>{{{ $network['n_name'] }}}</td>
            <td>{{{ $network['n_ip'] }}}</td>
            <td>{{{ $network['n_status'] or 0 }}}</td>
            <td>{{ link_to_route('objects.networks.edit', 'Edit', array($objectId, $id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('objects.networks.destroy', $objectId, $id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
		</tr>
	</tbody>
</table>

@stop

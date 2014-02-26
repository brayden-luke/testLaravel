@extends('layouts.scaffold')

@section('main')

<h1>Show Hostname</h1>

<p>{{ link_to_route('objects.hostnames.index', 'Return to all hostnames', array($objectId)) }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Hostname</th>
            <th>Block</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $hostname['hostname'] }}}</td>
            <td>{{{ $hostname['block'] or 0 }}}</td>
            <td>{{ link_to_route('objects.hostnames.edit', 'Edit', array($objectId, $id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('objects.hostnames.destroy', $objectId, $id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
		</tr>
	</tbody>
</table>

@stop

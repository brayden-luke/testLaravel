@extends('layouts.scaffold')

@section('main')

<h1>Show Object</h1>

<p>{{ link_to_route('objects.index', 'Return to all objects') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Uid</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $object->uid }}}</td>
            <td>{{ link_to_route('objects.json', 'JSON', array($object->id), array('class' => 'btn btn-success')) }}</td>
            <td>{{ link_to_route('objects.networks.index', 'Networks', array($object->id), array('class' => 'btn btn-info')) }}</td>
            <td>{{ link_to_route('objects.hostnames.index', 'Hostnames', array($object->id), array('class' => 'btn btn-info')) }}</td>
            <td>{{ link_to_route('objects.edit', 'Edit', array($object->id), array('class' => 'btn btn-warning')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('objects.destroy', $object->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
		</tr>
	</tbody>
</table>

@stop

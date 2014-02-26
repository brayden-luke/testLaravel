@extends('layouts.scaffold')

@section('main')

<h1>All Objects</h1>

<p>{{ link_to_route('objects.create', 'Add new object') }}</p>

@if ($objects->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>UID</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($objects as $object)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no objects
@endif

@stop

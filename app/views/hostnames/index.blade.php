@extends('layouts.scaffold')

@section('main')

<h1>All Hostnames</h1>

<p>
    {{ link_to_route('objects.hostnames.create', 'Add new hostname', $objectId) }}
    {{ link_to_route('objects.show', 'Show this object', array($objectId)) }}
</p>

@if ($hostnames)
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Hostname</th>
				<th>Block</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($hostnames as $key => $hostname)
				<tr>
					<td>{{{ $hostname['hostname'] }}}</td>
					<td>{{{ $hostname['block'] }}}</td>
                    <td>{{ link_to_route('objects.hostnames.edit', 'Edit', array($objectId, $key), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('objects.hostnames.destroy', $objectId, $key))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no hostnames
@endif

@stop

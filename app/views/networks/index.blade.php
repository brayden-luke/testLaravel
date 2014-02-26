@extends('layouts.scaffold')

@section('main')

<h1>All Networks</h1>

<p>
    {{ link_to_route('objects.networks.create', 'Add new network', array($objectId)) }}
    {{ link_to_route('objects.show', 'Show this object', array($objectId)) }}
</p>

@if ($networks)
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
			@foreach ($networks as $key => $network)
				<tr>
					<td>{{{ $network['nid'] }}}</td>
					<td>{{{ $network['n_name'] }}}</td>
					<td>{{{ $network['n_ip'] }}}</td>
					<td>{{{ $network['n_status'] or 0 }}}</td>
                    <td>{{ link_to_route('objects.networks.edit', 'Edit', array($objectId, $key), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('objects.networks.destroy', $objectId, $key))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no networks
@endif

@stop

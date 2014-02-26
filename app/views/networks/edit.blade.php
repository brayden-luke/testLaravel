@extends('layouts.scaffold')

@section('main')

<h1>Edit Network</h1>
{{ Form::model($network, array('method' => 'PATCH', 'route' => array('objects.networks.update', $objectId, $id))) }}
	<ul>
        <li>
            {{ Form::label('nid', 'Nid:') }}
            {{ Form::input('number', 'nid') }}
        </li>

        <li>
            {{ Form::label('n_name', 'N_name:') }}
            {{ Form::text('n_name') }}
        </li>

        <li>
            {{ Form::label('n_ip', 'N_ip:') }}
            {{ Form::text('n_ip') }}
        </li>

        <li>
            {{ Form::label('n_status', 'N_status:') }}
            {{ Form::checkbox('n_status') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('objects.networks.show', 'Cancel', array($objectId, $id), array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

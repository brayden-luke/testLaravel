@extends('layouts.scaffold')

@section('main')

<h1>Create Network</h1>

<p>{{ link_to_route('objects.networks.index', 'Return to all networks', array($objectId)) }}</p>

{{ Form::open(array('route' => array('objects.networks.store', $objectId))) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop



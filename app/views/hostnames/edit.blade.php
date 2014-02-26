@extends('layouts.scaffold')

@section('main')

<h1>Edit Hostname</h1>
{{ Form::model($hostname, array('method' => 'PATCH', 'route' => array('objects.hostnames.update', $objectId, $id))) }}
	<ul>
        <li>
            {{ Form::label('hostname', 'Hostname:') }}
            {{ Form::text('hostname') }}
        </li>

        <li>
            {{ Form::label('block', 'Block:') }}
            {{ Form::checkbox('block') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('objects.hostnames.show', 'Cancel', array($objectId, $id), array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

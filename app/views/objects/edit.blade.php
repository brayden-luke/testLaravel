@extends('layouts.scaffold')

@section('main')

<h1>Edit Object</h1>
{{ Form::model($object, array('method' => 'PATCH', 'route' => array('objects.update', $object->id))) }}
	<ul>
        <li>
            {{ Form::label('uid', 'Uid:') }}
            {{ Form::input('number', 'uid') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('objects.show', 'Cancel', $object->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

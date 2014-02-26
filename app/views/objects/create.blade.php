@extends('layouts.scaffold')

@section('main')

<h1>Create Object</h1>

{{ Form::open(array('route' => 'objects.store')) }}
	<ul>
        <li>
            {{ Form::label('uid', 'Uid:') }}
            {{ Form::input('number', 'uid') }}
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



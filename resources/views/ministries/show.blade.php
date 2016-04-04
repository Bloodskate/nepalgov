@extends('layouts.app')

@section('title', $ministry->title)

@section('content')

	 {!! Form::open([
		'method' => 'delete',
		'route' => ['ministries.destroy', $ministry->id]
	]) !!}
		<div class="panel panel-default">
				<div class="panel-heading"> 
					{{ $ministry->id }} 
				</div>
				<div class="panel-body">
					<h3> <i> {{ $ministry->title }} </i> </h3>
				</div>
		</div>
		<a class="btn btn-primary" href="{{ route('ministries.index') }}">
			Back
		</a>
		<a class="btn btn-primary" href="{{ route('ministries.edit', $ministry->id) }}">
			Edit
		</a>
		{!! Form::submit('Delete',['class' => 'btn btn-primary']) !!}
		
	 	{!! Form::close() !!}
@endsection
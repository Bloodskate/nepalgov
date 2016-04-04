@extends('layouts.app')


@section('title', $ministry->title . 'Ministries')

@section('content')
		<div class="panel panel-default">
			@foreach($ministry->subMinistries as $ministry)
				<div class="panel-heading"> 
					<a href="{{ url('/ministries/'.$ministry->id) }}">	{{ $ministry->id }} </a>
				</div>
				<div class="panel-body">
					<h3> <i> {{ $ministry->title }} </i> </h3>
				</div>
			@endforeach
		</div>
		<a class="btn btn-primary" href="{{ route('ministries.firstForm') }}">
			Create New
		</a>
@endsection
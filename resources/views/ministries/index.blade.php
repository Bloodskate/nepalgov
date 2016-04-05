@extends('layouts.app')


@section('title', 'Ministries')

@section('content')
	{{session()->get('parent_id')}}
		<div class="panel panel-default">
			@foreach($ministries as $ministry)
				@include('partials._list')
			@endforeach
		</div>
		<a class="btn btn-primary" href="{{ route('ministries.firstForm') }}">
			Create New
		</a>
@endsection
@extends('layouts.app')

@section('title', $ministry->title)

@section('content')

<h2> {{ $ministry->title }} </h2>

<h4>Children</h4>
<div class="panel panel-default">
	@foreach($ministry->subMinistries as $ministry)
		@include('partials._list')
	@endforeach
</div>
<a class="btn btn-primary" href="{{ route('ministries.firstForm') }}">
	Create New
</a>
@endsection
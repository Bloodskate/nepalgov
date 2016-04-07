@extends('layouts.app')

@section('title', $ministry->title)

@section('content')

<h2> {{ $ministry->title }} </h2>
<h4>Children</h4>
{!!$id = $ministry->id!!}
{!!session()->put('parent_id', $ministry->id)!!}
<div class="panel panel-default">
	@foreach($ministry->subMinistries as $ministry)
		@include('partials._list')
	@endforeach
</div>

<a class="btn btn-primary" href="{{ route('ministries.newCategory', $id) }}">
	Create New
</a>
@endsection
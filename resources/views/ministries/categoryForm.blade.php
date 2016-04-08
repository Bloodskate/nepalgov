@extends('layouts.app')

@section('title', 'New Category')

@section('content')
	 	{!! Form::open([
	 		'route' => 'ministries.categoryFormPost'
	 	]) !!}
	 		{!! Form::label('title', 'Title') !!}
			{!! Form::text('title') !!}
		<br>
			{!! Form::label('image', 'Image') !!}  
			{!! Form::text('image_link') !!} <b><i>Upload garne system rakhne</i></b>
		<br>
			
			@if( ! empty($parent_id))
				{!! Form::hidden('parent_id', $parent_id) !!}    			
			@endif
		<br>
			{!! Form::submit('Next',['class' => 'btn btn-primary']) !!}
			
		
	 	{!! Form::close() !!}
@endsection
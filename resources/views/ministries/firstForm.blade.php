@extends('layouts.app')

@section('title', 'New Ministry')

@section('content')
	 	{!! Form::open() !!}
			
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title') !!}
		<br>
			{!! Form::label('image', 'Image') !!}  
			{!! Form::text('image_link') !!} <b><i>Upload garne system rakhne</i></b>
		<br>
			{!! Form::select('option', array(
				'ministry' => 'Ministry', 
				'category' => 'Category'
			)); !!}
		<br>
			{!! Form::submit('Next',['class' => 'btn btn-primary']) !!}
			
		
	 	{!! Form::close() !!}
@endsection
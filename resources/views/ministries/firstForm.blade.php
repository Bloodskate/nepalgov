@extends('layouts.app')

@section('title', 'New Ministry')

@section('content')
	 	{!! Form::open() !!}
			
			
			{!! Form::select('option', array(
				'ministry' => 'Ministry', 
				'category' => 'Category'
			)); !!} 
			@if( ! empty($parent_id))
				{!! Form::hidden('parent_id', $parent_id) !!}    			
			@endif
		<br>
			{!! Form::submit('Next',['class' => 'btn btn-primary']) !!}
			
		
	 	{!! Form::close() !!}
@endsection
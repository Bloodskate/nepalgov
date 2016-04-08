@extends('layouts.app')

@section('title', 'New Ministry')

@section('content')
	 	{!! Form::open([
	 		'route' => 'ministries.ministryFormPost'
	 	]) !!}
	 		{!! Form::label('title', 'Title') !!}
			{!! Form::text('title') !!}
		<br>
			{!! Form::label('image', 'Image') !!}  
			{!! Form::text('image_link') !!} <b><i>Upload garne system rakhne</i></b>
		<br>
				Social Media Baki Xa <br>
			{!! Form::label('detail', 'Detail') !!}  
			{!! Form::textarea('detail') !!}
		<br>
			{!! Form::label('phone', 'Phone Number') !!}  
			{!! Form::number('phone') !!}
		<br>
			{!! Form::label('function', 'Function') !!}  
			{!! Form::textarea('function') !!}
		<br>
			{!! Form::label('nbp', 'Nagarik Bada Patra') !!}  
			{!! Form::textarea('nagarik_badapatra') !!}
		<br>
			{!! Form::label('website', 'Website') !!}  
			{!! Form::textarea('website') !!}
			
			@if( ! empty($parent_id))
				{!! Form::hidden('parent_id', $parent_id) !!}    			
			@endif
		<br>
			{!! Form::submit('Next',['class' => 'btn btn-primary']) !!}
			
		
	 	{!! Form::close() !!}
@endsection
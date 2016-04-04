@extends('layouts.app')

@section('title', 'New Ministry')

@section('content')
	 	{!! Form::open() !!}
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
		<br>
			{!! Form::submit('Next',['class' => 'btn btn-primary']) !!}
			
		
	 	{!! Form::close() !!}
@endsection
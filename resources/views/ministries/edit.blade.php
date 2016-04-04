@extends('layouts.app')

@section('title', $ministry->title)

@section('content')
	 	{!! Form::model($ministry, [
	 		'method' => 'patch',
	 		'route' => ['ministries.update', $ministry->id]
	 	]) !!}
			
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title') !!}
		<br>
			{!! Form::label('image', 'Image') !!}  
			{!! Form::text('image_link') !!} <b><i>Upload garne system rakhne</i></b>
		<br>
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
			
			{!! Form::submit('Edit',['class' => 'btn btn-primary']) !!}
		
	 	{!! Form::close() !!}
@endsection
@extends('layouts.app')

@section('content')
	<div id="app">
		<step :form="{{ $form }}" :step="{{ $step }}"/>
	</div>
@endsection

@extends('layouts.dashboard')
@section('title', 'Subit imagen')
@section('content')
	<div class="mt-3">
		<form action="{{route('firestore')}}" enctype="multipart/form-data" method="POST">
			@csrf
			<div class="mb-3">
				<label for="file" class="form-label">Archivo</label>
				<input type="file" name="file" id="file" class="form-control">
			</div>
			<button type="submit" class="btn btn-secondary">Enviar</button>
		</form>
	</div>
@endsection
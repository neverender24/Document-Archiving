@extends('layouts.app')

@section('content')
<h2 style="color:white">Add Office</h2>
	<form action="{{ route('office.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group col-md-5">
			<label>Description
				<input type="text" name="description" class="form-control">
			</label>
		</div>
		<div class="form-group col-md-5">
		<label>Prefix
			<input type="text" name="prefix" class="form-control">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection
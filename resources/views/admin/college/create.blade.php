@extends('layouts.app')

@section('content')
<h2 style="color:white">Add Colleges</h2>
	<form action="{{ route('college.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group col-md-5">
			<label style="color:white">Description
				<input type="text" name="description" class="form-control">
			</label>
		</div>
		<div class="form-group col-md-5">
		<label style="color:white">Prefix
			<input type="text" name="prefix" class="form-control">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection
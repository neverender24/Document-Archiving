@extends('layouts.app')

@section('content')
<h2 style="color:white">Add Office</h2>
	<form action="{{ route('office.update', $edit->id) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('patch') }}
		<div class="form-group col-md-5">
			<label>Description
				<input type="text" name="description" class="form-control" value="{{ old('description', $edit->description) }}">
			</label>
		</div>
		<div class="form-group col-md-5">
		<label>Prefix
			<input type="text" name="prefix" class="form-control" value="{{ old('prefix', $edit->prefix) }}">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="update">
		</div>
	</form>

@endsection
@extends('layouts.app')

@section('content')
<h2>Add Colleges</h2>
	<form action="{{ route('department.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group col-md-12">
			<label>College
				<select name="college_id" id="" class="form-control">
					<option value=""></option>
					@foreach($colleges as $id => $description)
						<option value="{{ $id }}">{{ $description }}</option>
					@endforeach
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label>Description
				<input type="text" name="description" class="form-control">
			</label>
		</div>
		<div class="form-group col-md-12">
		<label>Prefix
			<input type="text" name="prefix" class="form-control">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection
@extends('layouts.app')

@section('content')
<h2>Add Drawer</h2>
	<form action="{{ route('drawer.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group col-md-12">
			<label>Category
				<select name="category_id" id="" class="form-control">
					<option value=""></option>
					@foreach($categories as $id => $description)
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
		<div class="form-group col-md-12">
		<label>Subject
			<input type="text" name="subject" class="form-control">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection
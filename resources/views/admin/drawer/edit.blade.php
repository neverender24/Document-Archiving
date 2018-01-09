@extends('layouts.app')

@section('content')
<h2>Add Colleges</h2>
	<form action="{{ route('drawer.update', $edit->id) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('patch') }}
		<div class="form-group col-md-12">
			<label>College
				<select name="category_id" id="" class="form-control">
					<option value=""></option>
					@foreach($categories as $id => $description)
						<option value="{{ $id }}"
						@if($id == $edit->category_id)
							selected
						@endif
						>{{ $description }}</option>
					@endforeach
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label>Description
				<input type="text" name="description" class="form-input" value="{{ old('description', $edit->description) }}">
			</label>
		</div>
		<div class="form-group col-md-12">
		<label>Prefix
			<input type="text" name="prefix" class="form-input" value="{{ old('prefix', $edit->prefix) }}">
		</label>
		</div>
		<div class="form-group col-md-12">
			<input type="submit" class="btn btn-primary" value="update">
		</div>
	</form>

@endsection
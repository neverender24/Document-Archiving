@extends('layouts.app')

@section('content')
<h2>List of Departments</h2>
<a href="{{ route('department.create') }}" class="btn btn-primary"> Add</a>
<table class="table table-stripe">
	<thead>
		<tr>
			<th>Description</th>
			<th>Prefix</th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)
			<tr>
				<td>{{ $d->description }}</td>
				<td>{{ $d->prefix }}</td>
				<td>{{ $d->college->description }}</td>
				<td><a href="{{ route('department.edit', $d->id ) }}" class="btn btn-primary"> Edit</a></td>
				<td>
					<form action="{{ route('department.destroy', $d->id ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<input type="submit" value="Delete" class="btn btn-danger">
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>

@endsection
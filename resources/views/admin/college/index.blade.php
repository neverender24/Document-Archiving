@extends('layouts.app')

@section('content')
<div class="container">
<h2>List of Colleges</h2>
<a href="{{ route('college.create') }}" class="btn btn-primary"> Add</a>
<div class="row" >
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">
<table class="table table-stripe">
	<thead>
		<tr>
			<th>Description</th>
			<th>Prefix</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $d)
			<tr>
				<td>{{ $d->description }}</td>
				<td>{{ $d->prefix }}</td>
				<td><a href="{{ route('college.edit', $d->id ) }}" class="btn btn-primary"> Edit</a></td>
				<td>
					<form action="{{ route('college.destroy', $d->id ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<input type="submit" value="Delete" class="btn btn-danger">
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
	</div>
        </div>
    </div>
	</table>

@endsection
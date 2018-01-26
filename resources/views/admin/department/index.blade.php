@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 style="color:white"></h2>
<a href="{{ route('department.create') }}" class="btn btn-primary"> Add</a>

<div class="row" >
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
   <div class="panel-heading"><h4><b>List of Departments</b></h4></div>           
<table class="table table-stripe">
	<thead>
		<tr class="bg-primary">
			<th>Description</th>
			<th>Prefix</th>
			<th>Colleges</th>
			<th></th>
			<th></th>
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
	
	</div>
	</div>
	</div>
	</table>
	</div>


@endsection
@extends('layouts.app')

@section('content')
<h2>List of Documents</h2>
<a href="{{ route('document.create') }}" class="btn btn-primary"> Add</a>
<table class="table table-stripe">
	<thead>
		<tr>
			<th>Subject</th>
			<th>Content</th>
			<th>Drawer</th>
			<th>Catgeory</th>
			<th>User</th>
			<th>Created</th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)
			<tr>
				<td>{{ $d->subject }}</td>
				<td>{{ $d->content }}</td>
				<td>{{ $d->drawer->description }}</td>
				<td>{{ $d->drawer->category->description }}</td>
				<td>{{ $d->user->name }}</td>
				<td>{{ $d->created_at }}</td>
				<td><a href="" class="btn btn-primary"> Route</a></td>
				<td><a href="{{ route('document.attachment.index', $d->id ) }}" class="btn btn-primary"> Attachments</a></td>
				<td><a href="{{ route('document.edit', $d->id ) }}" class="btn btn-primary"> Edit</a></td>
				<td>
					<form action="{{ route('document.destroy', $d->id ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<input type="submit" value="Delete" class="btn btn-danger">
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>

@endsection
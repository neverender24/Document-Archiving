@extends('layouts.app')

@section('content')
<h2>List of Attachment</h2>
<a href="{{ route('document.attachment.create', $document_id) }}" class="btn btn-primary"> Add</a>
<table class="table table-stripe">
	<thead>
		<tr>
			<th>Filename</th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)
			<tr>
				<td>{{ $d->name }}</td>
				<td><a href="{{ route('attachment.download', [$d->document_id, $d->id] ) }}" class="btn btn-primary"> Download</a></td>
				<td>
					<form action="{{ route('document.attachment.destroy', [$d->document_id, $d->id] ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<input type="submit" value="Delete" class="btn btn-danger">
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>

@endsection
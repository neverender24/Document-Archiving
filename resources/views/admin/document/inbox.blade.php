@extends('layouts.app')

@section('content')
<h2>Inbox</h2>

<form action="{{ route('inbox.search') }}" method="get">
	Search
<input type="text" name="search" class="form-control">
<input type="submit" value="Search">
</form>

<table class="table table-stripe">
	<thead>
		<tr>
			<th>Date</th>
			<th>From</th>
			<th>Subject</th>
			<th>Content</th>
			<th>Received</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)

				<tr>
					<td>{{ $d->created_at }}</td>
					<td>{{ $d->name }}</td>
					<td>{{ $d->subject }}</td>
					<td>{{ $d->content }}</td>
					<td>{{ $d->received_at }}</td>
					<td>
						<form action="{{ route('receive', [$d->document_id, $d->id] ) }}" method="post">
							{{ csrf_field() }}
							
							<input type="submit" value="Receive" class="btn btn-danger"
							@if(!is_null($d->received_at))
								disabled="" 
							@endif
							>
							
						</form>
					</td>
					<td><a href="{{ route('document.attachment.index', $d->document_id ) }}" class="btn btn-primary"> Attachments</a></td>
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
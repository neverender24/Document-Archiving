@extends('layouts.app')

@section('content')
<h2>Inbox</h2>


<form action="{{ route('inbox.search') }}" method="get" class="form-inline">
	<div class="form-group pull-right">
		<input type="text" name="search" class="form-control" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-default pull-right"><span class="fa fa-search"></span></button>
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
						<form action="{{ route('inbox.destroy', $d->id ) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('delete') }}
							<input type="submit" value="Delete" class="btn btn-danger">
						</form>
					</td>
				</tr>
		@endforeach
	</tbody>

@endsection
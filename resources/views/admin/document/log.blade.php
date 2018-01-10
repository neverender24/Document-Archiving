@extends('layouts.app')

@section('content')
<h2>Forwarded To</h2>
<table class="table table-stripe">
	<thead>
		<tr>
			<th>Date</th>
			<th>TO</th>
			<th>Subject</th>
			<th>Content</th>
			<th>Received</th>
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
				</tr>
		@endforeach
	</tbody>

@endsection
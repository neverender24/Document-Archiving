@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 style="color:white">Forwarded To</h2>
<div class="row" >
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
<table class="table table-stripe">
	<thead>
		<tr class="bg-primary">
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



</div>
</div>
</div>
</table>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 style="color:white"></h2>


<form action="{{ route('inbox.search') }}" method="get" class="form-inline">
	<div class="form-group pull-left">
		<input type="text" name="search" class="form-control" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-default pull-left"><span class="fa fa-search"></span></button>
</form>

<div class="rowinbox" >
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
 <div class="panel-heading"><h4><b>Inbox</b></h4></div>
<table class="table table-stripe">
	<thead>
		<tr class="bg-primary">
			<th>Date</th>
			<th>From</th>
			<th>Subject</th>
			<th>Content</th>
			<th>Received</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)

				<tr>
					<td>{{ \Carbon\Carbon::parse($d->created_at)->format('Y-m-d g:i A') }}</td>
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
					<td><a href="{{ route('document.attachment.index', $d->document_id ) }}" class="btn btn-primary 
							@if(is_null($d->received_at))
								disabled
							@endif
						"
						> Attachments</a></td>
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
	
	</div>
        </div>
    </div>
</table>
@endsection
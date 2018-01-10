@extends('layouts.app')

@section('content')
<h2>List of Documents</h2>
<a href="{{ route('document.create') }}" class="btn btn-primary"> Add</a>

<form action="{{ route('document.search') }}" method="get">
	Search
<input type="text" name="search" class="form-control">
<input type="submit" value="Search">
</form>

<table class="table table-stripe">
	<thead>
		<tr>
			<th>Subject</th>
			<th>Content</th>
			<th>Drawer</th>
			<th>Catgeory</th>
			<th>User</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)
			@if($d->is_private == 0 || $d->user_id == \Auth::user()->id)
				<tr>
					<td>{{ $d->subject }}</td>
					<td>{{ $d->content }}</td>
					<td>{{ $d->drawer->description }}</td>
					<td>{{ $d->drawer->category->description }}</td>
					<td>{{ $d->user->name }}</td>
					<td>{{ $d->created_at }}</td>
					@if($d->user_id == \Auth::user()->id && $d->is_private == 1)
						<td><a href="{{ route('sending', $d->id) }}" class="btn btn-primary"> Send</a></td>
					@else
						<td><a href="" class="btn btn-primary" disabled> Send</a></td>
					@endif
					<td><a href="{{ route('log',$d->id) }}" class="btn btn-primary"> Log</a></td>
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
			@endif
		@endforeach
	</tbody>

@endsection
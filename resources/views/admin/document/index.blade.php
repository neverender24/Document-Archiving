@extends('layouts.app')

@section('content')
<div class="container">
<h2>List of Documents</h2>


<form action="{{ route('document.search') }}" method="get" class="form-inline">
	<a href="{{ route('document.create') }}" class="btn btn-primary left"> Add </a>

	<div class="form-group pull-left">
		<input type="text" name="search" class="form-control" placeholder="Search">
	<button type="submit" class="btn btn-default pull-right"><span class="fa fa-search"></span></button>
	</div>


</form>


<div class="row" >
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">

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
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
						  <form action="{{ route('document.destroy', $d->id ) }}" method="post" class="in-line" >
						  	{{ csrf_field() }}
						  	{{ method_field('delete') }}
							  	@if($d->user_id == \Auth::user()->id && $d->is_private == 1)
							  		<a href="{{ route('sending', $d->id) }}" data-toggle="tooltip" title="Send" class="btn btn-primary"><span class="fa fa-send"></span></a>
							  	@else
							  		<a href="" class="btn btn-primary" data-toggle="tooltip" title="Send" disabled><span class="fa fa-send"></span></a>
							  	@endif
						  		<a href="{{ route('document.attachment.index', $d->id ) }}" class="btn btn-primary" data-toggle="tooltip" title="Attachments"> <span class="fa fa-paperclip"></span></a>
						  		<a href="{{ route('log',$d->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Log"><span class="fa fa-history"></span></a>
						  		<a href="{{ route('document.edit', $d->id ) }}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><span class="fa fa-edit"></span></a>
						  	<button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete"><span class="fa fa-trash"></span></button>
						  </form>
						</div>
					</td>

				</tr>
			@endif
		@endforeach
	</tbody>

     </div>
        </div>
    </div>
    </table>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<h2 style="color:white"></h2>


<form action="{{ route('document.search') }}" method="get" class="form-inline">
	<a href="{{ route('document.create') }}" class="btn btn-primary left"> Add </a>

	<div class="form-group pull-left">
		<input type="text" name="search" class="form-control" placeholder="Search">
	<button type="submit" class="btn btn-default pull-right"><span class="fa fa-search"></span></button>
	</div>


</form>


<div class="row" >
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
 <div class="panel-heading"><h4><b>List of Documents</b></h4>
 </div>


<table class="table table-stripe ">
	<thead>

		<tr class="bg-primary">
			<th>Subject</th>
			<th>Content</th>
			<th>Drawer</th>
			<th>Category</th>
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
					<td><a href="{{ url('document?drawer_id='.$d->drawer->id) }}" >{{ $d->drawer->description }}</a></td>
					<td><a href="{{ url('document?drawer_id='.$d->drawer->category->id) }}" >{{ $d->drawer->category->description }}</a></td>
					<td>{{ $d->user->name }}</td>
					
					<td>{{ \Carbon\Carbon::parse($d->created_at)->format('Y-m-d g:i A') }}</td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic example">
						  <form action="{{ route('document.destroy', $d->id ) }}" method="post" class="in-line" >
						  	{{ csrf_field() }}
						  	{{ method_field('delete') }}
						  		
							  	@if($d->user_id == \Auth::user()->id)
							  		<a href="{{ route('sending', $d->id) }}" data-toggle="tooltip" title="Send" class="btn btn-primary"><span class="fa fa-send"></span></a>
							  	
						  		

						  		<a href="{{ route('log',$d->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Log"><span class="fa fa-history"></span></a>

						  		<a href="{{ route('document.edit', $d->id ) }}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><span class="fa fa-edit"></span></a>

						  	<button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete"><span class="fa fa-trash"></span></button>

						  	@endif
					
					<a href="{{ route('document.attachment.index', $d->id ) }}" class="btn btn-primary" data-toggle="tooltip" title="Attachments"> <span class="fa fa-paperclip"></span></a>
						  	


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
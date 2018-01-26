@extends('layouts.app')

@section('content')
<h2 style="color:white">Add Files</h2>
	<form action="{{ route('document.attachment.store', $document_id) }}" method="post" files="true" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group col-md-12">
			<label style="color:white">Select Files
				<input type="file" name="name[]" class="form-control" multiple>
			</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection
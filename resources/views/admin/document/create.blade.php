@extends('layouts.app')

@section('content')
<h2>Add Documents</h2>
	<form action="{{ route('document.store') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group col-md-12">
			<label>Category
				<select name="category_id" id="category_id" class="form-control">
					<option value=""></option>
					@foreach($categories as $id => $description)
						<option value="{{ $id }}">{{ $description }}</option>
					@endforeach
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label>Drawer
				<select name="drawer_id" id="drawer_id" class="form-control">
					{{-- <option value=""></option>
					@foreach($drawers as $id => $description)
						<option value="{{ $id }}">{{ $description }}</option>
					@endforeach --}}
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label>Subject
				<input type="text" name="subject" class="form-control">
			</label>
		</div>
		<div class="form-group col-md-12">
		<label>Content
			<textarea  name="content" class="form-control"></textarea>
		</label>
		</div>
		<div class="form-group col-md-12">
		<label>Confidential
			<input type="checkbox" name="is_private" class="form-control" value="1">
		</label>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-primary" value="save">
		</div>
	</form>

@endsection

@section('footer_scripts')

<script>

        $('#category_id').on('change', function(e){
            var val = e.target.value;

            $.get('/drawers?category_id=' + val, function(data) {
                $('#drawer_id').empty();
                $.each(data, function(index,subCatObj){
                    $('#drawer_id').append('<option value="'+subCatObj.id+'">'+subCatObj.description+'</option>');
                });
                $("#drawer_id").prepend("<option value='0' selected='selected'></option>").val('');
            });

        });
</script>

@endsection
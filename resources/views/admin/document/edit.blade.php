@extends('layouts.app')

@section('content')
<h2 style="color:white">Edit Document</h2>
	<form action="{{ route('document.update', $edit->id) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('patch') }}
		<div class="form-group col-md-12">
			<label style="color:white">Category
				<select name="category_id" id="category_id" class="form-control">
					<option value=""></option>
					@foreach($categories as $id => $description)
						<option value="{{ $id }}"
						@if($id == $edit->drawer->category_id)
							selected
						@endif
						>{{ $description }}</option>
					@endforeach
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label style="color:white">Drawer
				<select name="drawer_id" id="drawer_id" class="form-control">
					<option value=""></option>
					@foreach($drawers as $id => $description)
						<option value="{{ $id }}"
						@if($id == $edit->drawer_id)
							selected
						@endif
						>{{ $description }}</option>
					@endforeach
				</select>
			</label>
		</div>
		<div class="form-group col-md-12">
			<label style="color:white">Subject
				<input type="text" name="subject" class="form-control" value="{{ old('subject', $edit->subject ) }}">
			</label>
		</div>
		
		<div class="form-group col-md-12">
		<label style="color:white">Content
			<!--<textarea  name="content" class="form-control">{{ old('content', $edit->content ) }}</textarea> -->
			<textarea  name="content" class="form-control">{{ old('content', $edit->content ) }}</textarea>
		</label>
		</div>
		<div class="form-group col-md-12">
		<label style="color:white">Confidential
			<!--<input type="checkbox" name="is_private" class="form-control" value="{{ old('is_private', $edit->is_private ) }}" @if(old('is_private', $edit->is_private)) checked @endif>-->
	<input type="checkbox" name="is_private" class="form-control" value="{{ old('is_private', $edit->is_private ) }}" @if(old('is_private', $edit->is_private)) checked @endif>

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
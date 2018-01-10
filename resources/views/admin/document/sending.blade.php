@extends('layouts.app')

@section('content')
<h2>Preparing to send</h2>

<form action="{{ route('sent', $document_id) }}" method="post">
	{{ csrf_field() }}
<div class="form-group">
	<label for="">To:</label>
	<select class="js-example-basic-single" name="docs[]" multiple="multiple">
		@foreach($users as $id => $description)
			<option value="{{ $id }}">{{ $description }}</option>
		@endforeach
	</select>
</div>
<div class="form-group">
	<input type="submit" value="Send" class="btn btn-primary"/>
</div>

</form>

@endsection

@section('footer_scripts')
<script>
    $(document).ready(function() {
        $( ".js-example-basic-single" ).select2();
    });
</script>
@endsection
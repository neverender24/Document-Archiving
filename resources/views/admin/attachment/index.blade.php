@extends('layouts.app')

@section('content')
<div class="container-fluids">
<h2 style="color:white"></h2>

@if($user == \Auth::user()->id)
<a href="{{ route('document.attachment.create', $document_id) }}" class="btn btn-primary"> Add</a>
@endif
<div class="row" >
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
<div class="panel-heading"><h4><b>List of Attachment</b></h4></div>  
<table class="table table-stripe">
	<thead>
		<tr class="bg-primary">
			<th>Filename</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		@foreach($data as $d)
			<tr id="row{{$d->id}}">
				<td>{{ $d->name }}</td>
				<td><a href="{{ route('attachment.download', [$d->document_id, $d->id] ) }}" class="btn btn-primary"> Download</a></td>

				@if($user == \Auth::user()->id)
				<td>
					<form action="{{ route('document.attachment.destroy', [$d->document_id, $d->id] ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}

						<input type="submit" value="Delete" class="btn btn-danger">
						
					</form>

				</td> 
				


				@endif

				@if(strpos($d->name, ".jpeg") || strpos($d->name, ".jpg") || strpos($d->name, ".png") || strpos($d->name, ".gif") || strpos($d->name, ".bmp"))
				
				<td>
					<button id="view" type="button" class="btn btn-success" value="{{ $d->name }}">View</button>
				</td>
				@endif
			</tr>
		@endforeach
	</tbody>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg ">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	         <button type="button" onClick="window.print()" >Print</button> 
	        <h4 class="modal-title">Viewer</h4>

	      </div>


	      <div class="modal-body">
	        	<img src="" id="image" class="img-responsive">	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>

	    </div>

	  </div>
	</div>


</div>
</div>
</div>
</table>
</div>

@endsection

@section('footer_scripts')
<script>
	$('table tr td').on("click", "#view", function(e){
	                var id = $(this).closest('tr').attr('id').match(/\d+/); //get the ID ONLY in row+id
	                $("#image").css({"width": "auto", "height": "auto"});
	                $('#image').attr("src","{{ asset("storage/".$document_id)."/" }}"+this.value);
	                $('#myModal').modal('show');
	            });
</script>
@endsection
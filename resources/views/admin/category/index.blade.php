@extends('layouts.app')


@section('content')
<div class="portlet light ">

	<div class="row">
		 <div class="col-xs-6 col-md-2">
            <a class="thumbnail" name="btn-add" id="btn-add" href="javascript:;">
              <img src="{{ asset('images/add-cabinet.png') }}" alt="..." class="img-thumbnail" >
              
            </a>
          </div>

        @foreach($data as $d)
        
          <div class="col-xs-6 col-md-2">
            <a href="#" class="thumbnail{{ $d->id }}" data-toggle="popover" data-trigger="focus">
              <img src="{{ asset('images/cabinet.png') }}" alt="..." class="img-thumbnail" >
              <p class="text-center">{{ $d->description }}</p>
            </a>
          </div>
     
		   <!-- loaded popover content -->
		   <ul id="popover-content" class="list-group{{ $d->id }}" style="display: none">
		     <a href="#" id="edit{{ $d->id }}" class="list-group-item open-modal" data-value="{{ $d->id }}">Edit</a>
		     <a href="#" class="list-group-item">Open</a>
		     <button class="btn btn-outline btn-circle btn-sm mt-sweetalert-delete" value="{{ $d->id }}">Delete</button>
		   </ul>

			{{-- <tr>
				<td><a href="{{ url('document?drawer_id='.$d->id) }}" >{{ $d->description }}</a></td>
				<td>{{ $d->prefix }}</td>
				<td>{{ $d->subject }}</td>
				<td>{{ $d->category->description }}</td>
				<td><a href="{{ route('drawer.edit', $d->id ) }}" class="btn btn-primary"> Edit</a></td>
				<td>
					<form action="{{ route('drawer.destroy', $d->id ) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<input type="submit" value="Delete" class="btn btn-danger">
					</form>
				</td>
			</tr> --}}
		@endforeach
</div>
    <!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        
                    </div>
                    <div class="modal-body">
                        <form id="frmModal" name="frmModal" novalidate="" class="form-horizontal" role="form">
                            <div class="form-body">
                         
                                <div class="form-group">
                                    <label class="control-label col-md-3">Description
                                    </label>
                                    <div class="col-md-7">
                                         <input type="text" name="description" class="form-control" id="description">
                                      </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3">Prefix
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-7">
                                          <input type="text" name="prefix" class="form-control" id="prefix">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button type="button" class="form-control btn btn-success btn-block" id="btn-save" value="add">SAVE</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="button" class="form-control btn btn-warning btn-block" id="btn-cancel" data-dismiss="modal" aria-label="Close">CANCEL</button>
                            </div>
                            <input type="hidden" id="category_id" name="category_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop


@section('footer_scripts')  
    <meta name="_token" content="{!! csrf_token() !!}" />
    
    <script>
        
        $(function() {
          $('[data-toggle="popover"]').popover({
        		html: true,
            content: function() {
              return $('#popover-content').html();
            }
          });
        })
 
    </script>
    <script src="{{ asset('js/model/category.js')}}"></script>
@stop
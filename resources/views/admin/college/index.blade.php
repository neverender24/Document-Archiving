@extends('layouts.app')


@section('content')
<div class="portlet light ">
	<div class="portlet-title">
		<div class="actions">
			<a class="btn btn-default btn-sm" name="btn-add" id="btn-add" href="javascript:;">New</a>
		</div>
	</div>
	<div class="portlet-body">

        <table class="table table-hover" >
            <thead>
                <th>Prefix</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr id="row{{ $d->id }}">
                    <td>{{ $d->prefix }}</td>
                    <td>{!! $d->description !!}</td>
                    <td>
                        <button class="btn btn-outline btn-circle btn-sm purple open-modal" value="{{ $d->id }}">Edit</button>
                        <button class="btn btn-outline btn-circle btn-sm red mt-sweetalert-delete" value="{{ $d->id }}">Delete</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
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
                            <input type="hidden" id="college_id" name="college_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop


@section('footer_scripts')  
    <meta name="_token" content="{!! csrf_token() !!}" />
    
    <script>
        
        // $('#btn-save').on('click', function(e) {
            
        //          e.stopImmediatePropagation();
            
            
        // });
 
    </script>
    <script src="{{ asset('js/model/college.js')}}"></script>
@stop
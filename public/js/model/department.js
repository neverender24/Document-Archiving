/* global $ */

$(document).ready(function(){

    var url = "department";

    $('.table').on("click", '.open-modal', function() {

        var id = $(this).val();
        var editUrl = url + '/' + id + '/edit';

        $.get( editUrl, function (data) {
            //success data
          //  console.log(data);

            //  get field values
            $('#department_id').val(data.id);
            $('#college_id').val(data.college_id);
            $('#description').val(data.description);
            $('#prefix').val(data.prefix);


            $('#btn-save').val("update");
            $('#myModal').modal('show');
        })
    });

    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmModal').trigger("reset");
        $('#myModal').modal('show');
    });

    handleDelete(url);

    /*
    *   SET TOKEN BEFORE SAVE
    **/
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        e.preventDefault();

        var formData = {
            // @field_name : @element_id
            prefix               : $('#prefix').val(),
            college_id               : $('#college_id').val(),
            description         : $('#description').val(),
        };


        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var id = $('#'+'department_id').val(); // btn-save ID
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + id;
        }

        //console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                
                  var newRow  = '<tr id="row' + data.id + '">' +
                                        '<td>' + data.prefix + '</td>'+
                                        '<td>' + data.description + '</td>';
                                        '<td>' + data.description + '</td>';
                                        
                                        
                    newRow += '<td><button class="btn btn-outline btn-circle btn-sm purple open-modal" value="' + data.id + '">Edit</button> ';
                    newRow += '<button class="btn btn-outline btn-circle btn-sm red mt-sweetalert-delete" value="' + data.id + '">Delete</button></td></tr>';
                    

                if (state == "add"){ //if user added a new record
                  //  location.reload();
                  $('.table tbody').prepend(newRow);
                    noty("success","Added Successfuly");
                    $('#choice').focus();
              
                }else{ //if user updated an existing record
                   // location.reload();
                   $("#row" + id).replaceWith( newRow );
                    $('#myModal').modal('hide');
                    noty("info","Updated Successfuly");
                }

                $('#frmModal').trigger("reset");

            },
            error: function (data) {
                console.log('Error:', data);
                var obj = {
                };

                $.each( obj, function( key, value ) {
                    if( typeof value !== "undefined" ){
                        noty("error","Something went wrong");
                    }
                });
            }


        });
    });
});
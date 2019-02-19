<script>
	$(function(){
		var table_contend = $("#table_index_contend");

		inicializar();
		function inicializar() {
                    table_contend.DataTable({
                        'deferLoading': true,
                        'paging': true,
                        'info': true,
                        "processing": false,
                        "serverSide": false,
                        'filter': true,
                        'stateSave': true,
                        'responsive': true,
                        "language": {
                            "paginate": {
                                "previous": "<span aria-hidden='true'>&laquo;</span>",
                                "next": "<span aria-hidden='true'>&raquo;</span>",
                            },
                            lengthMenu: 'Mostrar _MENU_ ',
                            zeroRecords: 'Sin resultados',
                            info: '',
                            infoEmpty: 'Sin registros disponibles',
                            infoFiltered: 'Filtrados de _MAX_ registros totales',
                            search: 'Buscar',
                        },
                        'ajax': {
                            "url": '{{url("/admin/contenidos")}}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'name'},
                            {
                                render: function (data, type, row) {
                                    var btn_editar = '<a href="' + row.id + '" class="btn btn-success editar-contenido" title="Editar" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>';
                                 
                                    var btn_eliminar = '<a href="' + row.id + '" class="btn btn-danger eliminar-contenido" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-circle"></i></a>';
                                    
                                    return (btn_editar + ' ' +btn_eliminar);
                                }
                            }
                        ]
                    });
                }

                $("#form_contend_create").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{ url('/admin/contenidos') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_contend_create")[0].reset();
                                    $("#create_contend").modal('hide');
                                    $("#table_index_contend").DataTable().ajax.reload();
                            }
                        },
                        error: function (e) {
                           console.log(e);
                            $.each(e.responseJSON.errors, function (index, element) {
                                if ($.isArray(element)) {
                                    toastr.error(element[0],'¡Error inesperado!');
                                }
                            });
                        }
                    });
                });


                $('body').on('click', 'tbody .editar-contenido', function (e) {

                    e.preventDefault();

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{url('/admin/contenidos/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#form_contend_edit").attr('action' , '{{ url('admin/contenidos') }}/'+respuesta.id );
                                $("#form_contend_edit #name").val(respuesta.name);
                                $("#edit_contend").modal('show');
                            }
                        },
                        error: function (e) {
                           console.log(e);
                            $.each(e.responseJSON.errors, function (index, element) {
                                if ($.isArray(element)) {
                                    toastr.error(element[0],'¡Error inesperado!');
                                }
                            });   
                        }
                    });
                });

                $("#form_contend_edit").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: $("#form_contend_edit").attr("action"),
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                 $("#form_contend_edit")[0].reset();
                                 $("#edit_contend").modal('hide');
                                 $("#table_index_contend").DataTable().ajax.reload();
                            }
                        },
                        error: function (e) {
                           console.log(e);
                            $.each(e.responseJSON.errors, function (index, element) {
                                if ($.isArray(element)) {
                                    toastr.error(element[0],'¡Error inesperado!');
                                }
                            });   
                        }
                    });
                });

                $('body').on('click', 'tbody .eliminar-contenido', function (e) {
                    idContend=$(this).attr('href');
                    token = $("input[name=_token]").val();
                    e.preventDefault();
                    swal({
                        title: '',
                        text: '¿Seguro desea eliminar el registro?',
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                      }).then(function() {
                         $.ajax({
                            url: "{{url('/admin/contenidos/')}}/"+idContend,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                     table_contend.DataTable().ajax.reload();
                                        toastr.success(respuesta.mensaje,'Enhorabuena');
                                } else {
                                     toastr.error(respuesta.error,'¡Error inesperado!');
                                }
                            },
                            error: function (e) {
                                console.log(e);
                                $.each(e.responseJSON.errors, function (index, element) {
                                    if ($.isArray(element)) {
                                        toastr.error(element[0],'¡Error inesperado!');
                                    }
                                });
                            }
                        });
                    }).catch(swal.noop);
                });	              	
	});
</script>


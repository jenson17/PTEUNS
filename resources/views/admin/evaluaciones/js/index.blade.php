<script>
	$(function(){

		var table_pruebas = $("#table_index_pruebas");

		inicializar();
        function inicializar() {
                    table_pruebas.DataTable({
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
                            lengthMenu: 'Mostrar _MENU_',
                            zeroRecords: 'Sin resultados',
                            info: '',
                            infoEmpty: 'Sin registros disponibles',
                            infoFiltered: 'Filtrados de _MAX_ registros totales',
                            search: 'Buscar',
                        },
                        'ajax': {
                            "url": '{{url("/admin/evaluaciones")}}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'titulo'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-prueba" title="Ver" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';

                                    var btn_activar = '<a href="' + row.id + '" class="btn btn-success activar-prueba" title="Activar" data-toggle="tooltip"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
                                 
                                    var btn_desactivar = '<a href="' + row.id + '" class="btn btn-warning desactivar-prueba" title="Desactivar" data-toggle="tooltip"><i class="mdi mdi-close-octagon"></i></a>';

                                    if ( row.estado == 0) {
                                    	return (btn_ver + ' ' + btn_activar);
                                    }else if(row.estado == 1){
                                    	return (btn_ver + ' ' +btn_desactivar);
                                    }  
                                }
                            }
                        ]
                    });
                }

		        $("#form_prueba_create").submit(function(e){
            
                   var formData = $(this).serialize();
                   e.preventDefault();

                    $.ajax({
                        url: '{{ url('/admin/evaluaciones') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_prueba_create")[0].reset();
                                    $("#create_prueba").modal('hide');
                                    table_pruebas.DataTable().ajax.reload();
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

                 $('body').on('click', 'tbody .ver-prueba', function (e) {

                    e.preventDefault();

                    $("#pills-tabContent label").empty();
                    $("#pills-tabContent input[type=radio]:checked").empty();

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{url('/admin/evaluaciones/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                $("#form_prueba_show #titulo").html(respuesta.titulo);
                                $("#form_prueba_show #clase_id").html(respuesta.clase_id.name);
                                if (respuesta.status == 0) {
                                    $("#form_prueba_show #status").html('<span class="badge badge-warning lg">Desactivada</span>');
                                }else if(respuesta.status == 1){
                                    $("#form_prueba_show #status").html('<span class="badge badge-success lg">Activada</span>');
                                }

                                $(respuesta.preguntas).each(function(key, value) {
                                  $('#form_prueba_show #pregunta_'+key+'').html(value.titulo);
                                });

                                $(respuesta.id[0]).each(function(key, value){
                                  $('#item_0_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_0_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[1]).each(function(key, value){
                                  $('#item_1_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_1_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[2]).each(function(key, value){
                                  $('#item_2_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_2_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[3]).each(function(key, value){
                                  $('#item_3_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_3_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[4]).each(function(key, value){
                                  $('#item_4_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_4_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[5]).each(function(key, value){
                                  $('#item_5_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_5_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[6]).each(function(key, value){
                                  $('#item_6_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_6_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[7]).each(function(key, value){
                                  $('#item_7_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_7_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                                $(respuesta.id[8]).each(function(key, value){
                                  $('#item_8_'+key+'').html(value.respuesta);
                                  if (value.estado == 1) {
                                    $('#radio_8_'+key+'').attr({
                                        checked: true,
                                        disabled: false
                                    });
                                  }   
                                });

                               

                                $("#show_prueba").modal('show');
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


                $('body').on('click', 'tbody .activar-prueba', function (e) {
                    id=$(this).attr('href');
                    token = $("input[name=_token]").val();
                    e.preventDefault();
                    swal({
                        title: '',
                        text: '¿Seguro que desea activar el registro?',
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                      }).then(function() {
                         $.ajax({
                            url: "{{url('/admin/evaluaciones/')}}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'PUT',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                        table_pruebas.DataTable().ajax.reload();
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

                 $('body').on('click', 'tbody .desactivar-prueba', function (e) {
                    id=$(this).attr('href');
                    token = $("input[name=_token]").val();
                    e.preventDefault();
                    swal({
                        title: '',
                        text: '¿Seguro que desea desactivar el registro?',
                        type: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                      }).then(function() {
                         $.ajax({
                            url: "{{url('/admin/evaluaciones/')}}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                        table_pruebas.DataTable().ajax.reload();
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
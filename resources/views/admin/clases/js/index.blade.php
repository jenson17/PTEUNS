<script>
	$(function(){

        var table_clase = $("#table_index_class");

        inicializar();
        function inicializar() {
                    table_clase.DataTable({
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
                            "url": '{{url("/admin/clases")}}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'name'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-clase" title="Ver" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';

                                        var url_foto = '{{ url("/admin/clases", "id") }}';
                                        url_foto = url_foto.replace('id', row.id+'/fotos');

                                    var btn_fotos = '<a href="' + url_foto + '" class="btn btn-primary ver-fotos" title="Fotos" data-toggle="tooltip"><i class="mdi mdi-file-image"></i></a>';

                                    var btn_editar = '<a href="' + row.id + '" class="btn btn-success editar-clase" title="Editar" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>';
                                 
                                    var btn_eliminar = '<a href="' + row.id + '" class="btn btn-danger eliminar-clase" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-circle"></i></a>';
                                    
                                    return (btn_ver + ' ' + btn_fotos + ' ' + btn_editar + ' ' +btn_eliminar);
                                }
                            }
                        ]
                    });
                }

		        $("#form_class_create").submit(function(e){
            
                   var formData = $(this).serialize();
                   e.preventDefault();

                    $.ajax({
                        url: '{{ url('/admin/clases') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_class_create")[0].reset();
                                    $("#create_class").modal('hide');
                                    table_clase.DataTable().ajax.reload();
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

                $('body').on('click', 'tbody .ver-clase', function (e) {

                    e.preventDefault();

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{url('/admin/clases/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                $("#show_class #title").html("Clase Nº "+ respuesta.id);
                                $("#form_class_show #name").html(respuesta.name);
                                $("#form_class_show #contend_id").html(respuesta.contend_id.name);  
                                $("#form_class_show #descripction").html(respuesta.descripction);

                                $("#show_class").modal('show');
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

                $('body').on('click', 'tbody .editar-clase', function (e) {

                    e.preventDefault();

                    var opcion = $("#form_class_edit #contend_id").val();

                    if (opcion != null) {
                        $('#form_class_edit #contend_id').each(function(){
                            $('#form_class_edit #contend_id option').remove();
                        });
                    }

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{url('/admin/clases/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#form_class_edit").attr('action' , '{{ url('admin/clases') }}/'+respuesta.id );
                                $("#form_class_edit").attr('method', 'PUT');

                                $("#form_class_edit #name").val(respuesta.name);

                                var selecionado =  $("#form_class_edit #contend_id").append('<option value="'+respuesta.contend_id.id+'" selected="" >'+respuesta.contend_id.name+'</option>');

                               $(respuesta.contenidos).each(function(key,value){

                                     if (key==0) {
                                        $("#form_class_edit #contend_id").append(selecionado);
                                        $("#form_class_edit #contend_id").append('<option value="'+value.id+'" >'+value.name+'</option>');
                                     }else{

                                        $("#form_class_edit #contend_id").append('<option value="'+value.id+'" >'+value.name+'</option>');
                                     }
                               });

                                 $("#form_class_edit #descripction").trumbowyg('html',{
                                      title:  respuesta.descripction,      
                                  });
                                
                                $("#edit_clase").modal('show');
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

                 $("#form_class_edit").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();

                    $.ajax({
                        url: $("#form_class_edit").attr("action"),
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                 $("#form_class_edit")[0].reset();
                                 $("#edit_clase").modal('hide');
                                 table_clase.DataTable().ajax.reload();
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

                $('body').on('click', 'tbody .eliminar-clase', function (e) {
                    idClase=$(this).attr('href');
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
                            url: "{{url('/admin/clases/')}}/"+idClase,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                        table_clase.DataTable().ajax.reload();
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
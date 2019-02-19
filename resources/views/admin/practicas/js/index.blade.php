<script>
	$(function(){

        var table_practicas = $("#table_index_practicas");

		inicializar();

        function inicializar() {
                    table_practicas.DataTable({
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
                            "url": '{{ url("/admin/practicas") }}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'titulo'},
                            {data: 'created_at'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-practica " title="Ver" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';
                                 
                                     var btn_activar = '<a href="' + row.id + '" class="btn btn-success activar-practica" title="Activar" data-toggle="tooltip"><i class="mdi mdi-checkbox-marked-circle"></i></a>';
                                 
                                    var btn_desactivar = '<a href="' + row.id + '" class="btn btn-warning desactivar-practica" title="Desactivar" data-toggle="tooltip"><i class="mdi mdi-close-octagon"></i></a>';

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

                $.uploadPreview({
                    input_field: "#image-upload",   // Default: .image-upload
                    preview_box: ".image-preview",  // Default: .image-preview
                    label_field: ".image-label",    // Default: .image-label
                    label_default: "Cargar foto/video",   // Default: Choose File
                    label_selected: "Cambiar foto/video",  // Default: Change File
                    no_label: false                 // Default: false
                });

                $("#form_practica_create").submit(function(e){

                    var formData = new FormData(this);

                    e.preventDefault();

                    $.ajax({
                        url: '{{ url("/admin/practicas") }}',
                          type: 'POST',
                          enctype: 'multipart/form-data',
                          data: formData,
                          contentType: false,
                          processData: false,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                    toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_practica_create")[0].reset();
                                    $(".image-preview").removeAttr("style");
                                    $("#create_practica_foto").modal('hide');
                                    table_practicas.DataTable().ajax.reload();
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

                $("#form_practicavideo_create").submit(function(e){

                    var formData = new FormData(this);

                    e.preventDefault();

                    $.ajax({
                        url: '{{ url("/admin/practicas") }}',
                          type: 'POST',
                          enctype: 'multipart/form-data',
                          data: formData,
                          contentType: false,
                          processData: false,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                    toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_practicavideo_create")[0].reset();
                                    $("#create_practica_video").modal('hide');
                                    table_practicas.DataTable().ajax.reload();
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

                 $('body').on('click', 'tbody .ver-practica', function (e) {

                    e.preventDefault();

                    id = $(this).attr('href');

                    $("#imagen_all").attr("style","display: none;");
                    $("#video_all").attr("style","display: none;");

                    $("#imagen").empty();
                    $("#video").empty();

                    $.ajax({
                        url: "{{ url("/admin/practicas") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#ver_imagen_titulo").html("Título: " + respuesta.practica.titulo);
                                $("#clase_id_practica").html(respuesta.clase_id.name);
                                if (respuesta.status == 0) {
                                    $("#status_practica").html('<span class="badge badge-warning lg">Desactivada</span>');
                                }else if(respuesta.status == 1){
                                    $("#status_practica").html('<span class="badge badge-success lg">Activada</span>');
                                }

                                if (respuesta.practica.type == "image") {

                                     var foto_url = "{{ url("/") }}" + respuesta.practica.name;

                                     var img = '<img src="'+foto_url+'" alt="" id="ver_imagen" class="img-thumbnail center-block float-center">';

                                     $("#imagen_all").show();

                                     $("#imagen").append(img);
                                     

                                }

                                 if(respuesta.practica.type == "video"){

                                    var video_url = "{{ url("/") }}" + respuesta.practica.name;

                                    var video = '<video src="'+video_url+'" width="600" height="400" controls=""></video>';

                                    $("#video_all").show();

                                    $("#video").append(video);
                                }
                               
            
                                $("#show_practica").modal('show');
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

               $('body').on('click', 'tbody .activar-practica', function (e) {
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
                            url: "{{url('/admin/practicas/')}}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'PUT',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                        table_practicas.DataTable().ajax.reload();
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

                 $('body').on('click', 'tbody .desactivar-practica', function (e) {
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
                            url: "{{url('/admin/practicas/')}}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                        table_practicas.DataTable().ajax.reload();
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
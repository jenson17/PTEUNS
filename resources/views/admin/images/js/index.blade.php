<script>
	$(function(){

        var table_fotos = $("#table_index_fotos");

		inicializar();

        function inicializar() {
                    table_fotos.DataTable({
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
                            "url": '{{ url("/admin/clases/{$clas_id}/fotos") }}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'titulo'},
                            {data: 'created_at'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-foto " title="Ver" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';
                                 
                                    var btn_eliminar = '<a href="' + row.id + '" class="btn btn-danger eliminar-foto" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-circle"></i></a>';
                                    
                                    return (btn_ver + ' ' +btn_eliminar);
                                }
                            }
                        ]
                    });
                }

                $.uploadPreview({
                    input_field: "#image-upload",   // Default: .image-upload
                    preview_box: ".image-preview",  // Default: .image-preview
                    label_field: ".image-label",    // Default: .image-label
                    label_default: "Cargar imagen",   // Default: Choose File
                    label_selected: "Cambiar imagen",  // Default: Change File
                    no_label: false                 // Default: false
                });

                $("#form_images_create").submit(function(e){

                    var formData = new FormData(this);

                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{ url("/admin/clases/{$clas_id}/fotos") }}',
                          type: 'POST',
                          enctype: 'multipart/form-data',
                          data: formData,
                          contentType: false,
                          processData: false,
                        beforeSend: function(){
                            console.log('procesando peticion');
                            console.log(formData);
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_images_create")[0].reset();
                                    $(".image-preview").removeAttr("style");
                                    $("#create_image").modal('hide');
                                    table_fotos.DataTable().ajax.reload();
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

                 $('body').on('click', 'tbody .ver-foto', function (e) {

                    e.preventDefault();

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{ url("/admin/clases/{$clas_id}/fotos") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#ver_imagen_titulo").html("Título: " + respuesta.image.titulo);

                                $("#ver_imagen").attr('src', "{{ url("/") }}" + respuesta.image.name);
                                
                                $("#show_image").modal('show');
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

                $('body').on('click', 'tbody .eliminar-foto', function (e) {
                    idFoto=$(this).attr('href');
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
                            url: "{{ url("/admin/clases/{$clas_id}/fotos") }}/"+idFoto,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
                                     table_fotos.DataTable().ajax.reload();
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
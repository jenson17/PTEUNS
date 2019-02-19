<script>
	$(function(){

                $("#form_publicacion_create").submit(function(e){

                    var formData = new FormData(this);

                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{url('/publicacion')}}',
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
                                    $("#form_publicacion_create")[0].reset();
                                   
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

                $(".editar_pulicacion").click(function(e){

                    id = $(this).attr('href');
                    e.preventDefault();
                    
                    $.ajax({
                        url: "{{ url("/publicacion") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                 $("#form_publi_show ").attr('action' , '{{ url('/publicacion') }}/'+respuesta.publi.id );
                                $("#form_publi_show #publicacion").html(respuesta.publi.publicacion);
                                $("#show_publi").modal('show');
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

                 $("#form_publi_show").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: $("#form_publi_show").attr("action"),
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                 $("#form_publi_show")[0].reset();
                                 $("#show_publi").modal('hide');
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

                $(".eliminar_publicacion").click(function(e){

                    id=$(this).attr('href');
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
                            url: "{{ url("/publicacion") }}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
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

                $(".comentario").submit(function(e){

                    var formData = $(this).serialize();
                     id=$(this).attr('id');
                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{url('/comentarios')}}',
                           type: 'POST',
                           dataType: 'json',
                           data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                            console.log(id);
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                   $('#'+id+'')[0].reset();         
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

                $(".editar_comentario").click(function(e){

                    id = $(this).attr('href');
                    e.preventDefault();
                    
                    $.ajax({
                        url: "{{ url("/comentarios") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                 $("#form_comentario_show").attr('action' , '{{ url('/comentarios')}}/'+respuesta.comentario.id );
                                $("#form_comentario_show #comentario").html(respuesta.comentario.comentario);
                                $("#show_comentario").modal('show');
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

                $("#form_comentario_show").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: $("#form_comentario_show").attr("action"),
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                 $("#form_comentario_show")[0].reset();
                                 $("#show_comentario").modal('hide');
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

                $(".eliminar_comentario").click(function(e){

                    id=$(this).attr('href');
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
                            url: "{{ url("/comentarios") }}/"+id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'DELETE',
                            datatype: 'json',
                            success: function (respuesta) {
                                if (respuesta.success) {
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
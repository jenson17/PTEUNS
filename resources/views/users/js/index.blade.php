<script>
	$(function(){

		$("#edit_user").click(function(e){

                    e.preventDefault();

                    id = {{ Auth::user()->id }};

                    $.ajax({
                        url: "{{url('/user/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                            	$("#form_user_edit").attr('action' , '{{ url('user') }}/'+respuesta.id );
                            	$("#form_user_edit").attr('method','PUT');
                                $("#form_user_edit #name").val(respuesta.name);
                                $("#form_user_edit #email").val(respuesta.email);
                                $("#modal_user").modal('show');
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

                $("#form_user_edit").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: $("#form_user_edit").attr("action"),
                        type: 'PUT',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                 $("#form_user_edit")[0].reset();
                                 $("#modal_user").modal('hide');
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


                $('#form-cambiar-password').submit(function (e) {
			        e.preventDefault();
			        $.ajax({
			            url: $('#form-cambiar-password').attr('action'),
			            type: $('#form-cambiar-password').attr('method'),
			            data: $('#form-cambiar-password').serialize(),
			            datatype: 'json',
			            success: function (respuesta) {
			                if (respuesta.success) {
			                    toastr.success(respuesta.mensaje,'Enhorabuena');
			                    $('#form-cambiar-password')[0].reset();
			                    $("#password_user").modal('hide');
			                }
			                else {
			                    toastr.error(respuesta.mensaje,'¡Error inesperado!');
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

                $("#form_user_create").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{ url('/mensajes') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_user_create")[0].reset();
                                    $("#mensaje_user").modal('hide');
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

                $(".mensaje").click(function(e){

                    id = $(this).attr('href');
                    $("#agregar").empty();
                    e.preventDefault();
                    
                    $.ajax({
                        url: "{{ url("/mensajes") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                    $("#form_show_mensaje #mensaje_id").val(respuesta.id);

                                    if (respuesta.respuestas) {
                                        $(respuesta.respuestas).each(function(key, value){

                                         var agregar =  '<div class="row"><div class="col-md-2"><div class="preview-thumbnail">'; 
                                         var url = '{{asset('plugins/images/faces/default.jpg')}}';
                                         agregar+= '<img class="img-sm rounded-circle mb-4 mb-md-0" src="'+url+'"  alt="profile image"></div></div><div class="col-md-10"><div class="form-group">';
                                        
                                         agregar+=  '<label class="form-label form-control"><b><i>'+value.name+'</i></b> : ' +value.respuesta+' </label>';

                                          agregar+= '</div></div></div>';

                                        $("#agregar").prepend(agregar);    
                                   });

                                    console.log(agregar);
                                    }
                                    $("#form_show_mensaje #mensaje_show").html('<b><i>'+respuesta.mensaje.name+'</i></b>' +' : '+ respuesta.mensaje.mensaje);


                                    $("#show_mensaje_user").modal('show');
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

                 $("#form_show_mensaje").submit(function(e){

                    var formData = $(this).serialize();
                    e.preventDefault();
                    
                    $.ajax({
                        url: '{{ url('/respuestasmensaje') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                 toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_show_mensaje")[0].reset();
                                    $("#show_mensaje_user").modal('hide');
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
	});
</script>
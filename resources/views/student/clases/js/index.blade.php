<script>
	$(function(){

				 $(".ver_clase").click(function(e){

                    e.preventDefault();

                    $("#galeria").attr("style","display: none;");

                    $("#prev").hide();
                    $(".carousel-inner").empty();

                    id = $(this).attr('href');

                    $.ajax({
                        url: "{{url('/student/clase/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                $("#show_class #title").html(respuesta.name);  
                                $("#form_class_show #descripction").html(respuesta.descripction);
                                if (respuesta.fotos.length > 0) {
                
                                    $("#galeria").show();

                                    $(respuesta.fotos).each(function(key, value) {
                                        
                                        var foto_url = "{{ url("/") }}" + value.name;
                                        var foto = "";
                                  
                                        if (key == 0) {
                                            foto = '<div class="carousel-item active"><img class="d-block w-100" src="'+foto_url+'" alt="First slide"></div>';
                                        }else{

                                            foto = '<div class="carousel-item"><img class="d-block w-100" src="'+foto_url+'" alt="First slide"></div>';
                                        }
                                   
                                        $(".carousel-inner").append(foto);
                                    });
                                    
                                    if (respuesta.fotos.length > 1) {
                                        $("#prev").show();
                                    }  
                                }

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
	});
</script>
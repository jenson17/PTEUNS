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
                            "url": '{{ url("/student/practica") }}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'titulo'},
                            {data: 'created_at'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-practica " title="Ver detalles" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';
                                 
                                    return btn_ver;

                                } 
                                
                            }
                        ]
                    });
                }

                 $('body').on('click', 'tbody .ver-practica', function (e) {

                    e.preventDefault();

                    id = $(this).attr('href');

                    $("#imagen_all").attr("style","display: none;");
                    $("#video_all").attr("style","display: none;");

                    $("#imagen").empty();
                    $("#video").empty();

                    $.ajax({
                        url: "{{ url("/student/practica") }}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#ver_imagen_titulo").html('<h4>'+respuesta.practica.titulo+'</h4>');
                                $("#clase_id_practica").html(respuesta.clase_id.name);
                                
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
	});
</script>
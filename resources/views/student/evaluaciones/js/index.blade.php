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
                            "url": '{{url("/student/evaluacion")}}',
                            "type": "GET",
                            dataSrc: '',
                        },
                        'columns': [
                            {data: 'titulo'},
                            {
                                render: function (data, type, row) {
                                    var btn_ver = '<a href="' + row.id + '" class="btn btn-info ver-prueba" title="Aplicar" data-toggle="tooltip"><i class="mdi mdi-magnify"></i></a>';

                                    return (btn_ver);
                                      
                                }
                            }
                        ]
                    });
                }


                $("#form_prueba_show").submit(function(e){
            
                   var formData = $(this).serialize();
                   e.preventDefault();

                    $.ajax({
                        url: '{{ url('/student/evaluacion') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {
                                    toastr.success(respuesta.mensaje,'Enhorabuena');
                                    $("#form_prueba_show")[0].reset();
                                    $("#show_prueba").modal('hide');
                                    table_pruebas.DataTable().ajax.reload();
                            }else{
                                    toastr.error(respuesta.mensaje,'Lo siento');
                                    $("#form_prueba_show")[0].reset();
                                    $("#show_prueba").modal('hide');
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
                        url: "{{url('/student/evaluacion/')}}/" + id,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(){
                            console.log('procesando peticion');
                        },
                        success: function(respuesta){
                            if (respuesta.success) {

                                $("#exampleModalLabel1").html(respuesta.titulo);
                                $("#form_prueba_show #evaluacion_id").attr('value', respuesta.evaluacion);
                                $("#form_prueba_show #clas_id").attr('value', respuesta.clase_id.id);

                                $("#form_prueba_show #clase_id").html(respuesta.clase_id.name);
                                
                                $(respuesta.preguntas).each(function(key, value) {

                                  $('#form_prueba_show #pregunta_'+key+'').html(value.titulo);

                                  $('#form_prueba_show #preg_'+key+'').attr('value', value.id);

                                });

                                
                                console.log(respuesta.preguntas);

                                console.log(respuesta.id);

                                $(respuesta.id[0]).each(function(key, value){
                                  $('#item_0_'+key+'').html(value.respuesta);
                                  $('#form_prueba_show #res_0_'+key+'').attr('value', value.id);
                                    
                                });

                                $(respuesta.id[1]).each(function(key, value){
                                  $('#item_1_'+key+'').html(value.respuesta);
                                   $('#form_prueba_show #res_1_'+key+'').attr('value', value.id);
                                    
                                });

                                $(respuesta.id[2]).each(function(key, value){
                                  $('#item_2_'+key+'').html(value.respuesta);
                                   $('#form_prueba_show #res_2_'+key+'').attr('value', value.id);
                                   
                                });

                                $(respuesta.id[3]).each(function(key, value){
                                  $('#item_3_'+key+'').html(value.respuesta);
                                  $('#form_prueba_show #res_3_'+key+'').attr('value', value.id);
                                     
                                });

                                $(respuesta.id[4]).each(function(key, value){
                                  $('#item_4_'+key+'').html(value.respuesta);
                                  $('#form_prueba_show #res_4_'+key+'').attr('value', value.id);
                                 
                                });

                                $("#show_prueba").modal('show');

                            
                                IniciarContador();
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

             function IniciarContador(){
                var tiempo=60;
                var mTiempo=document.querySelector("#tiempo");
                var body=document.querySelector("BODY");
                var intervalo;
                intervalo = setInterval(e=>{
                    tiempo -= 1;
                    mTiempo.innerHTML = `${tiempo}`;
                    if ( tiempo == 0) {
                        clearInterval(intervalo);
                        $("#form_prueba_show").trigger('submit');
                    }
                },1000);
             }
	});
</script>
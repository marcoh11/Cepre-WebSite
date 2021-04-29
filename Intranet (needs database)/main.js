$(document).ready(function(){
    tablaCronograma = $("#tablaCronograma").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formCronograma").trigger("reset");
    $(".modal-header").css("background-color", "#395FCF");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Anuncio");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    fecha = fila.find('td:eq(1)').text();
    actividad = fila.find('td:eq(2)').text();

    
    $("#fecha").val(fecha);
    $("#actividad").val(actividad);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Anuncio");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el anuncio: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaCronograma.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formCronograma").submit(function(e){
    e.preventDefault();    
    fecha = $.trim($("#fecha").val());
    actividad = $.trim($("#actividad").val());  
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {fecha:fecha, actividad:actividad, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            fecha = data[0].fecha;
            actividad = data[0].actividad;
            if(opcion == 1){tablaCronograma.row.add([id,fecha,actividad]).draw();}
            else{tablaCronograma.row(fila).data([id,fecha,actividad]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});
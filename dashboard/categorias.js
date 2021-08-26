$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
        }],
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
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Categoria");            
        $("#modalCRUD").modal("show");        
        id=0;
        opcion = 1; //alta
    });    
        
    var fila; //capturar la fila para editar o borrar el registro
    
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        
        $("#nombre").val(nombre);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Categoria");            
        $("#modalCRUD").modal("show");
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var form_data   = new FormData();
        form_data.append("opcion", opcion);
        form_data.append("id", id);
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "../conexion/crud_categorias.php",
                method: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data)
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
        
    $("#formPersonas").submit(function(e){
        e.preventDefault();
        var form_data   = new FormData();
        var nombre = $("#nombre").val();

        form_data.append("nombre", nombre);
        form_data.append("opcion", opcion);
        form_data.append("id", id);
        $.ajax({
            url: "../conexion/crud_categorias.php",
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
                dataFull = JSON.parse(data);
                console.log(dataFull);
                id = dataFull[0].id;       
                nombre = dataFull[0].nombre;
                if(parseInt(opcion) == 1){tablaPersonas.row.add([id,nombre]).draw();}
                else{tablaPersonas.row(fila).data([id,nombre]).draw();}            
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
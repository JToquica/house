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
        $(".modal-title").text("Nueva Inmueble");            
        $("#modalCRUD").modal("show");        
        id=0;
        opcion = 1; //alta
    });    
        
    var fila; //capturar la fila para editar o borrar el registro
    
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        titulo = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        area = parseInt(fila.find('td:eq(3)').text());
        precio = parseInt(fila.find('td:eq(4)').text()); 
        contacto = fila.find('td:eq(6)').text(); 
        
        $("#titulo").val(titulo);
        $("#descripcion").val(descripcion);
        $("#area").val(area);
        $("#precio").val(precio);
        $("#contacto").val(contacto);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");            
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
                url: "../conexion/crud.php",
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
        var file_data   = $("#imgPortada").prop("files")[0];
        var files_data  = $("#imagenes").prop("files");
        var c_imgs = files_data.length;

        if (c_imgs > 0){
            for (var i=0; i < c_imgs; i++){
                form_data.append('file'+i,files_data[i]);
            }
        } 
        
        var titulo      = $("#titulo").val();
        var descripcion = $("#descripcion").val();
        var area        = $("#area").val();
        var precio      = $("#precio").val();
        var categoria   = $("#categoria").val();
        var contacto    = $("#contacto").val();

        form_data.append("imgPortada", file_data);
        form_data.append("imagenes", files_data);
        form_data.append("titulo", titulo);
        form_data.append("descripcion", descripcion);
        form_data.append("area", area);
        form_data.append("precio", precio);
        form_data.append("categoria", categoria);
        form_data.append("contacto", contacto);
        form_data.append("opcion", opcion);
        form_data.append("id", id);
        form_data.append('c_imgs', c_imgs);
        $.ajax({
            url: "../conexion/crud.php",
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data){
                dataFull = JSON.parse(data);
                console.log(dataFull);
                id = dataFull[0].id;          
                titulo = dataFull[0].titulo;
                descripcion = dataFull[0].descripcion;
                area = dataFull[0].area;
                precio = dataFull[0].precio;
                categoria = dataFull[0].categoria;
                contacto = dataFull[0].contacto;
                if(parseInt(opcion) == 1){tablaPersonas.row.add([id,titulo,descripcion,area,precio,categoria,contacto]).draw();}
                else{tablaPersonas.row(fila).data([id,titulo,descripcion,area,precio,categoria,contacto]).draw();}            
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
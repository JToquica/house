$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    
   var password =$.trim($("#password").val());    
    
   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o password',
      });
      return false; 
    }else{
        $.ajax({
           url:"conexion/register.php",
           type:"POST",
           datatype: "json",
           data: {usuario:usuario, password:password, rol:2}, 
           success:function(data){               
               if(data == "null"){
                   Swal.fire({
                       type:'error',
                       title:'Registro incorrecto',
                   });
               }else{
                   Swal.fire({
                       type:'success',
                       title:'¡Registro Exitoso!',
                       confirmButtonColor:'#3085d6',
                       confirmButtonText:'Ingresar'
                   }).then((result) => {
                       if(result.value){
                           //window.location.href = "vistas/pag_inicio.php";
                           window.location.href = "./login.php";
                       }
                   })
                   
               }
           }    
        });
    }     
});
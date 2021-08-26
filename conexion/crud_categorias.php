<?php
include_once './conexion.php';
$objeto   = new Conexion();
$conexion = $objeto->Conectar();

$id       = (isset($_POST["id"])) ? (intval($_POST["id"])) : 0;
$nombre   = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$opcion   = (isset($_POST["opcion"])) ? (intval($_POST["opcion"])) : 0;


switch($opcion){
    case 0:
        $consulta  = "SELECT * FROM categorias";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 1: //alta
        $consulta  = "INSERT INTO categorias (nombre) VALUES('$nombre')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta  = "SELECT id,nombre FROM categorias ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE categorias SET nombre='$nombre' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id,nombre FROM categorias WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $consulta = "DELETE FROM categorias WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        
        $consulta = "SELECT id, nombre FROM categorias";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
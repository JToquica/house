<?php
include_once './conexion.php';
$objeto   = new Conexion();
$conexion = $objeto->Conectar();

$id           = (isset($_POST["id"])) ? (intval($_POST["id"])) : 0;
$documento_id = (isset($_POST["documento_id"])) ? (intval($_POST["documento_id"])) : 0;
$nombre       = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$apellido     = (isset($_POST["apellido"])) ? $_POST["apellido"] : "";
$telefono     = (isset($_POST["telefono"])) ? $_POST["telefono"] : "";
$correo       = (isset($_POST["correo"])) ? $_POST["correo"] : "";
$opcion       = (isset($_POST["opcion"])) ? (intval($_POST["opcion"])) : 0;

switch($opcion){
    case 0:
        $consulta  = "SELECT * FROM propietarios";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 1: //alta
        $consulta  = "INSERT INTO propietarios (documento_id, nombre, apellido, telefono, correo) VALUES('$documento_id', '$nombre', '$apellido', '$telefono', '$correo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta  = "SELECT id, documento_id, nombre, apellido, telefono, correo FROM propietarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE propietarios SET documento_id='$documento_id', nombre='$nombre', apellido='$apellido', telefono='$telefono', correo='$correo' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, documento_id, nombre, apellido, telefono, correo FROM propietarios WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $consulta = "DELETE FROM propietarios WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        
        $consulta = "SELECT id, documento_id, nombre, apellido, telefono, correo FROM propietarios";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
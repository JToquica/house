<?php
include_once './conexion.php';
$objeto   = new Conexion();
$conexion = $objeto->Conectar();

$imgPortada = array($_FILES["imgPortada"]);

$nombreImg = $imgPortada[0]['name'];
$tipoImg   = $imgPortada[0]['type'];
$sizeImg   = $imgPortada[0]['size'];
$tmpImg    = $imgPortada[0]['tmp_name'];

$c_imgs      = $_POST["c_imgs"];
$id          = intval($_POST["id"]);
$titulo      = $_POST["titulo"];
$descripcion = $_POST["descripcion"];
$area        = intval($_POST["area"]);
$precio      = intval($_POST["precio"]);
$categoria   = intval($_POST["categoria"]);
$contacto    = $_POST["contacto"];
$opcion      = intval($_POST["opcion"]);

$urlFile = $_SERVER['DOCUMENT_ROOT'].'house/assets/img/';
$imgFileUrl = "assets/img/portada_inmuebles/notFound.png";
$imgFiles = "assets/img/inmuebles/notFound.png";

//Imagen
if ($nombreImg == !NULL){
    $imgFileUrl = "";
    if (($tipoImg == "image/gif") || ($tipoImg == "image/jpeg") || ($tipoImg == "image/jpg") || ($tipoImg == "image/png")){
        move_uploaded_file($tmpImg, $urlFile.'portada_inmuebles/'.$nombreImg);
        $imgFileUrl = 'assets/img/portada_inmuebles/'.$nombreImg;
    }else{
        echo "No se puede subir una imagen con ese formato";
        $imgFileUrl = "assets/img/portada_inmuebles/notFound.png";
    }
}

//Imagenes
if ($c_imgs > 0){
    $imagenes = array();
    $imgFiles = "";
    for($i = 0; $i < $c_imgs; $i++){
        $nombre = 'file'.$i;
        $imgFile = ($_FILES[$nombre]);
        array_push($imagenes, $imgFile);
    }
    for ($j = 0; $j < $c_imgs; $j++){
        if (($imagenes[$j]['type'] == "image/gif") || ($imagenes[$j]['type'] == "image/jpeg") || ($imagenes[$j]['type'] == "image/jpg") || ($imagenes[$j]['type'] == "image/png")){
            move_uploaded_file($imagenes[$j]['tmp_name'], $urlFile.'inmuebles/'.$imagenes[$j]['name']);
            $imgFiles .= 'assets/img/inmuebles/'.$imagenes[$j]['name'].',';
        }
        else{
            echo "No se puede subir este tipo de archivo";
            $imgFiles = "assets/img/inmuebles/notFound.png";
        }
    }
    $imgFiles = trim($imgFiles, ',');
}

switch($opcion){
    case 1: //alta
        $consulta  = "INSERT INTO inmuebles (titulo, descripcion, area, precio, categoria, contacto, url_img, url_imgs) VALUES('$titulo', '$descripcion', '$area', '$precio', '$categoria', '$contacto', '$imgFileUrl', '$imgFiles')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta  = "SELECT id, titulo, descripcion, area, precio, categoria, contacto FROM inmuebles ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE inmuebles SET titulo='$titulo', descripcion='$descripcion', area='$area', precio='$precio', categoria='$categoria', contacto='$contacto', url_img='$imgFileUrl', url_imgs='$imgFiles' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, titulo, descripcion, area, precio, categoria, contacto FROM inmuebles WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $consulta = "DELETE FROM inmuebles WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        
        $consulta = "SELECT id, titulo, descripcion, area, precio, categoria, contacto FROM inmuebles ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
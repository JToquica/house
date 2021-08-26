<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
$imgPortada = (isset($_FILES['imgPortada'])) ? $_FILES['imgPortada'] : '';
$imagenes = (isset($_FILES['imagenes'])) ? $_FILES['imagenes'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$nombreImg = $imgPortada['name'];
$tipoImg = $imgPortada['type'];
$sizeImg = $imgPortada['size'];

if (($nombreImg == !NULL) && ($sizeImg <= 200000)){
    if (($tipoImg == "image/gif") || ($tipoImg == "image/jpeg") || ($tipoImg == "image/jpg") || ($tipoImg == "image/png")){
        $directorio = '../assets/img/portafolio/';
        move_uploaded_file($imgPortada['tmp_name'], $directorio.$nombreImg);
        $imgFile = 'assets/img/portafolio/'.$nombreImg;
    }
    else{
        echo "No se puede subir una imagen con ese formato";
    }
}else{
    if($nombreImg == !NULL) echo "La imagen es demasiado grande ";
}

if ($imagenes){
    $cantidad = count($imagenes['tmp_name']);
    $imgFiles = "";
    for($i = 0; $i < $cantidad; $i++){
        if (($imagenes["type"][$i] == "image/gif") || ($imagenes["type"][$i] == "image/jpeg") || ($imagenes["type"][$i] == "image/jpg") || ($imagenes["type"][$i] == "image/png")){
            $directorio = '../assets/img/portafolio/';
            move_uploaded_file($imagenes["tmp_name"][$i], $directorio.$imagenes["tmp_name"][$i]);
            $imgFiles .= '/assets/img/portafolio/'.$imagenes["tmp_name"][$i].',';
        }else{
            echo "No se puede subir una imagen con ese formato";
        }
    }
    $imgFiles = trim($imgFiles, ',');   
}

switch($opcion){
    case 1: //alta
        $consulta  = "INSERT INTO inmuebles (titulo, descripcion, area, precio, categoria, contacto, url_img, url_imgs) VALUES('$titulo', '$descripcion', '$area', '$precio', '$categoria', '$imgFile', '$imgFiles') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta  = "SELECT id, titulo, descripcion, area, precio, categoria, contacto, url_img, url_imgs FROM inmuebles ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE inmuebles SET titulo='$titulo', descripcion='$descripcion', area='$area', precio='$precio', categoria='$categoria', contacto='$contacto', url_img='$imgFile', url_imgs='$imgFiles' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, titulo, descripcion, area, precio, categoria, contacto, url_img, url_imgs FROM inmuebles WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM inmuebles WHERE id='$id' ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;

        $consulta = "SELECT id, titulo, descripcion, area, precio, categoria, contacto, url_img, url_imgs FROM inmuebles ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Inmuebles</h1>

    <?php
    include_once '../conexion/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id, titulo, descripcion, area, precio, categoria, contacto FROM inmuebles";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta = "SELECT id, name FROM categorias";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $categorias=$resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>


<div class="container">
    <div class="row">
        <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
        </div>    
    </div>    
</div>

<br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>                                
                                <th>Area</th>
                                <th>Precio</th>
                                <th>Categoria</th>
                                <th>Contacto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['titulo'] ?></td>
                                <td><?php echo $dat['descripcion'] ?></td>
                                <td><?php echo $dat['area'] ?></td>
                                <td><?php echo '$'.number_format($dat['precio']) ?></td>
                                <td><?php echo $dat['categoria'] ?></td>
                                <td><?php echo $dat['contacto'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas" method="post">    
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="titulo">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion">
                </div>                
                <div class="form-group">
                <label for="area" class="col-form-label">Area:</label>
                <input type="number" class="form-control" id="area">
                </div>
                <div class="form-group">
                <label for="precio" class="col-form-label">Precio:</label>
                <input type="number" class="form-control" id="precio">
                </div>   
                <div class="form-group">
                <label for="categoria" class="col-form-label">Categoria:</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option selected>Escoge una categoria</option>
                    <?php 
                        foreach($categorias as $categoria){
                            echo '<option value="'.$categoria['id'].'">'.$categoria['name'].'</option>';
                        }
                    ?>
                </select>
                </div>
                <div class="form-group">
                <label for="contacto" class="col-form-label">Contacto:</label>
                <input type="text" class="form-control" id="contacto">
                </div>
                <div class="form-group">
                <label for="imgPortada" class="col-form-label">Imagen Portada:</label>
                <input class="form-control" type="file" id="imgPortada">
                </div>
                <div class="form-group">
                <label for="imagenes" class="col-form-label">Imagenes:</label>
                <input class="form-control" type="file" id="imagenes" multiple>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>
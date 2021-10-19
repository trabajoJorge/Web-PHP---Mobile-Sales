<?php
/* 
 * Este PHP contiene funciones utilizadas para imprimir los bloques/contenedores
 * de móviles. Se dejan dos funciones:
 * - echoMovilReducido, que imprime el bloque de visualización de móvil que se usa
 * en el buscador y las recomendaciones.
 * - echoMovilSolicitudes, que imprime el bloque de visualización de las solicitudes
 * de un móvil.
 */

/**
 * Muestra un contenedor con alguna de la información del móvil pasado por parámetro (imagen, nombre, marca,
 * fecha salida, precio y estado) y coloca al final un link que redirecciona a la página definida en
 * redirección.
 * @param type $movil. Se trata del móvil que queremos mostrar. Esta variable debe tratarse del 
 *                     array correspondiente al móvil.
 * @param type $redireccion. Se trata de un String que indica la pagina a la que se quiere redireccionar
 *                           al pulsar "Leer más".
 */
function echoMovilReducido($movil, $redireccion){
    ?>
    <!-- Comienzo del bloque del móvil --> 
    <div class="container_movil" id="<?php echo $movil['ID'];?>">
        <div class="wrapper_movil">
            <!-- Comienzo de la zona de detalles (cabecera del formulario) -->
            <div class="grid_cabecera">
                <!-- Grid para el input de la imagen -->
                <div class="grid_imagen">
                    <div class="container_imagen">
                        <img class="cell_imagen" src="data:image/jpg;base64, <?php echo $movil['IMAGEN'];?>" alt="Imagen del Móvil">
                    </div>
                </div>
                <!-- Grid para los detalles textuales --> 
                <div class="grid_detalles" data-ram="<?php echo $movil['RAM'];?>" data-memoria="<?php echo $movil['MEMORIA'];?>" data-bateria="<?php echo $movil['BATERIA'];?>">
                    <!-- Zona de input del nombre --> 
                    <div class="grid_nombre">
                        <span class="cell_dato_cabecera"><strong>Nombre:</strong></span>
                        <span class="cell_dato_contenido"><span><?php echo $movil['NOMBRE']; ?></span></span>
                    </div>
                    <!-- Zona de input de la marca --> 
                    <div class="grid_marca">
                        <span class="cell_dato_cabecera"><strong>Marca:</strong></span>
                        <span class="cell_dato_contenido"><span><?php echo $movil['MARCA']; ?></span></span>
                    </div>
                    <!-- Zona de input de la fecha de salida --> 
                    <div class="grid_fecha">
                        <span class="cell_dato_cabecera"><strong>Fecha:</strong></span>
                        <span class="cell_dato_contenido"><span><?php echo date_format(date_create($movil['FECHA_SALIDA']),"d/m/y"); ?></span></span>
                    </div>
                    <!-- Zona de input del precio --> 
                    <div class="grid_precio">
                        <span class="cell_dato_cabecera"><strong>Precio:</strong></span>
                        <span class="cell_dato_contenido"><span><?php echo $movil['PRECIO']; ?></span></span>
                    </div>
                    <!-- Zona de selección del estado del móvil --> 
                    <div class="grid_estado">
                        <span class="cell_dato_cabecera"><strong>Estado:</strong></span>
                        <span class="cell_dato_contenido"><span><?php echo $movil['ESTADO']; ?></span></span>
                    </div>
                </div>
            </div>
            <!-- Fin de la zona de detalles -->
            <!-- Comienzo de la zona de descripción -->
            <div class="block_descripcion">
                <p>
                <?php
                    echo substr($movil['DESCRIPCION'], 0, 300);
                    if(strlen($movil['DESCRIPCION'])>300) echo '...';    
                ?>
                <a href="<?php echo $redireccion ?>">Leer más</a>
                </p>
                
            </div>
            <!-- Fin de la zona de descripción --> 
        </div>
    </div>
    <!-- Fin del bloque del móvil -->
<?php
}

/**
 Muestra un contenedor con la ID y nombre del móvil pasado por parámetro y una lista de sus 
 * solicitudes con la ID de la solicitud, su fecha, el nombre del usuario que lo solicita y el email
 * del mismo.
 * @param type $movil. Se trata del móvil que queremos mostrar. Esta variable debe tratarse del 
 *                     array correspondiente al móvil.
 */
function echoMovilSolicitudes($movil){
?>
    <!-- Comienzo del bloque del móvil (solicitudes)--> 
    <div class="container_movil" id="<?php echo $movil['ID'];?>">
        <div class="wrapper_movil">
            <!-- Comienzo de la zona de detalles (cabecera) -->
            <div class="grid_detalles_solicitud">
                <!-- Zona de input de la id del móvil -->
                <div class="grid_id_movil_solicitud">
                    <span class="cell_dato_cabecera"><strong>Móvil ID:</strong></span>
                    <span class="cell_dato_contenido"><span><?php echo $movil['ID'];?></span></span>
                </div>
                <!-- Zona de input del nombre del móvil --> 
                <div class="grid_nombre_movil_solicitud">
                    <span class="cell_dato_cabecera"><strong>Nombre:</strong></span>
                    <span class="cell_dato_contenido"><span><?php echo $movil['NOMBRE']; ?></span></span>
                </div>
            </div>
            <!-- Fin de la zona de detalles -->
            <!-- Comienzo de la zona de la lista de solicitudes -->
            <div class="block_solicitudes">
                <?php 
                $solicitudes = simplexml_load_file('../xml/solicitudes.xml');
                $usuarios = simplexml_load_file('../xml/usuarios.xml');
                if(!$solicitudes || !$usuarios){
                    return;
                }else{
                    ?>
                    <table>
                        <tr>
                            <th>Solicitud id</th>
                            <th>Usuario id</th>
                            <th>Nombre usuario</th>
                            <th>Fecha solicitud</th>
                        </tr>
                    <?php
                    foreach($solicitudes->solicitud as $solicitud){
                        if($movil['ID'] == (string)$solicitud->movil_id){
                            foreach($usuarios->usuario as $usuario){
                                if(((string) $usuario['id']) == ((string) $solicitud->usuario_id)){
                                    echo '<tr>';
                                        echo '<td>'.(string)$solicitud['id'].'</td>';
                                        echo '<td>'.(string)$usuario['id'].'</td>';
                                        echo '<td>'.(string)$usuario->nombre.'</td>';
                                        echo '<td>'.(string)$solicitud->fecha_solicitud.'</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                    ?>
                    </table>
                <?php
                }
                ?>
                <a href="../tienda/verMovil.php?id=<?php echo $movil['ID'];?>">Leer más</a>
            </div>
            <!-- Fin de la zona de descripción --> 
        </div>
    </div>
    <!-- Fin del bloque del móvil -->
<?php
}
?>
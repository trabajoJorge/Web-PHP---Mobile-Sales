<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
        include '../html/head.html';
        include '../dbConfig.php';
        ?>
        <title>ShareMovil - Modificar Móvil</title>
        <script type="text/javascript" src="../javascript/formVerificarMovil.js"></script>
    </head>

    <body>
        <?php 
        include '../php/header.php';
        
        $movil_id = $_GET['id'];
        if ($movil_id == '')
        {
            lanzarError("Algo salió mal al cargar el móvil", "../inicio.php"); //Esto para poder redirigir al principio.
        }
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "SELECT * FROM MOVILES
                   WHERE ID = $movil_id";
            $movil= mysqli_query($mysqli, $sql);
            $movil = mysqli_fetch_array($movil);
            mysqli_close($mysqli);
            if ($movil == FALSE || $movil['ID'] == NULL)
            {
                lanzarError("Algo salió mal al cargar el móvil", "../inicio.php"); //Esto para poder redirigir al principio.
            }
        } 
        
        //Preparo la fecha para mostrarla en el date picker:
        $fecha = substr($movil['FECHA_SALIDA'], 0, 10);
        ?>
        
        <h1 class="page_title">Modificar móvil</h1>
        
        <div class="wrapper_body">
            <!-- Comienzo del formulario para agregar móvil --> 
            <form class="movil_form" action="../php/formModificarMovil.php?id=<?php echo $movil['ID'];?>" method="post" enctype="multipart/form-data">
                <!-- Comienzo del bloque interno del formulario --> 
                <div class="container_movil">
                    <div class="wrapper_movil">
                        <!-- Comienzo de la zona de detalles (cabecera del formulario) -->
                        <div class="grid_cabecera">
                            <!-- Grid para el input de la imagen -->
                            <div class="grid_imagen" id="file_button">
                                <div class="container_imagen">
                                    <img class="cell_imagen" src="data:image/jpg;base64, <?php echo $movil['IMAGEN'];?>" alt="Imagen del Móvil">
                                </div>
                            </div>
                            <!-- Grid para los detalles textuales --> 
                            <div class="grid_detalles">
                                <!-- Zona de input del nombre --> 
                                <div class="grid_nombre">
                                    <span class="cell_dato_cabecera"><strong>Nombre:</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="nombre_input" id="nombre_input" value="<?php echo $movil['NOMBRE'] ?>"/>
                                </div>
                                <!-- Zona de input de la marca --> 
                                <div class="grid_marca">
                                    <span class="cell_dato_cabecera"><strong>Marca:</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="marca_input" id="marca_input" value="<?php echo $movil['MARCA'] ?>"/>
                                </div>
                                <!-- Zona de input de la fecha de salida --> 
                                <div class="grid_fecha">
                                    <span class="cell_dato_cabecera"><strong>Fecha:</strong></span>
                                    <input type="date" class="cell_dato_contenido" name="fecha_input" id="fecha_input" value="<?php echo $fecha?>"/><br>
                                </div>
                                <!-- Zona de input del precio --> 
                                <div class="grid_precio">
                                    <span class="cell_dato_cabecera"><strong>Precio (€):</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="precio_input" id="precio_input" value="<?php echo $movil['PRECIO'] ?>"/>
                                </div>
                                <!-- Zona de selección del estado del móvil --> 
                                <div class="grid_estado">
                                    <span class="cell_dato_cabecera"><strong>Estado:</strong></span>
                                    <select class="cell_dato_contenido" name="estado_select" id="estado_select">
                                        <option value="Nuevo" <?php if ($movil['ESTADO'] == 'Nuevo'){echo 'selected';} ?>>Nuevo</option>
                                        <option value="Segunda Mano"<?php if ($movil['ESTADO'] == 'Segunda Mano'){echo 'selected';} ?>>Segunda Mano</option>
                                        <option value="Reacondicionado"<?php if ($movil['ESTADO'] == 'Reacondicionado'){echo 'selected';} ?>>Reacondicionado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Fin de la zona de detalles --> 
                        <!-- Comienzo de la zona de especificaciones --> 
                        <div class="wrapper_lista_especificaciones">
                            <ul class="lista_especificaciones">
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Stock:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <select name="stock_select" id="stock_select">
                                                <option value="En Stock" <?php if ($movil['STOCK'] == 'En Stock'){echo 'selected';} ?>>En stock</option>
                                                <option value="Sin Stock"<?php if ($movil['STOCK'] == 'Sin Stock'){echo 'selected';} ?>>Sin stock</option>
                                                <option value="No Disponible"<?php if ($movil['STOCK'] == 'No Disponible'){echo 'selected';} ?>>No disponible</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block_cabecera_especificaciones">
                                        <h3>Especificaciones</h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Procesador:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="procesador_input" id="procesador_input" value="<?php echo $movil['PROCESADOR'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Memoria RAM (GB):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="ram_input" id="ram_input" required="" value="<?php echo $movil['RAM'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Memoria interna (GB):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="memoria_input" id="memoria_input" value="<?php echo $movil['MEMORIA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Cámara delantera (MP):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="camara_delantera_input" id="camara_delantera_input" value="<?php echo $movil['CAMARA_DELANTERA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Cámara trasera (MP):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="camara_trasera_input" id="camara_trasera_input" value="<?php echo $movil['CAMARA_TRASERA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Dimensión pantalla (pulgadas):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="dimension_input" id="dimension_input" value="<?php echo $movil['DIMENSIONES_PANTALLA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Resolución pantalla (píxeles):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="resolucion_input" id="resolucion_input" value="<?php echo $movil['RESOLUCION_PANTALLA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Batería (mAh):</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="bateria_input" id="bateria_input" value="<?php echo $movil['BATERIA'] ?>"/>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Fin de la zona de especificaciones -->
                        <!-- Comienzo de la zona de descripción -->
                        <div class="block_descripcion">
                            <h3>Descripción:</h3>
                            <textarea name="descripcion_input" id="descripcion_input" rows="10"/><?php echo $movil['DESCRIPCION'] ?></textarea><br>
                        </div>
                        <!-- Fin de la zona de descripción --> 
                    </div>
                </div>
                <!-- Fin del bloque interno del formulario --> 
                
                <!-- Comienzo de la zona de botones del formulario --> 
                <div class="block_buttons">
                    <input type="submit" name="submit_button" id="submit_button" value="Realizar cambios" onclick="return verificar_movil_agregado();"/>
                    <input type="reset" name="reset_button" id="reset_button" value="Reset"/>
                </div>
                <!-- Fin de la zona de botones del formulario --> 
            </form>
            <!-- Fin del formulario --> 
        </div>
        
        <?php
        include '../html/footer.html';
        ?>
    </body>
</html>
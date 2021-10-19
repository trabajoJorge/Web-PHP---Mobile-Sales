<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html' ?>
        <title>ShareMovil - Agregar Móvil</title>
        <script type="text/javascript" src="../javascript/formVerificarMovil.js"></script>
        <script type="text/javascript" src="../javascript/cambiarIcono.js"></script>
    </head>

    <body>
        <?php include '../php/header.php'; ?>
        
        <h1 class="page_title">Agregar movil</h1>
        
        <div class="wrapper_body">
            <!-- Comienzo del formulario para agregar móvil --> 
            <form class="movil_form" action="../php/formAgregarMovil.php" method="post" enctype="multipart/form-data" onReset="actualizarIcono();">
                <!-- Comienzo del bloque interno del formulario --> 
                <div class="container_movil">
                    <div class="wrapper_movil">
                        <!-- Comienzo de la zona de detalles (cabecera del formulario) -->
                        <div class="grid_cabecera">
                            <!-- Grid para el input de la imagen -->
                            <div class="grid_imagen" id="file_button">
                                <div class="container_imagen">
                                    <input class="imagen_input" name="imagen_input" id="imagen_input" type="file"  accept="image/*" onChange="actualizarIcono();">
                                </div>
                            </div>
                            <!-- Grid para los detalles textuales --> 
                            <div class="grid_detalles">
                                <!-- Zona de input del nombre --> 
                                <div class="grid_nombre">
                                    <span class="cell_dato_cabecera"><strong>Nombre:</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="nombre_input" id="nombre_input" placeholder="Huawei Mate 20p" required/>
                                </div>
                                <!-- Zona de input de la marca --> 
                                <div class="grid_marca">
                                    <span class="cell_dato_cabecera"><strong>Marca:</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="marca_input" id="marca_input" placeholder="Huawei" required/>
                                </div>
                                <!-- Zona de input de la fecha de salida --> 
                                <div class="grid_fecha">
                                    <span class="cell_dato_cabecera"><strong>Fecha:</strong></span>
                                    <input type="date" class="cell_dato_contenido" name="fecha_input" id="fecha_input"/><br>
                                </div>
                                <!-- Zona de input del precio --> 
                                <div class="grid_precio">
                                    <span class="cell_dato_cabecera"><strong>Precio:</strong></span>
                                    <input type="text" class="cell_dato_contenido" name="precio_input" id="precio_input" placeholder="240€" required/>
                                </div>
                                <!-- Zona de selección del estado del móvil --> 
                                <div class="grid_estado">
                                    <span class="cell_dato_cabecera"><strong>Estado:</strong></span>
                                    <select class="cell_dato_contenido" name="estado_select" id="estado_select">
                                        <option value="Nuevo">Nuevo</option>
                                        <option value="Segunda Mano">Segunda Mano</option>
                                        <option value="Reacondicionado">Reacondicionado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Fin de la zona de detalles --> 
                        <!-- Comienzo de la zona de especificaciones --> 
                        <div class="wrapper_lista_especificaciones">
                            <ul class="lista_especificaciones">
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
                                            <input type="text" name="procesador_input" id="procesador_input" placeholder="Kirin 710 Octa Core i7"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Memoria RAM:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="ram_input" id="ram_input" required="" placeholder="4GB"/><!--En GB-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Memoria interna:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="memoria_input" id="memoria_input" placeholder="64GB" required/><!--En GB-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Cámara delantera:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="camara_delantera_input" id="camara_delantera_input" placeholder="20mpx"/><!--En MP-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Cámara trasera:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="camara_trasera_input" id="camara_trasera_input" placeholder="20mpx" required/><!--En MP-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Dimensión pantalla:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="dimension_input" id="dimension_input" placeholder="6,4&quot" required/><!--En cm-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Resolución pantalla:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="resolucion_input" id="resolucion_input" placeholder="2400x1080" required/><!--En pixels x pixels-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_spec">
                                        <div class="cell_dato_cabecera">
                                            <strong>Batería:</strong>
                                        </div>
                                        <div class="cell_dato_contenido">
                                            <input type="text" name="bateria_input" id="bateria_input" placeholder="5000mAh"/><!--En mAh-->
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Fin de la zona de especificaciones -->
                        <!-- Comienzo de la zona de descripción -->
                        <div class="block_descripcion">
                            <h3>Descripción:</h3>
                            <textarea name="descripcion_input" id="descripcion_input" rows="10" placeholder="Es un movil"></textarea><br>
                        </div>
                        <!-- Fin de la zona de descripción --> 
                    </div>
                </div>
                <!-- Fin del bloque interno del formulario --> 
                
                <!-- Comienzo de la zona de botones del formulario --> 
                <div class="block_buttons">
                    <input type="submit" name="submit_button" id="submit_button" value="Subir" onclick="return verificar_movil_agregado();"/>
                    <input type="reset" name="reset_button" id="reset_button" value="Reset""/>
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
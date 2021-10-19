<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
        include '../html/head.html';
        include '../dbConfig.php';
        include_once '../php/utils.php';
        ?>
        <title>ShareMovil - Visualizar móvil</title>
        <script type="text/javascript" src="../ajax/getComentario.js"></script>
    </head>

    <body>
        <?php
        include '../php/header.php';

        $movil_id = $_GET['id'];

        if ($movil_id == '') {
            lanzarError("Algo salió mal al cargar el móvil", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }
        $mysqli = mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli) {
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        } else {
            mysqli_set_charset($mysqli, "UTF8");
            $sql = "SELECT * FROM MOVILES
                       WHERE ID = $movil_id";
            $movil = mysqli_query($mysqli, $sql);
            $movil = mysqli_fetch_array($movil);
            mysqli_close($mysqli);
            if ($movil == FALSE || $movil['ID'] == NULL) {
                lanzarError("Algo salió mal al cargar el móvil", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
            }
        }
        ?>

        <h1 class="page_title">Visualizar móvil</h1>

        <?php
        if (isset($_SESSION['vendedor'])) {
            ?>
            <div class="container_modificar_button">
                <div class="wrapper_modificar_button">
                    <input type="button" name="modificar_button" id="modificar_button" value="Modificar móvil" onclick="document.location.href = '../tienda/modificarMovil.php?id=<?php echo $movil_id ?>'"/>
                </div>
            </div>
            <?php
        } else if ($movil['STOCK'] == 'Sin Stock' && isset($_SESSION['user'])) {
            ?>
            <div class="container_modificar_button">
                <div>
                    Este móvil no está actualmente en la tienda. ¿Desea solicitarlo?
                </div>
                <br>
                <div class="wrapper_modificar_button">
                    <input type="button" name="solicitar" id="solicitar" value="Solicitar móvil" onclick="document.location.href = '../php/formCrearSolicitud.php?m_id=<?php echo $movil_id ?>'"/>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="wrapper_body">
            <!-- Comienzo del bloque del móvil --> 
            <div class="container_movil">
                <div class="wrapper_movil">
                    <!-- Comienzo de la zona de detalles (cabecera del formulario) -->
                    <div class="grid_cabecera">
                        <!-- Grid para el input de la imagen -->
                        <div class="grid_imagen">
                            <div class="container_imagen">
                                <img class="cell_imagen" src="data:image/jpg;base64, <?php echo $movil['IMAGEN']; ?>" alt="Imagen del Móvil">
                            </div>
                        </div>
                        <!-- Grid para los detalles textuales -->
                        <div class="grid_detalles">
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
                                <span class="cell_dato_contenido"><span><?php echo date_format(date_create($movil['FECHA_SALIDA']), "d/m/y"); ?></span></span>
                            </div>
                            <!-- Zona de input del precio --> 
                            <div class="grid_precio">
                                <span class="cell_dato_cabecera"><strong>Precio:</strong></span>
                                <span class="cell_dato_contenido"><span><?php echo $movil['PRECIO']; ?>€</span></span>
                            </div>
                            <!-- Zona de selección del estado del móvil --> 
                            <div class="grid_estado">
                                <span class="cell_dato_cabecera"><strong>Estado:</strong></span>
                                <span class="cell_dato_contenido"><span><?php echo $movil['ESTADO']; ?></span></span>
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
                                        <span><?php echo $movil['STOCK']; ?></span>
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
                                        <span><?php echo $movil['PROCESADOR']; ?></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Memoria RAM:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['RAM']; ?>GB</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Memoria interna:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['MEMORIA']; ?>GB</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Cámara delantera:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['CAMARA_DELANTERA']; ?>MP</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Cámara trasera:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['CAMARA_TRASERA']; ?>MP</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Dimensión pantalla:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['DIMENSIONES_PANTALLA']; ?> pugadas</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Resolución pantalla:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['RESOLUCION_PANTALLA']; ?> píxeles</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grid_spec">
                                    <div class="cell_dato_cabecera">
                                        <strong>Batería:</strong>
                                    </div>
                                    <div class="cell_dato_contenido">
                                        <span><?php echo $movil['BATERIA']; ?>mAh</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Fin de la zona de especificaciones -->
                    <!-- Comienzo de la zona de descripción -->
                    <div class="block_descripcion">
                        <h3>Descripción:</h3>
                        <p>
                            <?php echo $movil['DESCRIPCION']; ?>
                        </p>
                    </div>
                    <!-- Fin de la zona de descripción --> 
                </div>
            </div>
            <!-- Fin del bloque del móvil -->

            <hr>

            <!--Comprobamos que sean usuarios registrados-->
            <?php if (isset($_SESSION["user"]) && !isset($_SESSION['vendedor'])) {
                ?>
                <h3>Añadir comentario</h3>
                <!--Comienzo de la zona de los comentarios-->
                <div class="container_comentario_form">
                    <!-- Comienzo del formulario de agregar comentario -->
                    <form action="../php/formCrearComentario.php?m_id=<?php echo $movil_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="wrapper_comentario_textarea">
                            <textarea name="comentario_input" id="comentario_input" rows="10" placeholder="Añade tu comentario..."></textarea>    
                        </div>
                        <input type="submit" value="Enviar comentario">
                    </form>
                    <!-- Fin de la zona de agregar comentario -->
                </div>

                <hr>
                <?php
            }
            ?>
            <!--Aunque no sea usuario, puede leer comentarios-->
            <h3>Comentarios</h3>
            <ul class="comentarios_list">
                <?php
                $comentarios = simplexml_load_file('../xml/comentarios.xml');
                if (isset($comentarios)) {
                    foreach ($comentarios->comentario as $comentario) {
                        if ($comentario->movil_id == $movil_id) {
                            $usuarios = simplexml_load_file('../xml/usuarios.xml');
                            if (isset($usuarios)) {
                                foreach ($usuarios->usuario as $usuario) {
                                    if ((string) $usuario['id'] == $comentario->usuario_id) {
                                        ?>
                                        <li>
                                            <div class="comentario_contenedor" id="<?php echo (string) $comentario['id'] ?>">
                                                <div class="comentario_wrapper">
                                                    <!--Cabecera del comentario-->
                                                    <div class="cabecera_comentario">
                                                        <ul>
                                                            <li>
                                                                <strong>
                                                                    <?php
                                                                    echo (string) $usuario->nombre;
                                                                    ?>
                                                                </strong>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo (string) $usuario->email;
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo (string) $comentario->fecha_publicado;
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!--Cuerpo del comentario-->
                                                    <div class="cuerpo_comentario">
                                                        <p>
                                                            <?php
                                                            $descripcion = $comentario->descripcion;
                                                            echo substr($descripcion, 0, 200);
                                                            if (strlen($descripcion) > 201) {
                                                                ?>
                                                                ... 
                                                                <input type="button" id="ver_comentario" onClick="getComentario('<?php echo $comentario['id']?>')" value="Leer más"/>
                                                            <?php } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <!-- Fin del wrapper del body -->

        <?php
        include '../html/footer.html';
        ?>
    </body>
</html>


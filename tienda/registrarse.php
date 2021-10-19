<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html' ?>
        <script src="../javascript/formRegistrarse.js"></script>
        <title>ShareMovil - Registro</title>
    </head>

    <body>
        <?php
        include '../php/header.php';
        ?>
        <h1 class="page_title">Registrarse</h1>
        
        <div class="wrapper_body">
            <div class="container_registro">
                <div class="wrapper_registro">
                    <form class="form_registro" id="form_registro" name="form_registro" action="../php/formRegistrarse.php" method="post" enctype="multipart/form-data">
                    <ul class="lista_datos_registro">
                        <li>
                            <div class="grid_dato_registro">
                                <div class="cell_dato_cabecera_registro"><strong>Nombre:</strong></div>
                                <div class="cell_dato_contenido_registro">
                                    <input type="text" name="nombre_input" id="nombre_input">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="grid_dato_registro">
                                <div class="cell_dato_cabecera_registro"><strong>Email:</strong></div>
                                <div class="cell_dato_contenido_registro">
                                    <input type="text" name="email_input" id="email_input">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="grid_dato_registro">
                                <div class="cell_dato_cabecera_registro"><strong>Password:</strong></div>
                                <div class="cell_dato_contenido_registro">
                                    <input type="password" name="password_input" id="password_input">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="grid_dato_registro">
                                <div class="cell_dato_cabecera_registro"><strong>Repetir password:</strong></div>
                                <div class="cell_dato_contenido_registro">
                                    <input type="password" name="repassword_input" id="repassword_input">
                                </div>
                            </div>
                            
                        </li>
                        <li>
                            <div class="registro_button">
                                <input type="submit" value="Registrarse" name="submit_input" id="submit_input" onclick="return verificar_registro();"/><br><br>
                            </div>
                        </li>
                    </ul>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include '../html/footer.html';
        ?>
    </body>
</html>


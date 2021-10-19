<?php
    session_start();
    
    include_once '../php/utils.php';
    
    if (isset($_SESSION['user'])){
        lanzarAlerta("¡Ya estás logueado, ".$_SESSION['user']."!", "../tienda/inicio.php");
    }else{
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html'?>
        <title>ShareMovil - Ingresar</title>
        <script type="text/javascript" src="../javascript/formRealizarLogin.js"></script>
    </head>
    
    <body>
        <?php include '../php/header.php' ?>
        
        <h1 class="page_title">Ingresar</h1>
        
        <div class="wrapper_body">
            <div>
                <div>
                    <form id="form_login" name="form_login" action="../php/formRealizarLogin.php" method= "post" enctype="multipart/form-data">
                        <div class="form_login_wrapper">
                            <ul class="lista_login">
                                <li>
                                    <div class="grid_login">
                                        <span class="cell_login_cabecera"><strong>User:</strong></span>
                                        <span class="cell_login_contenido"><input type="text" name="user_input" id="user_input"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid_login">
                                        <span class="cell_login_cabecera"><strong>Password:</strong></span>
                                        <span class="cell_login_contenido"><input type="password" name="password_input" id="password_input"><br></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="cell_login_input">
                                        <input type="submit" name= "submit" value="¡Vamos!" onclick="return verificar_login();"/>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <?php include '../html/footer.html' ?>
</html>

<?php
    }
?>
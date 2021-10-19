<?php
/**
 * Este PHP se encarga de verificar los datos del formulario de login.php y ver si existe
 * un usuario o vendedor con los datos proporcionados. Si existe un usuario o contraseña con esos
 * datos, abre sesión. 
 */

session_start();
include_once '../php/utils.php';

//Comprueba que el usuario no esté ya con la sesión abierta.
if (isset($_SESSION["user"])) {
    lanzarAlerta("Ya has iniciado sesión", "../tienda/inicio.php");
} else {
    //Comprueba si los datos ingresados son de un vendedor.
    if (!$vendedores = simplexml_load_file("../xml/vendedor.xml")) {
        lanzarAlerta("Algo salio mal al cargar la lista de vendedores", "../tienda/login.php");
    } else {
        if (isset($_POST["user_input"]) && isset($_POST["password_input"])) {
            $user = $_POST["user_input"];
            $pass = $_POST["password_input"];
            foreach ($vendedores as $vendedor) {
                if ($vendedor["user"] == $user && $vendedor["pass"] == $pass) {
                    $_SESSION['user'] = $user;
                    $_SESSION['vendedor'] = true;
                    lanzarAlerta("Modo admininistrador/vendedor: ¡Bienvenido ".$user."!", "../tienda/inicio.php");
                }
            }
        }
    }

    //Comprueba si los datos ingresados son de un usuario.
    if (!$usuarios = simplexml_load_file("../xml/usuarios.xml")) {
        lanzarAlerta("Algo salio mal al cargar la lista de usuarios", "../tienda/login.php");
    } else {
        if (isset($_POST["user_input"]) && isset($_POST["password_input"])) {
            $user = $_POST["user_input"];
            $pass = $_POST["password_input"];
            foreach ($usuarios as $usuario) {
                if ($usuario->nombre == $user && $usuario->password == $pass) {
                    $_SESSION['id'] = (string) $usuario['id'];
                    $_SESSION['user'] = $user;
                    lanzarAlerta("¡Bienvenido ".$user."!", "../tienda/inicio.php");
                }
            }
        }
    }
    
    lanzarError("Problemas a la hora de ingresar", "../tienda/inicio.php");
}
?>

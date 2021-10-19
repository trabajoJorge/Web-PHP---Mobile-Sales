<?php
/**
 * Pequeñas utilidades necesarias en el desarrollo de la web. Aquí se encuentran
 * funciones para lanzar alertas generales y lanzar errores (los dos últimos con redirección).
 */

/**
 * Lanza una alerta dado un mensaje sin redireccionar a ningún sitio.
 * 
 * @param string $mensaje El mensaje de alerta a lanzar.
 */
function lanzarAlertaNoRedirect($mensaje){
    echo "<script>
            alert('".$mensaje."');
         </script>";
}

/**
 * Lanza una alerta dado un mensaje y redirecciona a otra página del servidor web.
 * 
 * @param string $mensaje El mensaje de alerta a lanzar.
 * @param string $redireccion La página del servidor web a la que se va a redireccionar.
 */
function lanzarAlerta($mensaje, $redireccion){
    echo "<script>
            alert('".$mensaje."');
            document.location.href='".$redireccion."';
         </script>";
}

/**
 * Lanza un mensaje de error dado y redirecciona a otra página del servidor web.
 * Si javascript ha sido desactivado en el navegador, simplemente termina con la
 * ejecución.
 * 
 * @param string $error El mensaje de error a lanzar.
 * @param string $redireccion La página del servidor web a la que se va a redireccionar.
 */
function lanzarError($error, $redireccion){
    lanzarAlerta("Error: $error", $redireccion);
    exit($error);
}

?>
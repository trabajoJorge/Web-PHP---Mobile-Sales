<?php
/**
 * Este PHP simplemente destruye la sesión del usuario registrado o vendedor cuando
 * pulsa logout.
 */

    include_once '../php/utils.php';
    
    session_start();
    session_destroy();
    
    lanzarAlerta("Gracias por tu visita. ¡Hasta la próxima!", '../tienda/inicio.php');
?>
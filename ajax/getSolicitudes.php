<?php
/**
 * Este PHP se encarga de devolver el bloque de visualización de las solicitudes de
 * un móvil determinado según un criterio de búsqueda. Se utiliza para tratar la solicitud
 * AJAX de verSolicitudes.php
 */


include '../php/echoMovil.php';
include '../dbConfig.php';
include_once '../php/utils.php';

$mysqli= mysqli_connect($server, $user, $pass, $db);
if (!$mysqli){
    lanzarAlertaNoRedirect('Problemas al abrir la base de datos');
}else{
    $busqueda = $_POST['query'];
    $atributo = $_POST['attribute'];
    
    mysqli_set_charset($mysqli, "UTF8");
    $sql= "SELECT * FROM `MOVILES` WHERE `".$atributo."`='".$busqueda."'";
    $result = mysqli_query($mysqli, $sql);
    while( $row = mysqli_fetch_array($result) ){
        echoMovilSolicitudes($row);
        echo '<hr>';
    }
    mysqli_close($mysqli);
}
?>

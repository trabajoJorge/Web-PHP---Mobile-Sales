<?php
/**
 * Este PHP se encarga de devolver el bloque de visualización de un móvil determinado
 * según un criterio de búsqueda. Se utiliza para tratar las solicitudes AJAX de
 * buscador.php
 */

include '../php/echoMovil.php';
include '../dbConfig.php';
include '../php/utils.php';

$mysqli= mysqli_connect($server, $user, $pass, $db);
if (!$mysqli){
    lanzarAlertaNoRedirect("Problemas al abrir la base de datos");
}else{
    $busqueda = $_POST['query'];
    $atributo = $_POST['attribute'];
    $stock = $_POST['stock'];
    
    mysqli_set_charset($mysqli, "UTF8");
    $sql= "SELECT * FROM `MOVILES` WHERE `".$atributo."`='".$busqueda."' AND `STOCK`='".$stock."'";
    $result = mysqli_query($mysqli, $sql);
    while( $row = mysqli_fetch_array($result) ){
        echoMovilReducido($row, "../tienda/verMovil.php?id=".$row['ID']);
        echo '<hr id="'.$row['ID'].'">';
    }
    mysqli_close($mysqli);
}
?>

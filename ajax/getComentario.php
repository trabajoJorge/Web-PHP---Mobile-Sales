<?php
/**
 * Este PHP se encarga de devolver la descripción de un comentario determinado
 * según su id. Se utiliza para tratar la solicitud AJAX de los comentarios
 * de verMovil.php
 */

$id = $_POST['id'];

$comentarios = simplexml_load_file('../xml/comentarios.xml');
if (isset($comentarios)) {
    foreach ($comentarios->comentario as $comentario) {
        if($id == (string) $comentario['id']){
            echo (string) $comentario->descripcion;
        }
    }
}


?>
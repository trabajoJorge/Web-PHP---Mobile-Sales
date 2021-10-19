<?php
/**
 * Este PHP se encarga de guardar el comentario del formulario de verMovil.php.
 * Sólo guarda el comentario si no está vacío.
 */

session_start();
include_once '../php/utils.php';

//Comprobamos que el comentario no está vacío.
if (isset($_POST['comentario_input'])){
    //Guardamos los datos necesarios en variables.
    $comentario_input = $_POST['comentario_input'];
    $id_movil = $_GET['m_id'];
    $id_user = $_SESSION['id'];
    $fecha_actual = getdate();
    
    $fecha = $fecha_actual['mday'].'-'. $fecha_actual['mon'] .'-'.$fecha_actual['year'];
    
    //Abrimos comentarios.xml y creamos el nuevo comentario.
    $comentarios = simplexml_load_file('../xml/comentarios.xml');
    $comentario = $comentarios->addChild('comentario');
    $comentario->addChild('movil_id', $id_movil);
    $comentario->addChild('usuario_id', $id_user);
    $comentario->addChild('fecha_publicado', $fecha);
    $comentario->addChild('descripcion', $comentario_input);
    
    $ult_id = $comentarios['ult_id'];
    $id_number = substr($ult_id,2) + 1;
    $id_nuevo = 'c_'.$id_number;
    $comentario->addAttribute('id', $id_nuevo);
    $comentarios['ult_id'] = $id_nuevo;
    
    $comentarios-> asXML("../xml/comentarios.xml");
            
   /*
    * Avisamos que el comentario se ha guardado correctamente y redirigimos a la misma página en la
    *que estaba el usuario.
    */
    lanzarAlerta("Comentario guardado correctamente", "../tienda/verMovil.php?id=$id_movil");
    
}else{
    lanzarError('Error al cargar el dato del comentario', '../tienda/inicio.php');
}
?>
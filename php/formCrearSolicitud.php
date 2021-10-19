<?php
/**
 * Este PHP se encarga de guardar la solicitud enviada desde verMovil.php.
 */

session_start();
include_once '../php/utils.php';

//Guardamos en variables los datos ecesarios para la solicitud.
$id_movil = $_GET['m_id'];
$id_user = $_SESSION['id'];
$fecha_actual = getdate();

$fecha = $fecha_actual['mday'].'-'. $fecha_actual['mon'] .'-'.$fecha_actual['year'];

//Abrimos solicitudes.xml y creamos la nueva solicitud.
$solicitudes = simplexml_load_file('../xml/solicitudes.xml');
$solicitud = $solicitudes->addChild('solicitud');
$solicitud->addChild('movil_id', $id_movil);
$solicitud->addChild('usuario_id', $id_user);
$solicitud->addChild('fecha_solicitud', $fecha);

$ult_id = $solicitudes['ult_id'];
$id_number = substr($ult_id,2) + 1;
$id_nuevo = 's_'.$id_number;
$solicitud->addAttribute('id', $id_nuevo);
$solicitudes['ult_id'] = $id_nuevo;

$solicitudes-> asXML("../xml/solicitudes.xml");

/*
* Avisamos que la solicitud se ha guardado correctamente y redirigimos a la misma página en la
*que estaba el usuario.
*/
lanzarAlerta("Solicitud guardado correctamente", "../tienda/verMovil.php?id=$id_movil");

?>
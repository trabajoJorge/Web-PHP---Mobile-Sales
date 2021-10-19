<?php
/* 
 * Este PHP contiene funciones utilizadas para verificar el formulario de agregarMovil.php. 
 * Se dejan cuatro funciones:
 * - esNumeroVálido, que verifica que el valor pasado como parámetro sea un número
 * positivo.
 * - verificarFecha, que verifica que el valor pasado como parámetro sea una fecha 
 * válida.
 * - verificarDetalleNumerico, que verifica que el valor pasado como parámetro sea un número
 * válido y no esté vacío.
 * - verificarResolucion, que verifica que el valor pasado como parámetro un String con formato
 * númeroxnúmero, donde número tenga entre 2 y 4 dígitos y no esté vacío.
 */

include_once '../php/utils.php';
//Añadimos las funciones que hemos diseñado para realizar las verificaciones
function esNumeroValido($numero){
    return is_numeric($numero) && ($numero > 0);
}

function verificarFecha($fecha)
{
    if(empty($fecha)){
        return false;
    }
    $valores = explode('-', $fecha);
    return (checkdate($valores[1], $valores[2], $valores[0]));
}

function verificarDetalleNumerico($spec){
    return (!empty($spec) && esNumeroValido($spec));
}

function verificarResolucion($res)
{
    if (empty($res)){
        return false;
    }
    $valores = explode('x', $res);
    return (count($valores) == 2 && 
            is_numeric($valores[0]) && 
            is_numeric($valores[1]) && 
            strlen($valores[0])>= 2 && 
            strlen($valores[0])<= 4 && 
            strlen($valores[1])>= 2 && 
            strlen($valores[1])<= 4);
}

/*
 * A continuación, verificamos todos los valores de los campos del formulario de agregarMovil.php.
 */
/*----------------------------------------------------------------------------*/
    $n="nombre_input";
    if(!empty($_POST[$n])){
        $nombre= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="marca_input";
    if(!empty($_POST[$n])){
        $marca= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="fecha_input"; 
    if(verificarFecha($_POST[$n])){
        $fecha_salida= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/    
    $n="precio_input";
    if(verificarDetalleNumerico($_POST[$n])){
        $precio= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/    
    $n="estado_select";
    if(!empty($_POST[$n])){
        $estado= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    } 
/*----------------------------------------------------------------------------*/
    $n="procesador_input"; 
    if (empty($_POST[$n])) {
        $procesador = '';
    } else {
        $procesador = $_POST[$n];
    }
/*----------------------------------------------------------------------------*/
    $n="ram_input"; 
    if(verificarDetalleNumerico($_POST[$n])){
        $ram= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="memoria_input"; 
    if(verificarDetalleNumerico($_POST[$n])){
        $memoria= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="camara_delantera_input"; 
    if (empty($_POST[$n])) {
        $camara_delantera = '';
    } else {
        $camara_delantera = $_POST[$n];
    }
/*----------------------------------------------------------------------------*/   
    $n="camara_trasera_input";
    if(verificarDetalleNumerico($_POST[$n])){
        $camara_trasera= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="dimension_input";
    if(verificarDetalleNumerico($_POST[$n])){
        $dimensiones_pantalla= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }
/*----------------------------------------------------------------------------*/
    $n="resolucion_input";
    if(verificarResolucion($_POST[$n])){
        $resolucion_pantalla= $_POST[$n];
    }else{
        lanzarError("Error al cargar el dato de: $n","../tienda/inicio.php");
    }

/*----------------------------------------------------------------------------*/
    $n="bateria_input";
    if (empty($_POST[$n])) {
        $bateria = '';
    } else {
        $bateria = $_POST[$n];
    }    
/*----------------------------------------------------------------------------*/
    $n="descripcion_input";
    if (empty($_POST[$n])) {
        $descripcion = '';
    } else {
        $descripcion= $_POST[$n];
    }
/*----------------------------------------------------------------------------*/    
    if($_FILES==null && $_REQUEST==null){
        $imagen = '';
    } else {
        $file = $_FILES["imagen_input"]["tmp_name"];
        if(!empty($file)){
            /*Warning: file_get_contents(): Filename cannot be empty in /opt/lampp/htdocs/PG3-SAR/php/GuardarMovil.php on line 118*/
            $input = file_get_contents(addslashes($_FILES['imagen_input']['tmp_name']));
            $imagen = base64_encode($input);
        }
    }
    
/**
 * Una vez verificado todos los datos, abrimos la base de datos y guardamos el nuevo móvil.
 */
/*----------------------------------------------------------------------------*/    
    include '../dbConfig.php';
    $mysqli= mysqli_connect($server, $user, $pass, $db);
    if (!$mysqli){
        lanzarError("Error de conexión a la base de datos, llama al administrador", "../tienda/inicio.php");
    }
    else{
        mysqli_set_charset($mysqli, "UTF8");
        //Valores que no me mandan y necesito
        $stock= "En Stock";
        $sql= "INSERT INTO MOVILES (NOMBRE, MARCA, PRECIO, ESTADO, STOCK, IMAGEN, FECHA_SALIDA, PROCESADOR, RAM, MEMORIA, BATERIA, CAMARA_DELANTERA, CAMARA_TRASERA, DIMENSIONES_PANTALLA, RESOLUCION_PANTALLA, DESCRIPCION) 
               VALUES('".$nombre."', '".$marca."', '".$precio."', '".$estado."', '".$stock."', '".$imagen."', '".$fecha_salida."', '".$procesador."', '".$ram."', '".$memoria."', '".$bateria."', '".$camara_delantera."', '".$camara_trasera."', '".$dimensiones_pantalla."', '".$resolucion_pantalla."', '".$descripcion."')";
        
        if (mysqli_query($mysqli, $sql)){
            lanzarAlerta("Móvil introducido correctamente","../tienda/inicio.php");
        } else {
            echo $sql;
            lanzarError("Error al introducir el móvil a la base de datos, inténtelo de nuevo.","../tienda/inicio.php");
        }
    }
?>


<?php
/** 
 * Este PHP contiene funciones utilizadas para verificar el formulario de modificarMovil.php. 
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
    $stock = $_POST['stock_select'];
    
    
/*
 * Una vez verificados los datos, empezamos a mirar si ha habido alguna modificación en la
 * información del móvil. Si es así, actualizamos la información del móvil en la base de datos.
 */
/*----------------------------------------------------------------------------*/    
include_once '../dbConfig.php';
    $movil_id = $_GET['id'];    
    if ($movil_id == '')
    {
        lanzarError("Algo salió mal al cargar el móvil", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
    }
    $mysqli= mysqli_connect($server, $user, $pass, $db);
    if (!$mysqli){
        lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
    }else{
        mysqli_set_charset($mysqli, "UTF8");
        $sql= "SELECT * FROM MOVILES
               WHERE ID = $movil_id";
        $movil= mysqli_query($mysqli, $sql);
        $movil = mysqli_fetch_array($movil);
        mysqli_close($mysqli);
        if ($movil == FALSE || $movil['ID'] == NULL)
        {
            lanzarError("Algo salió mal al cargar el móvil", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }
    }
    
    if($nombre != $movil['NOMBRE']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET NOMBRE = $nombre
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($marca != $movil['MARCA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET MARCA = $marca
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($precio != $movil['PRECIO']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET PRECIO = $precio
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($fecha_salida != $movil['FECHA_SALIDA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET FECHA_SALIDA = $fecha_salida
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($estado != $movil['ESTADO']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE `MOVILES`
                   SET `ESTADO` = '$estado'
                   WHERE `MOVILES`.`ID` = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($stock != $movil['STOCK']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET STOCK = $stock
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($procesador != $movil['PROCESADOR']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET PROCESADOR = $procesador
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($ram != $movil['RAM']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET RAM = $ram
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($memoria != $movil['MEMORIA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET MEMORIA = $memoria
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($camara_delantera != $movil['CAMARA_DELANTERA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET CAMARA_DELANTERA = $camara_delantera
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($camara_trasera != $movil['CAMARA_TRASERA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET CAMARA_TRASERA = $camara_trasera
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($dimensiones_pantalla != $movil['DIMENSIONES_PANTALLA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET DIMENSIONES_PANTALLA = $dimensiones_pantalla
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($resolucion_pantalla != $movil['RESOLUCION_PANTALLA']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET RESOLUCION_PANTALLA = $resolucion_pantalla
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    if($descripcion != $movil['DESCRIPCION']){
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError("Algo salió mal al acceder a la base de datos", "../tienda/inicio.php"); //Esto para poder redirigir al principio.
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "UPDATE MOVILES
                   SET DESCRIPCION = $descripcion
                   WHERE ID = $movil_id";
            if(mysqli_query($mysqli, $sql)){
                echo 'Estado modificado';
            }
            mysqli_close($mysqli);
        }
    }
    
    lanzarAlerta('Móvil actualizado correctamente', '../tienda/inicio.php')
    
?>

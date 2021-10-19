<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html'; 
              include '../dbConfig.php'; 
              include '../php/echoMovil.php';
              include_once '../php/utils.php';
              ?>
        
        <title>ShareMovil - Ver recomendaciones</title>
    </head>
    
    <body>
        <?php include '../php/header.php';
            $mysqli= mysqli_connect($server, $user, $pass, $db);
            if (!$mysqli){
                lanzarError('Problemas al abrir la base de datos', '../tienda/inicio.php');
            }else{
                mysqli_set_charset($mysqli, "UTF8");
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE RAM = ( SELECT MAX(RAM) FROM MOVILES )";
                $ram= mysqli_query($mysqli, $sql);
                $ram = mysqli_fetch_array($ram);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE MEMORIA = ( SELECT MAX(MEMORIA) FROM MOVILES )";
                $almacenamiento = mysqli_query($mysqli, $sql);
                $almacenamiento = mysqli_fetch_array($almacenamiento);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE BATERIA = ( SELECT MAX(BATERIA) FROM MOVILES )";
                $bateria = mysqli_query($mysqli, $sql);
                $bateria = mysqli_fetch_array($bateria);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE PRECIO = ( SELECT MIN(PRECIO) FROM MOVILES )";
                $precio = mysqli_query($mysqli, $sql);
                $precio = mysqli_fetch_array($precio);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN IMAGEN FROM MOVILES
                       WHERE CAMARA_TRASERA = ( SELECT MAX(CAMARA_TRASERA) FROM MOVILES )";
                $camara = mysqli_query($mysqli, $sql);
                $camara = mysqli_fetch_array($camara);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE DIMENSIONES_PANTALLA = ( SELECT MAX(DIMENSIONES_PANTALLA) FROM MOVILES )";
                $pantalla = mysqli_query($mysqli, $sql);
                $pantalla = mysqli_fetch_array($pantalla);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                       WHERE FECHA_SALIDA = ( SELECT MAX(FECHA_SALIDA) FROM MOVILES )";
                $fecha = mysqli_query($mysqli, $sql);
                $fecha = mysqli_fetch_array($fecha);
                
                $sql= "SELECT ID, NOMBRE, PRECIO, MARCA, FECHA_SALIDA, ESTADO, DESCRIPCION, IMAGEN FROM MOVILES
                        ORDER BY RAND()
                        LIMIT 1;";
                $recom_dia = mysqli_query($mysqli, $sql);
                $recom_dia = mysqli_fetch_array($recom_dia);
                
                mysqli_close($mysqli);
            }
        ?>
        
        <h1 class="page_title">Mejores móviles</h1>
        
        <div class="wrapper_body">
            <h2 class="recomendacion_cabecera">Mejor almacenamiento</h2>
            <?php echoMovilReducido($almacenamiento, "../tienda/verMovil.php?id=".$almacenamiento['ID'])?>

            <br><hr><br>

            <h2 class="recomendacion_cabecera">Mejor RAM</h2>
            <?php echoMovilReducido($ram, "../tienda/verMovil.php?id=".$ram['ID'])?>

            <br><hr><br>
            
            <h2 class="recomendacion_cabecera">Mejor batería</h2>
            <?php echoMovilReducido($bateria, "../tienda/verMovil.php?id=".$bateria['ID'])?>

            <br><hr><br>
            
            <h2 class="recomendacion_cabecera">Más económico</h2>
            <?php echoMovilReducido($precio, "../tienda/verMovil.php?id=".$precio['ID'])?>
            
            <br><hr><br>
            
            <h2 class="recomendacion_cabecera">Mejor cámara</h2>
            <?php echoMovilReducido($camara, "../tienda/verMovil.php?id=".$camara['ID'])?>
            
            <br><hr><br>

            <h2 class="recomendacion_cabecera">Mayor pantalla</h2>
            <?php echoMovilReducido($pantalla, "../tienda/verMovil.php?id=".$pantalla['ID'])?>
            
            <br><hr><br>
            
            <h2 class="recomendacion_cabecera">Más nuevo</h2>
            <?php echoMovilReducido($fecha, "../tienda/verMovil.php?id=".$fecha['ID'])?>
            
            <br><hr><br>
            
            <h2 class="recomendacion_cabecera">Recomendación aleatoria</h2>
            <?php echoMovilReducido($recom_dia, "../tienda/verMovil.php?id=".$recom_dia['ID'])?>
            
            <br><hr><br>
        </div>
    
        <?php
            include '../html/footer.html';
        ?>
    
    </body>
</html>

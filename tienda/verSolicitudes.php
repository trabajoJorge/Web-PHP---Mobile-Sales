<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
        include '../html/head.html';
        include_once '../php/utils.php';
        include '../dbConfig.php';
        include '../php/echoMovil.php';
        ?>
        <title>ShareMovil - Ver Solicitudes</title>
        <script type="text/javascript" src="../ajax/getSolicitudes.js"></script>
    </head>

    <body>
        <?php include '../php/header.php'; ?>

        <?php 
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError('Problemas al abrir la base de datos', '../tienda/inicio.php');
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "SELECT * FROM `MOVILES` WHERE 'STOCK' = 'Sin Stock'";
            $result= mysqli_query($mysqli, $sql);
            mysqli_close($mysqli);
        }
        ?>

        <h1 class="page_title">Ver solicitudes</h1>

        <div class="buscador_container">
            <div class="buscador_wrapper">
                <div class="buscador_grid">
                    <div class="buscador_cell_input">
                        <input type="text" name="buscar_input" id="buscar_input">
                    </div>
                    <div class="buscador_cell_select">
                        <select name="buscador_select" id="buscador_select">
                            <option value="Id">Id</option>
                            <option value="Nombre">Nombre</option>
                            <option value="Marca">Marca</option>
                        </select>
                    </div>    
                    <div class="buscador_cell_button">
                        <input type="button" name="buscar_button" id ="buscar_button" value="Buscar" onclick="return getSolicitudes();">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="wrapper_body">
        <?php
            $solicitudes = simplexml_load_file('../xml/solicitudes.xml');
            $usuarios = simplexml_load_file('../xml/usuarios.xml');
            $id_recorridos = array();
            
            foreach($solicitudes->solicitud as $solicitud){
                $movil_id = (string)$solicitud->movil_id;
                if (in_array($movil_id, $id_recorridos)){
                    continue;
                }else{
                    $id_recorridos[] = $movil_id;
                }
                $mysqli= mysqli_connect($server, $user, $pass, $db);
                if (!$mysqli){
                    lanzarError('Problemas al abrir la base de datos', '../tienda/inicio.php');
                }else{
                    mysqli_set_charset($mysqli, "UTF8");
                    $sql= "SELECT ID, NOMBRE FROM `MOVILES` WHERE `ID` = $movil_id";
                    $result= mysqli_query($mysqli, $sql);
                    $movil = mysqli_fetch_array($result);
                    mysqli_close($mysqli);
                }
                
                echoMovilSolicitudes($movil);
                ?>
            <hr> 
            <?php
            }
            ?>
        </div>

        <?php include '../html/footer.html';?>
    </body>
</html>

<?php
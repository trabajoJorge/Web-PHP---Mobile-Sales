<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
        include '../html/head.html';
        include '../dbConfig.php';
        include '../php/echoMovil.php';
        include_once '../php/utils.php';
        ?>
        <title>ShareMovil - Buscar Móvil</title>
        <script type="text/javascript" src="../ajax/getMoviles.js"></script>
        <script type="text/javascript" src="../javascript/filtrarMoviles.js"></script>
    </head>
    
    <body>
        <?php
            include '../php/header.php';
        ?>

        <?php 
        $mysqli= mysqli_connect($server, $user, $pass, $db);
        if (!$mysqli){
            lanzarError('Problemas al abrir la base de datos', '../tienda/inicio.php');
        }else{
            mysqli_set_charset($mysqli, "UTF8");
            $sql= "SELECT * FROM `MOVILES`";
            $result= mysqli_query($mysqli, $sql);
            mysqli_close($mysqli);
        }
        ?>
         
        <h1 class="page_title">Buscar móviles</h1>
        
        <!-- Inicio buscador -->
        <div class="buscador_container">
            <div class="buscador_wrapper">
                <div class="buscador_grid">
                    <div class="buscador_cell_input">
                        <input type="text" name="buscar_input" id="buscar_input">
                    </div>
                    <div class="buscador_cell_select">
                        <select name="buscador_select" id="buscador_select">
                            <?php if(isset($_SESSION['vendedor'])){
                                echo '<option value="Id">Id</option>';
                            }
                            ?>
                            <option value="Nombre">Nombre</option>
                            <option value="Marca">Marca</option>
                        </select>
                    </div>    
                    <div class="buscador_cell_button">
                        <input type="button" name="buscar_button" id ="buscar_button" value="Buscar" onclick="return getMoviles();">
                    </div>

                    <div class="buscador_cell_checkbox" id="a2">
                        <input type="checkbox" name="stock_checkbox" id="stock_checkbox"> Ver moviles sin stock.
                    </div>
                </div>
            </div>
        </div>

        <div class="filter_container">
            <div class="filter_wrapper">
                <div class="filter_grid">
                    <div class="filter_cell_estado">
                        <h2 class="filter_cell_cabecera" id="a1"> Estado: </h2>
                        <input type="checkbox" name="nuevo" id="nuevo" onInput="filtrarMoviles();" checked>Nuevo
                        <input type="checkbox" name="segunda_mano" id="segunda_mano" onInput="filtrarMoviles();" checked>Segunda mano
                        <input type="checkbox" name="reacondicionado" id="reacondicionado" onInput="filtrarMoviles();" checked>Reacondicionado
                    </div>

                    <div class="filter_cell_ram">
                        <h2 class="filter_cell_cabecera"> RAM mínima </h2>
                        <input type="range" min="1" max="64" step="2" name="ram_min" value="2" id="ram_min" onInput="this.nextElementSibling.value = this.value; filtrarMoviles();">
                        <output>2</output>GB
                    </div>
                    <div class="filter_cell_memory">
                        <h2 class="filter_cell_cabecera"> Memoria mínima</h2>
                        <input type="range" min="8" max="512" step="8" name="memoria_min" value="8" id="memoria_min" onInput="this.nextElementSibling.value = this.value; filtrarMoviles();">
                        <output>8</output>GB
                    </div>
                    <div class="filter_cell_batery">
                        <h2 class="filter_cell_cabecera">Batería mínima</h2>
                        <input type="range" min="1000" max="10000" step="100" name="bateria_min" value="1000" id="bateria_min" onInput="this.nextElementSibling.value = this.value; filtrarMoviles();">
                        <output>1000</output>mAh
                    </div>
                    <div class="filter_cell_price">
                        <h2 class="filter_cell_cabecera">Precio máximo</h2>
                        <input type="range" min="50" max="1000" step="50" name="precio_max" value="1000" id="precio_max" onInput="this.nextElementSibling.value = this.value; filtrarMoviles();">
                        <output>1000</output>€
                    </div>    
                </div>
            </div>
        </div>
        <!-- Fin buscador -->
            
            
        <div class="wrapper_body">
            <?php
            if (!$result){
                lanzarAlertaNoRedirect('Problemas al abrir la base de datos');
            }else{
                while( $row = mysqli_fetch_array($result) ){
                    echoMovilReducido($row, "../tienda/verMovil.php?id=".$row['ID']);
                    ?>
                    <hr id="<?php echo $row['ID'];?>">
                <?php
                }
                ?>
            <?php
            }
            ?>
            
        </div>
        <?php
            include '../html/footer.html';
        ?>
    </body>
</html>
<?php
/**
 * Este PHP se encarga de mostrar el banner y el menú horizontal de la página.
 */
?>

<!-- Inicio del header (incluye banner y menú de navegación) -->
<header>
    <!--El banner-->
    <div class="logo_tienda">
        <img src="../resources/logo.png" alt="Logotipo de la tienda ShareMovil">
    </div>

    <!--El menú-->
    <nav class="menu">
        <ul class="menuOptionList">
        <?php
            include_once '../php/utils.php';

            $pagina = ''.basename($_SERVER['PHP_SELF']);
            echo '<li id="esquina_izquierda"><a class="menuOption" ';
            if($pagina == 'inicio.php') echo 'id="active_izquierda" ';
            echo 'href="inicio.php">Inicio</a></li>'.
            '<li><a class="menuOption" ';
            if($pagina == 'buscador.php') echo 'id="active" ';
            echo 'href="buscador.php">Buscador</a></li>'.
            '<li><a class="menuOption" ';
            if($pagina == 'recomendaciones.php') echo 'id="active" ';
            echo 'href="recomendaciones.php">Recomendaciones</a></li>';

            if(isset($_SESSION['user']) && isset($_SESSION['vendedor'])){
                echo '<li><a class="menuOption" ';
                if($pagina == 'agregarMovil.php') echo 'id="active" ';
                echo 'href="agregarMovil.php">Agregar Móvil</a></li>';

                echo '<li><a class="menuOption" ';
                if($pagina == 'verSolicitudes.php') echo 'id="active" ';
                echo 'href="verSolicitudes.php">Ver Solicitudes</a></li>';
            }
            
            echo '<li class="listElementRight" id="esquina_derecha">';
            if(isset($_SESSION["user"])){
                echo '<a class="menuOption" href="../php/logout.php">Cerrar Sesión</a>';
            }else{
                echo '<a class="menuOption" ';
                if($pagina == 'login.php') echo 'id="active_derecha" ';
                echo 'href="login.php">Ingresar</a>';
            }
            echo '</li>';

            echo '<li class="listElementRight">';
            if(!isset($_SESSION["user"])){
                echo '<a class="menuOption" ';
                if($pagina == 'registrarse.php') echo 'id="active" ';
                echo 'href="registrarse.php">Registrarse</a>';
            }
            echo '</li>';
        ?>
        </ul>
    </nav>
</header>
<!-- Fin del header -->

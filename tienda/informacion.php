<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html';?>
        <title>ShareMovil - ¿Quiénes somos?</title>
    </head>

    <body>
        <?php include '../php/header.php'; ?>

        <h1 class="page_title">¿Quiénes somos?</h1>

        <div class="wrapper_body">
            <div style="background-color: rgb(239,239,239); padding: 20px; border-radius: 20px;">
                <div style="display: flex; width:100%; justify-content: center; align-items: center">
                    <img style="width: 25%; max-height: 50%;" src="../resources/logo_upv.png">
                </div>
                
                <div style="margin: 20px; padding: 20px;">
                    <p style="text-align: justify;">
                        Esta página ha sido desarrollada por un grupo de estudiantes de la Universidad del 
                        País Vasco (UPV/EHU) del grado de Ingeniería Informática en la Facultad de 
                        Informática de Donostia para la materia de Servicios y Aplicaciones en Red como 
                        proyecto de evaluación. El objetivo de ésta es mostrar los conocimientos aprendidos 
                        en las distintas herramientas del desarrollo web (HTML, CSS, JavaScript, PHP, XML y 
                        AJAX).
                    </p>

                    <div>
                        Los integrantes del grupo son:
                    </div>
                    <ul>
                        <li>
                            Baldwin Rodríguez Ponce
                        </li>
                        <li>
                            Aitor Iglesias Hernández
                        </li>
                        <li>
                            Jorge Iglesias Roldán
                        </li>
                        <li>
                            Maider Larrazabal Aurrekoetxea
                        </li>
                    </ul>

                    <p style="text-align: justify;">
                        Los íconos utilizados en esta página están bajo la licencia <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.es_ES">"Creative Commons Zero"</a> (dominio público).
                    </p>
                </div>
                
                <div style="display: flex; width:100%; justify-content: center; align-items: center">
                    <img style="width: 25%; max-height: 50%;" src="../resources/Dominio-público-CC0-CC-zero.png">
                </div>
            
            </div>
        </div>

        <?php include '../html/footer.html';?>
    </body>
</html>

<?php
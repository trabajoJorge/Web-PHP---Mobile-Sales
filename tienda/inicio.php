<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include '../html/head.html'; ?>
        <title> ShareMovil - Tienda de móviles local </title>
    </head>
    
    <body>
        <?php include '../php/header.php';?>
        
        <h1 class="page_title">¡Bienvenid@ a ShareMovil!</h1>

        <div class="wrapper_body">
            <div style="display: flex; align-content: center; justify-content: center; background-color: rgb(239,239,239); border-radius: 15px;">
                <p style="border-radius: 15px; background-color: rgb(252, 252, 252); text-align: justify; margin: 20px; padding: 20px;">
                ShareMovil es la tienda de teléfonos que nadie pedía, pero todos andaban buscando. En esta página podrás ver móviles con sus características.
                "¿Absolutamente todas las características?", te preguntarás y la respuesta es no. Solamente aquellas que hemos decidido poner, porque características
                importantes como lo son el sistema operativo y más, hemos decidido ignorarlas. Pero eso no es todo, ¿qué pasa si quieres comprar un móvil en
                nuestra página? (Dios sabrá por qué) ¡Qué no puedes! Así es, en nuestra página solamente se pueden mirar móviles que hemos copiado a otras páginas
                más conocidas como lo son Amazon o PCComponentes. Y hemos sido tan cutres que ni siquiera hemos puesto links hacia estos móviles en páginas
                que sí se pueden comprar. ¡Anímate y compra un móvil en ShareMovil!
                <br>
                <br>
                Si deseas consultar móviles, ve al buscador. Gracias por visitarnos.
                </p>
                
                <img style="border-radius: 5px 15px 15px 5px"src="../resources/phone.gif" alt="Teléfono bailarín">
            </div>
        </div>
        <?php include '../html/footer.html' ?>
    </body>
</html>

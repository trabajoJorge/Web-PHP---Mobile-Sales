/**
 * Función que cambia el ícono del campo de imagen del formulario de agregarMovil.php
 */
function actualizarIcono(){
    var imagen = $("input#imagen_input").get(0).files.length;
    if(imagen == 0){
        $("#file_button").css("background-image", 'url(../resources/icons/subir.svg)');
    }else{
        $("#file_button").css("background-image", 'url(../resources/icons/subida.svg)');
    }
}
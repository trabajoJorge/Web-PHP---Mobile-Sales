/**
 * Verifica que el parámetro sea un número válido como string.
 * 
 * @param {String} num : el string que representa al número.
 * @return {Boolean} true si y sólo si el string pasado por parámetro es un número válido.
 */
function verificarNumero(num){
    var regex=/^[0-9]+$/;
    if (!num.match(regex))
    {
        return false;
    }
    return true;
}


/**
 * Función que implementa AJAX para obtener las solicitudes de un móvil determinado
 * usando el criterio de búsqueda del buscador de verSolicitudes.php
 */
function getSolicitudes() {
    var busqueda = $("input#buscar_input").val();
    var tipo = $("select#buscador_select").val();
    var accept_query = (busqueda.length > 0);
    
    if(tipo === 'Id'){
        accept_query = verificarNumero(busqueda);
    }
    if(accept_query){
        if (XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xhr.open('POST', '../ajax/getSolicitudes.php', true);
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if(xhr.responseText === ""){
                    $("div.wrapper_body").html("<center>Sin resultados</center>");
                }else{
                    $("div.wrapper_body").html(xhr.responseText);
                }
            }
        }

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("query="+busqueda+"&attribute="+tipo);
        
    }else{
        alert("El valor introducido no es válido");
        $("input#buscar_input").val('');
    }
}

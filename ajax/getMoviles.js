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
 * Función que implementa AJAX para obtener los móviles que cumplen con los criterios de búsqueda.
 */
function getMoviles() {
    var busqueda = $("input#buscar_input").val();
    var tipo = $("select#buscador_select").val();
    var stock;
    if($("#stock_checkbox:checked").length === 0){
        stock = "En Stock";
    }else{
        stock = "Sin Stock";
    }
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
        
        xhr.open('POST', '../ajax/getMoviles.php', true);
        
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
        xhr.send("query="+busqueda+"&attribute="+tipo+"&stock="+stock);
        return true;
    }else{
        alert("El valor introducido no es válido");
        $("input#buscar_input").val('');
        return false;
    }
}

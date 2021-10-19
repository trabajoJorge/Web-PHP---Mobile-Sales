/**
 * Función que implementa AJAX para obtener el comentario completo usando su id.
 * 
 * @param {string} c_id : id del comentario.
 */
function getComentario(c_id) {
    if (XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.open('POST', '../ajax/getComentario.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            $(".cuerpo_comentario>p").html(xhr.responseText);
        }
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id="+c_id);
}

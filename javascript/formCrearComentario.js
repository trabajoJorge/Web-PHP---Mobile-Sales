/**
 * Verifica que el comentario que se quiere enviar al servidor no esté vacío.
 * 
 * @return {Boolean}
 */
function verificar_comentario()
{
    var comentario = $("#comentario_input").val();

    if(comentario === "")
    {
        alert("Escriba su comentario por favor");
        return false;
    }
    return true;
}
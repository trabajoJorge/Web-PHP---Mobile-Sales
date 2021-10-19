estado_nuevo = true;
estado_segunda = true;
estado_reacondicionado = true;

memoria = 0;
ram = 0;
bateria = 0;
precio = parseFloat("Inf");

/**
 * Función que determina si un móvil debería ser mostrado o no.
 * 
 * @param {string} m_estado: El estado actual del móvil.
 * @param {float} m_memoria: La memoria del móvil
 * @param {float} m_ram: La RAM del móvil.
 * @param {float} m_bateria: La batería del móvil
 * @param {float} m_precio: El precio del móvil.
 * @return {Boolean} true si y sólo si el móvil cumple con los criterios de filtrado.
 */
function mostrarMovil(m_estado, m_memoria, m_ram, m_bateria, m_precio){
    if(m_memoria < memoria){
        return false;
    }
    if(m_ram < ram){
        return false;
    }
    if(m_bateria < bateria){
        return false;
    }
    if(m_precio > precio){
        return false;
    }
    if((m_estado === "Nuevo" && estado_nuevo) || (m_estado === "Segunda Mano" && estado_segunda) || (m_estado === "Reacondicionado" && estado_reacondicionado)){
        return true;
    }else{
        return false;
    }
}

/**
 * Función que determina y oculta los móviles que no cumplen con los criterios de filtrado.
 */
function filtrarMoviles(){
    //Checkboxes
    estado_nuevo = ($("input#nuevo:checkbox:checked").length > 0);
    estado_segunda = ($("input#segunda_mano:checkbox:checked").length > 0);
    estado_reacondicionado = ($("input#reacondicionado:checkbox:checked").length > 0);
    //Sliders
    memoria = $("input#memoria_min").val();
    ram = $("input#ram_min").val();
    bateria = $("input#bateria_min").val();
    precio = $("input#precio_max").val();
    
    var contenedores = $(".container_movil");
    
    var m_estado;
    var m_memoria;
    var m_ram;
    var m_bateria;
    var m_precio;
    contenedores.each( function(){
        m_estado = $(this).find(".grid_estado > .cell_dato_contenido > span").text();
        m_memoria = parseFloat($(this).find(".grid_detalles").attr("data-memoria"));
        m_ram = parseFloat($(this).find(".grid_detalles").attr("data-ram"));
        m_bateria = parseFloat($(this).find(".grid_detalles").attr("data-bateria"));
        m_precio = parseFloat($(this).find(".grid_precio > .cell_dato_contenido > span").text());
        if(mostrarMovil(m_estado, m_memoria, m_ram, m_bateria, m_precio)){
            $(this).css("display", "flex");
            $(this).siblings("hr#"+$(this).attr("id")).css("display", "");
        }else{
            $(this).css("display", "none");
            $(this).siblings("hr#"+$(this).attr("id")).css("display", "none");
        }
    });
}



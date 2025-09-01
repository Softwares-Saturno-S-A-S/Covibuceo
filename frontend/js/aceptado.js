    document.addEventListener('DOMContentLoaded', function() {
    cargarMensaje();
});

    function cargarMensaje() {

        const contenedor = document.getElementById('mensaje-container');
        const urlParams = new URLSearchParams(window.location.search); // Busca los parámetros de la URL
        const mensajeCodificado = urlParams.get('mensaje'); // Obtiene el mensaje codificado encontrado en la URL

        if (mensajeCodificado) {
            try {
                // Decodificar el mensaje HTML
                const mensajeHTML = decodeURIComponent(mensajeCodificado);
            
                // Mostrar el mensaje
                contenedor.innerHTML = mensajeHTML;
            
            } catch (error) {
                console.error('Error al decodificar mensaje:', error);
                contenedor.innerHTML = '<p>Error al obtener mensaje de aprobación. Igual le informamos que su solicitud fue enviada.</p>';
        }
    }
}
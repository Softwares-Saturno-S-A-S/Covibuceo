    document.addEventListener('DOMContentLoaded', function() {
    cargarMensaje();
});

    function cargarMensaje() {

        const contenedor = document.getElementById('mensaje-container');
        const urlParams = new URLSearchParams(window.location.search); // Busca los parámetros de la URL
        const mensajeCodificado = urlParams.get('mensaje'); // Obtiene el mensaje codificado encontrado en la URL

        if (mensajeCodificado) {
            try {
                // Construye mensaje HTML
                const mensajeHTML = `
                    <div class="Classic">
                        <h2>Solicitud Enviada</h2>
                        <p class="left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial.
                        <button class="button-longsize light-green" type="button" onclick="close()">Aceptar</button>
                    </div>
                `;
            
                // Mostrar el mensaje
                contenedor.innerHTML = mensajeHTML;

                const botonCerrar = contenedor.querySelector('.button-longsize');
                if (botonCerrar) {
                    botonCerrar.addEventListener('click', function() {
                        window.close();
                        window.opener.location.reload(); // Recarga la página que abrió la ventana emergente
                    });
                }
            } catch (error) {
                console.error('Error al decodificar mensaje:', error);
                contenedor.innerHTML = '<p>Error al obtener mensaje de aprobación. Igual le informamos que su solicitud fue enviada.</p>';
        }
    }
}
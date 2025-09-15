    document.addEventListener('DOMContentLoaded', function() {
    cargarMensaje();
});

    function cargarMensaje() {

        const contenedor = document.getElementById('mensaje-container');
        const urlParams = new URLSearchParams(window.location.search); // Busca los parámetros de la URL
        const mensaje = urlParams.get('mensaje'); // Obtiene el mensaje codificado encontrado en la URL

        const Email = sessionStorage.getItem('userEmail');

        if (mensaje === 'aceptado') {
            try {
                // Construye mensaje HTML
                const mensajeHTML = `
                    <div class="classic">
                        <h2>Solicitud Enviada</h2>
                        <p class="left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: <span class="link">${Email}</span> cuando gestionemos el estado de su solicitud.</p>
                        <p class="left spaced">En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial. Una vez realice este aporte, se le asignara una vivienda en base a las necesidades solicitadas.</p>
                        <button class="button-longsize light-green" type="button">Aceptar</button>
                    </div>
                `;
            
                // Mostrar el mensaje
                contenedor.innerHTML = mensajeHTML;

                const botonCerrar = contenedor.querySelector('.button-longsize');
                if (botonCerrar) {
                    botonCerrar.addEventListener('click', function() {
                        history.back()// Recarga la página que abrió la ventana emergente
                    });
                }
            } catch (error) {
                console.error('Error al decodificar mensaje:', error);
                contenedor.innerHTML = '<p>Error al obtener mensaje de aprobación. Igual le informamos que su solicitud fue enviada.</p>';
        }
    }
}
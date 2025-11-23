 history.replaceState({}, document.title, window.location.pathname);document.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const shouldReset = urlParams.get('reset');

    if (shouldReset === 'true') {
        const formulario = document.getElementById('form-registro');
        if (formulario) {
            formulario.reset();
        }

        // Eliminar el parámetro de la URL para que no se resetee en cada recarga
        history.replaceState({}, document.title, window.location.pathname);  // Limpia la URL, reestableciendo la ruta original
    }
});

function BotonCerrar(url){
    window.location.href = `${url}?reset=true`;
}
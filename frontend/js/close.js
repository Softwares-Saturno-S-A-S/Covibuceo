    function close() {
        window.close();
        window.opener.location.reload(); // Recarga la página que abrió la ventana emergente
    }
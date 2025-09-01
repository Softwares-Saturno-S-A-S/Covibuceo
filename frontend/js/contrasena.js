function cambioContrasena() {
            const passwordInput = document.querySelector('input[name="password"]');
            const toggleButton = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') { // Comprueba si el input es de tipo password, es decir si oculta lo ingresado en el campo.
                passwordInput.type = 'text'; // Cambia el tipo a texto para mostrar la contraseña
                toggleButton.textContent = 'e'; // Cambia el texto a "e" que representa el icono de "esconder"
            } else {
                passwordInput.type = 'password'; // Cambia el tipo a password para ocultar la contraseña
                toggleButton.textContent = 'v'; // Cambia el texto a "v" que representa el icono de "ver"
            }
        }
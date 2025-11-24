const API_Usuarios = "../../backend/api/usuarios.php"; // Definir constante de la API
const elemento = document.getElementById("response");

// Agregar Solicitud de Socio
document.getElementById("form-registro").addEventListener("submit", async e => {
    e.preventDefault();
    const socio = {
    // Cargar datos del formulario
        nombre: document.getElementsByName("name")[0].value,
        apellido: document.getElementsByName("surname")[0].value,
        ci: document.getElementsByName("ci")[0].value,
        telefono: document.getElementsByName("tel")[0].value,
        email: document.getElementsByName("email")[0].value,
        password: document.getElementsByName("password")[0].value,
    };

    const response = await fetch(API_Usuarios, {
        method: "POST", // Hace una solicitud POST
        headers: { "Content-Type": "application/json" }, // Define el tipo de contenido como JSON
        body: JSON.stringify(socio) // Convierte el objeto socio a una cadena JSON
    })

    const resultado = await response.json(); // Espera la respuesta y la convierte a JSON

    const status = response.status; // Obtiene el código de estado de la respuesta

    switch (status) {

        case 201: // Exito, solicitud agregada correctamente
            sessionStorage.setItem("userEmail", resultado.email); // Guarda el email del usuario en sessionStorage
            window.location.href = "/Landing_Page/aceptado.html?mensaje=aceptado" ; //Redirige a una nueva pestaña pasando como parámetro el mensaje recibido de la API.
        break;

        case 409: // Error (usuario existente)
            elemento.classList.toggle("response-invisible");
            elemento.textContent = resultado.error; // Muestra el mensaje de error devuelto por la API
            // Agregar estilos de error
            elemento.style.color = "#f08400ff";
        break;

        case 410: // Error (Solicitud existente)
            elemento.classList.toggle("response-invisible");
            elemento.textContent = resultado.error; // Muestra el mensaje de error devuelto por la API
            // Agregar estilos de error
            elemento.style.color = "#f08400ff";
        break;

        case 500: // Error del servidor
            document.getElementById("response").textContent = resultado.error;  
            document.getElementById("response").style.color = "red";
        break;

        default: // Otro error
            document.getElementById("response").textContent = "Ocurrió un error inesperado. Por favor, inténtelo de nuevo más tarde.";
            document.getElementById("response").style.color = "red";
        break;
        
    }

 }
);


   
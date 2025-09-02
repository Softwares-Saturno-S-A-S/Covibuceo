function close() {
        window.close();
        window.opener.location.reload(); // Recarga la página que abrió la ventana emergente
    }

const API_Usuarios = "../../backend/api/usuarios.php"; // Definir constante de la API

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
            function buildHTML(resultado){ // Función para construir el HTML del mensaje
                const mensaje = `
                <div class="classic">
                    <h2>Solicitud Enviada</h2>
                    <p class="left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: <span class="link">${resultado.email}</span> cuando gestionemos el estado de su solicitud.</p>
                    <p class="left spaced">En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial. Una vez realice este aporte, se le asignara una vivienda en base a las necesidades solicitadas.</p>
                    <button class="button-longsize light-green" type="button" onclick="close()">Aceptar</button>
                </div>
                `;
            return mensaje;
        }
            const mensaje_raw = buildHTML(resultado); 
            const mensaje_codificado = encodeURIComponent(mensaje_raw); // Codifica el mensaje para URL
            window.location.href = "../Landing_Page/aceptado.html?mensaje=" + mensaje_codificado; //Redirige a una nueva pestaña pasando como parámetro el mensaje recibido de la API.
        break;

        case 409: // Error (usuario existente)
            const elemento = document.getElementById("response");
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
            document.getElementById("response").textContent = "Ocurrió un error inesperado. Por favor, inténtelo de nuevo.";
            document.getElementById("response").style.color = "red";
        break;
        
    }

 }
);

// Mostrar Solicitudes de Socios (Para administrador)
// document.getElementById("solicitudes-pendientes").addEventListener("DOMContentLoaded", async e => {
//     e.preventDefault();
//     const socios = {
//         Estado: "Pendiente"
//     };

//     const response = await fetch(API_Usuarios, {
//         method: "GET", // Hace una solicitud POST
//         headers: { "Content-Type": "application/json" }, // Define el tipo de contenido como JSON
//     })
// });

   
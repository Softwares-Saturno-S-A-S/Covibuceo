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

    $status = response.status; // Obtiene el código de estado de la respuesta
    switch ($status) {

        case 201: // Exito, solicitud agregada correctamente
            function buildHTML(resultado){ // Función para construir el HTML del mensaje
                const mensaje = `
                    <h2>Solicitud Enviada</h2>
                    <p class="p-left spaced">Le informamos que su solicitud para asociarse a <b>COVIBUCEO</b> fue enviada con éxito. Usted recibirá un correo electrónico a: <div class="link">${resultado.email}</div> cuando gestionemos el estado de su solicitud.</p>
                    <p class="p-left spaced">En caso de aprobar su solicitud le enviaremos los datos para realizar su aporte inicial. Una vez realice este aporte, se le asignara una vivienda en base a las necesidades solicitadas.</p>
                    <button class="button-longsize light-green" onclick = "close()">Aceptar</button>
                `;
            }
            const mensaje = encodeURIComponent(resultado.mensaje); // Codifica el mensaje para URL
            window.location.href = "../Landing Page/aceptado.html?mensaje=" + mensaje; //Redirige a una nueva pestaña pasando como parámetro el mensaje recibido de la API.
        break;

        case 409: // Error (usuario existente)
            document.getElementById("response").textContent = resultado.error; // Muestra el mensaje de error devuelto por la API
            // Agregar estilos de error
            document.getElementById("response").style.color = "#ffcd2aff";
        break;

        case 500: // Error del servidor
            document.getElementById("response").textContent = resultado.error;  
            document.getElementById("response").style.color = "red";
        
    }

 }
);
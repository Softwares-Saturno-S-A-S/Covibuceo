const API_Usuarios = "http://localhost/primerentrega/backend/api/socios.php"; // Definir constante de la API

// Agregar Solicitud de Socio
document.getElementById("form-registro").addEventListener("submit", async e => {
    e.preventDefault();
    const socio = {
    // Cargar datsi del formulario
        nombre: document.getElementByName("name").value,
        apellido: document.getElementByName("surname").value,
        email: document.getElementByName("ci").value,
        telefono: document.getElementByName("tel").value,
        email: document.getElementByName("email").value,
        password: document.getElementByName("password").value,
    };
    await fetch(API_Usuarios, {
        method: "POST", // Hace una solicitud POST
        headers: { "Content-Type": "application/json" }, // Define el tipo de contenido como JSON
        body: JSON.stringify(socio) // Convierte el objeto socio a una cadena JSON
    })
}
);
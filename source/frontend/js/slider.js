    const slider = document.querySelector('.slider figure');
    const images = document.querySelectorAll('.slider figure img');
    let currentImage = 0;

    function moveSlider() { 
        currentImage++;

        if (currentImage > images.length - 1) { //Verifica si es la última imagen del slider
            currentImage = 0; // Vuelve a la primer imagen
        }

        const translateXValue = -currentImage * (100 / images.length); 
        slider.style.transform = `translateX(${translateXValue}%)`;
    }

    setInterval(moveSlider, 3000); // Cambia la imagen cada 3 segundos.
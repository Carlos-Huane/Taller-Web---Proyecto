const personalizados = [
    { nombre: "Anillo con grabado personalizado", precio: 40.00, fecha: "2024-09-01", imagen: "../images/custom-image.jpg" },
    { nombre: "Pulsera grabada", precio: 50.00, fecha: "2024-09-20", imagen: "../images/custom-image.jpg"},
    { nombre: "Cadena personalizada", precio: 100.00, fecha: "2024-08-10", imagen: "../images/custom-image.jpg" },
    { nombre: "Anillo doble personalizado", precio: 60.00, fecha: "2024-10-05", imagen: "../images/custom-image.jpg" },
    { nombre: "Pulsera con iniciales grabadas", precio: 45.00, fecha: "2024-09-25", imagen: "../images/custom-image.jpg" },
    { nombre: "Cadena con nombre grabado", precio: 120.00, fecha: "2024-08-15", imagen: "../images/custom-image.jpg" },
    { nombre: "Anillo con fecha especial", precio: 55.00, fecha: "2024-09-12", imagen: "../images/custom-image.jpg" },
    { nombre: "Pulsera con grabado de amor", precio: 70.00, fecha: "2024-09-30", imagen: "../images/custom-image.jpg" }
];

let carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; 

document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.getElementById('cardsContainer');
    
    // Renderiza los productos personalizados
    function renderPersonalizados(personalizados) {
        cardsContainer.innerHTML = ''; 

        personalizados.forEach(item => {
            const card = `
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <img src="${item.imagen}" class="card-img-top" alt="${item.nombre}">
                        <div class="card-body">
                            <h5 class="card-title">${item.nombre}</h5>
                            <p class="card-text">Precio: S/${item.precio.toFixed(2)}</p>

                            <!-- Input de texto personalizado -->
                            <input type="text" class="form-control mb-2" placeholder="Ingrese el texto personalizado" id="inputPersonalizado-${item.nombre}">
                            
                            <button class="btn btn-secondary mt-3" 
                                onclick="añadirAlCarrito('${item.nombre}', ${item.precio}, '${item.fecha}', 'inputPersonalizado-${item.nombre}', this)">
                                <i class="bi bi-cart"></i> Comprar ahora
                            </button>
                        </div>
                    </div>
                </div>
            `;
            cardsContainer.innerHTML += card;
        });
    }

    // Añade productos personalizados al carrito
    window.añadirAlCarrito = function (nombre, precio, fecha, inputId, button) {
        window.location.href = "../html/ventanaEmergente.html";
        const textoPersonalizado = document.getElementById(inputId).value;
        const cantidad = 1; // Puedes ajustar según sea necesario

        const productoExistente = carrito.find(item => item.nombre === nombre);

        if (productoExistente) {
            productoExistente.cantidad += cantidad; 
        } else {
            carrito.push({ nombre, precio, fecha, cantidad, textoPersonalizado }); 
        }

        sessionStorage.setItem('carrito', JSON.stringify(carrito)); 
        console.log(carrito); 
    };

    // Renderiza los personalizados al cargar la página
    renderPersonalizados(personalizados);
});

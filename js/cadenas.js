const cadenas = [
    { nombre: "Cadena de Plata", precio: 29.99, fecha: "2024-10-12", imagen: "../images/chain-image.jpg"  },
    { nombre: "Cadena de Oro", precio: 49.99, fecha: "2024-09-20", imagen: "../images/chain-image.jpg" },
    { nombre: "Cadena Personalizada", precio: 39.99, fecha: "2024-08-10", imagen: "../images/chain-image.jpg" },
    { nombre: "Cadena de Acero Inoxidable", precio: 24.99, fecha: "2024-10-05", imagen: "../images/chain-image.jpg" },
    { nombre: "Cadena con Colgante de Corazón", precio: 34.99, fecha: "2024-09-15", imagen: "../images/chain-image.jpg" },
    { nombre: "Cadena de perlas", precio: 59.99, fecha: "2024-08-01", imagen: "../images/chain-image.jpg" },
];

let carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Carga el carrito desde sessionStorage
const cardsContainer = document.getElementById('cardsContainer');

cadenas.forEach((cadena, index) => {
    const card = document.createElement('div');
    card.className = 'col-md-4 mb-4';
    card.innerHTML = `
        <div class="card">
            <img src="${cadena.imagen}" class="card-img-top" alt="${cadena.nombre}">
            <div class="card-body">
                <h5 class="card-title">${cadena.nombre}</h5>
                <p class="card-text">Precio: $${cadena.precio}</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal" onclick="openModal(${index})">Comprar ahora</button>
            </div>
        </div>
    `;
    cardsContainer.appendChild(card);
});

function openModal(index, cantidad) {
    const cadena = cadenas[index]; // Obtener el producto seleccionado
    document.getElementById('modalName').innerText = cadena.nombre; // Nombre del producto
    document.getElementById('modalPrice').innerText = `Precio: $${cadena.precio.toFixed(2)}`; // Precio
    document.getElementById('modalDate').innerText = `Fecha: ${cadena.fecha}`; // Fecha
    document.getElementById('modalImage').src = cadena.imagen; // Imagen
    document.getElementById('modalQuantity').innerText = cantidad; // Cantidad

    // Mostrar el modal
    $('#purchaseModal').modal('show'); // Esto muestra el modal

    // Añadir evento al botón de confirmar compra
    document.getElementById('confirmPurchaseButton').onclick = function() {
        alert("Compra realizada con éxito");
        $('#purchaseModal').modal('hide'); // Cerrar el modal después de confirmar
    };
}
document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.getElementById('cardsContainer');

    // Renderiza las cadenas
    function renderCadenas(cadenas) {
        cardsContainer.innerHTML = ''; // Limpia el contenedor

        cadenas.forEach(cadena => {
            const card = `
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <img src="${cadena.imagen}" class="card-img-top" alt="${cadena.nombre}">
                        <div class="card-body">
                            <h5 class="card-title">${cadena.nombre}</h5>
                            <p class="card-text">Precio: S/${cadena.precio.toFixed(2)}</p>

                            <!-- Controles de cantidad -->
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-secondary me-2" onclick="cambiarCantidad(this, -1)">-</button>
                                <span class="cantidad mx-2">1</span>
                                <button class="btn btn-outline-secondary ms-2" onclick="cambiarCantidad(this, 1)">+</button>
                            </div>

                            <!-- Botón Añadir al carrito -->
                            <button class="btn btn-secondary mt-3" 
                                onclick="añadirAlCarrito('${cadena.nombre}', ${cadena.precio}, this)">
                                <i class="bi bi-cart"></i> Comprar ahora
                            </button>
                        </div>
                    </div>
                </div>
            `;
            cardsContainer.innerHTML += card;
        });
    }

    // Cambia la cantidad seleccionada
    window.cambiarCantidad = function (button, cambio) {
        const cantidadElement = button.parentElement.querySelector('.cantidad');
        let cantidad = parseInt(cantidadElement.textContent) + cambio;
        if (cantidad < 1) cantidad = 1; // Evita que sea menor a 1
        cantidadElement.textContent = cantidad;
    };

    // Añade productos al carrito
    /*window.añadirAlCarrito = function (nombre, precio, button) {
        window.location.href = "../html/ventanaEmergente.html";
        const cantidad = parseInt(button.parentElement.querySelector('.cantidad').textContent);

        // Verifica si ya existe en el carrito
        const productoExistente = carrito.find(item => item.nombre === nombre);

        if (productoExistente) {
            productoExistente.cantidad += cantidad; // Actualiza cantidad
        } else {
            carrito.push({ nombre, precio, cantidad }); // Añade nuevo producto
        }

        sessionStorage.setItem('carrito', JSON.stringify(carrito)); // Guarda el carrito en sessionStorage
        console.log(carrito); // Muestra el carrito en la consola
    };*/

    window.añadirAlCarrito = function (nombre, precio, button) {
    const cantidad = parseInt(button.parentElement.querySelector('.cantidad').textContent); // Obtener la cantidad
    const index = cadenas.findIndex(item => item.nombre === nombre); // Obtener el índice del producto

    openModal(index, cantidad); // Mostrar el modal con la información del producto
};


    // Filtrado por fecha, precio o nombre
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            const criterio = this.textContent;
            let cadenasFiltradas = [...cadenas];

            if (criterio.includes('Fecha')) {
                cadenasFiltradas.sort((a, b) =>
                    criterio.includes('nuevo a antiguo') ? new Date(b.fecha) - new Date(a.fecha) :
                    new Date(a.fecha) - new Date(b.fecha)
                );
            } else if (criterio.includes('Precio')) {
                cadenasFiltradas.sort((a, b) =>
                    criterio.includes('menor a mayor') ? a.precio - b.precio : b.precio - a.precio
                );
            } else if (criterio.includes('Alfabéticamente')) {
                cadenasFiltradas.sort((a, b) =>
                    criterio.includes('A-Z') ? a.nombre.localeCompare(b.nombre) : b.nombre.localeCompare(a.nombre)
                );
            }

            renderCadenas(cadenasFiltradas); // Renderiza cadenas filtradas
        });
    });

    // Renderiza las cadenas al cargar la página
    renderCadenas(cadenas);
});

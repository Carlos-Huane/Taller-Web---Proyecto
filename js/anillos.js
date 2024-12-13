const anillos = [
    { nombre: "Anillo con corazón grabado", precio: 35.00, talla: "7", fecha: "2024-10-12", imagen: "https://i.pinimg.com/736x/fb/1a/3c/fb1a3c837b5308b9bda1e0be4f00513d.jpg" },
    { nombre: "Anillo de oro clásico", precio: 150.00, talla: "8", fecha: "2024-09-20", imagen: "https://i.pinimg.com/736x/5f/ed/41/5fed4174d5a329bacd3ed297f802bc68.jpg" },
    { nombre: "Anillo de plata con piedras", precio: 80.00, talla: "8", fecha: "2024-08-10", imagen: "https://i.pinimg.com/736x/b1/02/ac/b102ac1bd233b6e9dc84118e5298c4c0.jpg" },
    { nombre: "Anillo minimalista", precio: 45.00, talla: "9", fecha: "2024-10-01", imagen: "https://i.pinimg.com/736x/5f/ed/41/5fed4174d5a329bacd3ed297f802bc68.jpg" },
    { nombre: "Anillo doble banda", precio: 120.00, talla: "7", fecha: "2024-09-15", imagen: "https://i.pinimg.com/736x/49/e8/d8/49e8d81bdb1e6986eb012e604aaeb3ea.jpg" },
    { nombre: "Anillo personalizado", precio: 90.00, talla: "8", fecha: "2024-08-20", imagen: "https://i.pinimg.com/736x/fb/1a/3c/fb1a3c837b5308b9bda1e0be4f00513d.jpg" },
    { nombre: "Anillo vintage", precio: 75.00, talla: "7", fecha: "2024-10-10", imagen: "https://i.pinimg.com/736x/49/e8/d8/49e8d81bdb1e6986eb012e604aaeb3ea.jpg" },
    { nombre: "Anillo romántico", precio: 60.00, talla: "6", fecha: "2024-07-05", imagen: "https://i.pinimg.com/736x/5f/ed/41/5fed4174d5a329bacd3ed297f802bc68.jpg" }
];

let carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Carga el carrito desde sessionStorage

const cardsContainer = document.getElementById('cardsContainer');

anillos.forEach((anillo, index) => {
    const card = document.createElement('div');
    card.className = 'col-md-4 mb-4';
    card.innerHTML = `
        <div class="card">
            <img src="${anillo.imagen}" class="card-img-top" alt="${anillo.nombre}">
            <div class="card-body">
                <h5 class="card-title">"${anillo.nombre}"</h5>
                <p class="card-text">Precio: $${anillo.precio}</p>
                <button class="btn btn-primary" onclick="openModal(${index})">Comprar ahora</button>
            </div>
        </div>
    `;
    cardsContainer.appendChild(card);
});

function openModal(index, cantidad = 1) {
    const anillo = anillos[index];
    document.getElementById('modalName').innerText = anillo.nombre;
    document.getElementById('modalPrice').innerText = `Precio: S/.${anillo.precio}`;
    document.getElementById('modalTalla').innerText = `Talla: ${anillo.talla}`;
    document.getElementById('modalImage').src = anillo.imagen;
    document.getElementById('modalQuantity').innerText = cantidad; // Muestra la cantidad en el modal
    const modal = new bootstrap.Modal(document.getElementById('purchaseModal'));
    modal.show();
}

document.getElementById('confirmPurchaseButton').addEventListener('click', () => {
    const address = document.getElementById('address').value;
    if (address) {
        alert('Compra confirmada. Enviando a: ' + address);
        const modal = bootstrap.Modal.getInstance(document.getElementById('purchaseModal'));
        modal.hide();
    } else {
        alert('Por favor, ingresa tu dirección de envío.');
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.getElementById('cardsContainer');

    // Renderiza los productos
    function renderAnillos(anillos) {
        cardsContainer.innerHTML = ''; // Limpia el contenedor

        anillos.forEach(anillo => {
            const card = `
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <img src="${anillo.imagen}" class="card-img-top" alt="${anillo.nombre}">
                        <div class="card-body">
                            <h5 class="card-title">${anillo.nombre}</h5>
                            <p class="card-text">Precio: S/${anillo.precio.toFixed(2)}</p>
                            <p class="card-text">Talla: ${anillo.talla}</p>

                            <!-- Controles de cantidad -->
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-secondary me-2" onclick="cambiarCantidad(this, -1)">-</button>
                                <span class="cantidad mx-2">1</span>
                                <button class="btn btn-outline-secondary ms-2" onclick="cambiarCantidad(this, 1)">+</button>
                            </div>

                            <!-- Botón Añadir al carrito -->
                            <button class="btn btn-secondary mt-3"
                                onclick="añadirAlCarrito('${anillo.nombre}', ${anillo.precio}, '${anillo.talla}', this)">
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
    
        // Actualiza la cantidad en el modal
        const modalCantidadElement = document.getElementById('modalQuantity');
        modalCantidadElement.innerText = cantidad; // Actualiza la cantidad en el modal
    };

    /*// Añade productos al carrito
    window.añadirAlCarrito = function (nombre, precio, talla, button) {
        
        window.location.href = "../html/ventanaEmergente.html";
        const cantidad = parseInt(button.parentElement.querySelector('.cantidad').textContent);

        // Verifica si ya existe en el carrito
        const productoExistente = carrito.find(item => item.nombre === nombre);

        if (productoExistente) {
            productoExistente.cantidad += cantidad; // Actualiza cantidad
        } else {
            carrito.push({ nombre, precio, talla, cantidad }); // Añade nuevo producto
        }

        sessionStorage.setItem('carrito', JSON.stringify(carrito)); // Guarda el carrito en sessionStorage
        console.log(carrito); // Muestra el carrito en la consola
    };*/
    window.añadirAlCarrito = function (nombre, precio, talla, button) {
        const cantidad = parseInt(button.parentElement.querySelector('.cantidad').textContent); // Obtener la cantidad
        const index = anillos.findIndex(item => item.nombre === nombre); // Obtener el índice del producto
    
        openModal(index, cantidad); // Mostrar el modal con la información del producto
    };


    // Filtrado por fecha, precio o nombre
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            const criterio = this.textContent;
            let anillosFiltrados = [...anillos];

            if (criterio.includes('Fecha')) {
                anillosFiltrados.sort((a, b) =>
                    criterio.includes('nuevo a antiguo') ? new Date(b.fecha) - new Date(a.fecha) :
                    new Date(a.fecha) - new Date(b.fecha)
                );
            } else if (criterio.includes('Precio')) {
                anillosFiltrados.sort((a, b) =>
                    criterio.includes('menor a mayor') ? a.precio - b.precio : b.precio - a.precio
                );
            } else if (criterio.includes('Alfabéticamente')) {
                anillosFiltrados.sort((a, b) =>
                    criterio.includes('A-Z') ? a.nombre.localeCompare(b.nombre) : b.nombre.localeCompare(a.nombre)
                );
            }

            renderAnillos(anillosFiltrados); // Renderiza anillos filtrados
        });
    });

    // Renderiza los anillos al cargar la página
    renderAnillos(anillos);
});

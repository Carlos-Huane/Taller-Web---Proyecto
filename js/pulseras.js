const pulseras = [
    { nombre: "Pulsera de Cuero", precio: 24.99, fecha: "2024-10-12", imagen: "../images/bracelet-img.jpg"},
    { nombre: "Pulsera de Plata", precio: 34.99, fecha: "2024-09-20", imagen: "../images/bracelet-img.jpg" },
    { nombre: "Pulsera Personalizada", precio: 44.99, fecha: "2024-08-10", imagen: "../images/bracelet-img.jpg" },
    { nombre: "Pulsera de Beads", precio: 19.99, fecha: "2024-10-05", imagen: "../images/bracelet-img.jpg" },
    { nombre: "Pulsera con Charm", precio: 29.99, fecha: "2024-09-15", imagen: "../images/bracelet-img.jpg" },
    { nombre: "Pulsera de Acero Inoxidable", precio: 39.99, fecha: "2024-08-01", imagen: "../images/bracelet-img.jpg" },
];

let carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Carga el carrito desde sessionStorage

document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.getElementById('cardsContainer');

    // Renderiza las pulseras
    function renderPulseras(pulseras) {
        cardsContainer.innerHTML = ''; // Limpia el contenedor

        pulseras.forEach(pulsera => {
            const card = `
                <div class="col-md-3 mb-4">
                    <div class="card text-center">
                        <img src="${pulsera.imagen}" class="card-img-top" alt="${pulsera.nombre}">
                        <div class="card-body">
                            <h5 class="card-title">${pulsera.nombre}</h5>
                            <p class="card-text">Precio: S/${pulsera.precio.toFixed(2)}</p>

                            <!-- Controles de cantidad -->
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-secondary me-2" onclick="cambiarCantidad(this, -1)">-</button>
                                <span class="cantidad mx-2">1</span>
                                <button class="btn btn-outline-secondary ms-2" onclick="cambiarCantidad(this, 1)">+</button>
                            </div>

                            <!-- Botón Añadir al carrito -->
                            <button class="btn btn-secondary mt-3"  
                                onclick="openModal('${pulsera.nombre}', ${pulsera.precio}, this)">
                                <i class="bi bi-cart"></i> Comprar ahora
                            </button>
                        </div>
                    </div>
                </div>
            `;
            cardsContainer.innerHTML += card;
        });
    }
    // Abre el modal con los detalles del producto
    window.openModal = function (nombre, precio, button) {
        // Actualiza el contenido del modal
        document.getElementById('modalName').innerText = nombre; // Nombre del producto
        document.getElementById('modalPrice').innerText = `Precio: S/${precio.toFixed(2)}`; // Precio
        document.getElementById('modalDate').innerText = `Fecha: ${new Date().toLocaleDateString()}`; // Fecha actual (puedes cambiar esto según tu lógica)
        document.getElementById('modalImage').src = "https://via.placeholder.com/150"; // Aquí puedes establecer una imagen predeterminada o cambiar la lógica para obtener la imagen real
        document.getElementById('modalQuantity').innerText = 1; // Cantidad por defecto

        // Mostrar el modal
        $('#customModal').modal('show'); // Esto muestra el modal

        // Añadir evento al botón de confirmar compra
        document.getElementById('confirmPurchaseButton').onclick = function() {
            alert("Compra de " + nombre + " realizada con éxito por un total de S/" + precio.toFixed(2));
            $('#customModal').modal('hide'); // Cierra el modal después de confirmar
        };
    };

    // Cambia la cantidad seleccionada
    window.cambiarCantidad = function (button, cambio) {
        const cantidadElement = button.parentElement.querySelector('.cantidad');
        let cantidad = parseInt(cantidadElement.textContent) + cambio;
        if (cantidad < 1) cantidad = 1; // Evita que sea menor a 1
        cantidadElement.textContent = cantidad;
    };

    // Añade productos al carrito
    window.añadirAlCarrito = function (nombre, precio, button) {
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
    };

    // Filtrado por fecha, precio o nombre
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            const criterio = this.textContent;
            let pulserasFiltradas = [...pulseras];

            if (criterio.includes('Fecha')) {
                pulserasFiltradas.sort((a, b) =>
                    criterio.includes('nuevo a antiguo') ? new Date(b.fecha) - new Date(a.fecha) :
                    new Date(a.fecha) - new Date(b.fecha)
                );
            } else if (criterio.includes('Precio')) {
                pulserasFiltradas.sort((a, b) =>
                    criterio.includes('menor a mayor') ? a.precio - b.precio : b.precio - a.precio
                );
            } else if (criterio.includes('Alfabéticamente')) {
                pulserasFiltradas.sort((a, b) =>
                    criterio.includes('A-Z') ? a.nombre.localeCompare(b.nombre) : b.nombre.localeCompare(a.nombre)
                );
            }

            renderPulseras(pulserasFiltradas); // Renderiza pulseras filtradas
        });
    });

    // Renderiza las pulseras al cargar la página
    renderPulseras(pulseras);
});

const pulseras = [
    { 
        nombre: "Pulsera minimalista de acero", 
        precio: 30.00, 
        material: "Acero inoxidable", 
        personalizable: false, 
        imagen: "https://i.pinimg.com/236x/1f/db/e8/1fdbe8afde2e37bf27688fd6cc911d6c.jpg" 
    },
    { 
        nombre: "Pulsera de cuentas naturales", 
        precio: 20.00, 
        material: "Piedras naturales", 
        personalizable: false, 
        imagen: "https://i.pinimg.com/236x/e2/cf/29/e2cf29a98a9a1a66a5330a03590d51c2.jpg" 
    },
    { 
        nombre: "Pulsera tejida con cierre ajustable", 
        precio: 15.00, 
        material: "Hilo encerado", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/2e/b9/a4/2eb9a420fdf6a03ddf1bf75eae65e272.jpg" 
    },
    { 
        nombre: "Pulsera con dijes colgantes", 
        precio: 35.00, 
        material: "Plata y cristal", 
        personalizable: false, 
        imagen: "https://i.pinimg.com/474x/d3/f7/99/d3f799f619cff26a95afa7e61070da20.jpg" 
    },
    { 
        nombre: "Pulsera trenzada con detalles dorados", 
        precio: 40.00, 
        material: "Cuero y latón", 
        personalizable: false, 
        imagen: "https://i.pinimg.com/236x/e5/40/49/e54049147acfbd3c8372db7887d90f29.jpg" 
    }
];

let carrito = JSON.parse(sessionStorage.getItem('carrito')) || []; // Carga el carrito desde sessionStorage

document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.getElementById('cardsContainer');

    // Renderiza las pulseras
    function renderPulseras(pulseras) {
        cardsContainer.innerHTML = ''; // Limpia el contenedor

        pulseras.forEach((pulsera, index) => {
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
                                onclick="openModal(${index})">
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
    window.openModal = function (index) {
        const pulsera = pulseras[index]; // Obtiene la pulsera correspondiente
        document.getElementById('modalName').innerText = pulsera.nombre; // Nombre del producto
        document.getElementById('modalPrice').innerText = `Precio: S/${pulsera.precio.toFixed(2)}`; // Precio
        document.getElementById('modalImage').src = pulsera.imagen; // Asigna la imagen al modal
        document.getElementById('modalMaterial').src=pulsera.material;//Material
        document.getElementById('modalQuantity').innerText = 1; // Cantidad por defecto

        // Mostrar el modal
        $('#customModal').modal('show'); // Esto muestra el modal

        // Añadir evento al botón de confirmar compra
        document.getElementById('confirmPurchaseButton').onclick = function() {
            alert("Compra de " + pulsera.nombre + " realizada con éxito por un total de S/" + pulsera.precio.toFixed(2));
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

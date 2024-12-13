const personalizados = [
    { 
        nombre: "Collar con iniciales grabadas", 
        precio: 45.00, 
        material: "Acero inoxidable", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/9f/52/b3/9f52b3222fd64bed5cb2c00b19fd3ee4.jpg" 
    },
    { 
        nombre: "Pulsera de pareja personalizada", 
        precio: 50.00, 
        material: "Cuero y acero", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/68/25/d8/6825d8c811898a38b0d303711683925a.jpg" 
    },
    { 
        nombre: "Anillo con coordenadas especiales", 
        precio: 60.00, 
        material: "Plata", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/1f/5f/f3/1f5ff357876cc6fea7c00a1a0c86c2ad.jpg" 
    },
    { 
        nombre: "Llavero grabado con mensaje único", 
        precio: 25.00, 
        material: "Aluminio", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/61/4c/ec/614cecd18a20596d7e8914bc5c629643.jpg" 
    },
    { 
        nombre: "Pulsera personalizada con charm", 
        precio: 35.00, 
        material: "Cuero y plata", 
        personalizable: true, 
        imagen: "https://i.pinimg.com/236x/d1/da/51/d1da512f67eaae5d67de7848e6715cad.jpg" 
    }
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
                            
                            <button type="button" class="btn btn-secondary mt-3" 
                                onclick="añadirAlCarrito('${item.nombre}', ${item.precio}, '${item.fecha}', 'inputPersonalizado-${item.nombre}', this, event)">
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
    window.añadirAlCarrito = function (nombre, precio, fecha, inputId, button, event) {
        event.preventDefault(); // Previene el comportamiento por defecto

        const textoPersonalizado = document.getElementById(inputId).value;

        // Obtener el producto correspondiente
        const producto = personalizados.find(item => item.nombre === nombre);

        // Mostrar información en el modal
        document.getElementById('modalNombre').innerText = producto.nombre;
        document.getElementById('modalPrecio').innerText = `Precio: S/${producto.precio.toFixed(2)}`;
        document.getElementById('modalMaterial').innerText = `Material: ${producto.material}`;
        document.getElementById('modalTextoPersonalizado').innerText = textoPersonalizado;
        document.getElementById('modalImagen').src = producto.imagen;

        // Mostrar el modal
        const modal = new bootstrap.Modal(document.getElementById('modalCompra'));
        modal.show();

        // Manejar la confirmación de compra
        document.getElementById('btnConfirmarCompra').onclick = function() {
            const direccionEnvio = document.getElementById('direccionEnvio').value;
            const cantidad = 1; // Puedes ajustar según sea necesario

            const productoExistente = carrito.find(item => item.nombre === nombre);

            if (productoExistente) {
                productoExistente.cantidad += cantidad; 
            } else {
                carrito.push({ nombre, precio, fecha, cantidad, textoPersonalizado, direccionEnvio }); 
            }

            sessionStorage.setItem('carrito', JSON.stringify(carrito)); 
            console.log(carrito); 

            // Cerrar el modal
            modal.hide();
        };
    };

    // Renderiza los personalizados al cargar la página
    renderPersonalizados(personalizados);
});

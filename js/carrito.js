let carrito = JSON.parse(localStorage.getItem('carrito')) || []; // Cargar carrito desde localStorage

// Función para añadir productos al carrito
function añadirAlCarrito(nombre, precio, talla, button) {
    const cantidad = parseInt(button.parentElement.querySelector('.cantidad').textContent);

    // Verifica si ya existe en el carrito
    const productoExistente = carrito.find(item => item.nombre === nombre);

    if (productoExistente) {
        productoExistente.cantidad += cantidad; // Actualiza cantidad
    } else {
        carrito.push({ nombre, precio, talla, cantidad }); // Añade nuevo producto
    }

    localStorage.setItem('carrito', JSON.stringify(carrito)); // Guardar carrito en localStorage
    console.log(carrito); // Muestra el carrito en la consola
}
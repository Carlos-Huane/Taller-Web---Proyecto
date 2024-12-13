document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('.product-checkbox:checked');
    if (checkboxes.length === 0) {
        alert("Por favor, selecciona al menos un producto para eliminar.");
        return;
    }

    checkboxes.forEach(checkbox => {
        const productName = checkbox.getAttribute('data-product-name');
        // Aquí puedes agregar la lógica para eliminar el producto de la base de datos si es necesario
        // Por ejemplo, hacer una llamada AJAX para eliminar el producto del servidor

        // Mostrar un mensaje de producto eliminado
        alert(`Producto "${productName}" eliminado.`);
    });

    // Cerrar el modal
    $('#deleteProductModal').modal('hide');
});
    
// Manejar el clic en el botón de modificar producto
document.querySelectorAll('.modify-product-button').forEach(button => {
    button.addEventListener('click', function() {
        const productName = this.parentElement.getAttribute('data-product-name');
        const productPrice = this.parentElement.getAttribute('data-product-price');
        const productTalla = this.parentElement.getAttribute('data-product-talla');
        const productImage = this.parentElement.getAttribute('data-product-imagen');

        // Cargar la información del producto en el formulario de edición
        document.getElementById('editProductName').value = productName;
        document.getElementById('editProductPrice').value = productPrice;
        document.getElementById('editProductTalla').value = productTalla;
        document.getElementById('editProductImage').value = productImage;

        // Mostrar el modal de edición
        $('#editProductModal').modal('show');
    });
});

// Manejar el clic en el botón de guardar cambios
document.getElementById('saveChangesButton').addEventListener('click', function() {
    // Aquí puedes agregar la lógica para guardar los cambios en la base de datos
    // Por ejemplo, hacer una llamada AJAX para actualizar el producto en el servidor

    // Mostrar un mensaje de confirmación
    alert("Los cambios han sido guardados.");

    // Cerrar el modal de edición
    $('#editProductModal').modal('hide');
});
// admin.js
// Manejar el clic en el botón de guardar cambios
document.getElementById('saveChangesButton').addEventListener('click', function() {
    // Aquí puedes agregar la lógica para guardar los cambios en la base de datos
    // Por ejemplo, hacer una llamada AJAX para actualizar el producto en el servidor

    // Mostrar un mensaje de confirmación
    alert("Cambios realizados con éxito.");

    // Cerrar el modal de edición
    $('#editProductModal').modal('hide');
});


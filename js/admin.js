// Aquí puedes agregar funcionalidad para manejar los botones
document.addEventListener('DOMContentLoaded', function () {
    const eliminarBtns = document.querySelectorAll('.btn-danger');
    const actualizarBtns = document.querySelectorAll('.btn-warning');
    const modificarBtns = document.querySelectorAll('.btn-info');

    eliminarBtns.forEach(btn => btn.addEventListener('click', () => alert('Eliminar item')));
    actualizarBtns.forEach(btn => btn.addEventListener('click', () => alert('Actualizar item')));
    modificarBtns.forEach(btn => btn.addEventListener('click', () => alert('Modificar item')));
});

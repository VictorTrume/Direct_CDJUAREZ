document.querySelectorAll('.btn-comentario').forEach(boton => {
    boton.addEventListener('click', function () {
       // Subimos al contenedor padre general
        const cont = this.closest('.contLugar');

        // Buscamos la comment-section dentro del mismo contenedor
        const seccion = cont.querySelector('.comment-section');
        seccion.classList.toggle('aparecer');

    });
});

function limpiarFiltros() {
    document.querySelector("input[name='buscar']").value = "";
    document.querySelector("input[name='direccion']").value = "";
    document.querySelector("form").submit();
}
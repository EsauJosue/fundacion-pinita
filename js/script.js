function regresar(){
    window.history.back();
}

var btnAbrirPopup = document.querySelector('.btn-abrir-popup'), 
    overlay = document.querySelector('.overlay'),
    popup = document.querySelector('.popup'),
    btnCerrarPopup = document.querySelector('.btn-cerrar-popup');

    btnAbrirPopup.addEventListener('click', function(){
        overlay.classList.add('active');
        popup.classList.add('active');
    })

      btnCerrarPopup.addEventListener('click', function(){
        overlay.classList.remove('active');
        popup.classList.remove('active');

    })
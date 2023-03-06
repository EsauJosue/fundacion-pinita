function regresar(){
    window.history.back();
}

function confirmacion(){
    var decision = confirm("¿Son correctos los datos?");    
    if(decision==true){
        return true;
    }else{ 
       return false; 
    }
}

function abrirPopup(element){
    const popup = document.querySelector(element);
    const overlay = popup.closest('.overlay');
    popup.classList.add('popup');
    popup.classList.add('active');
    overlay.classList.add('active');
}

function cerrarPopup(element){
   
        const popup = document.querySelector(element);
        const overlay = popup.closest('.overlay');
        overlay.classList.remove('active');
        popup.classList.remove('active');
        popup.classList.remove('popup');
    }

// function abrirPopup(element){
//     const overlay = document.createElement('div');
//     overlay.innerHTML('<div>Hola Mundo</div>')
//     let popup = document.querySelector(element);
//     // overlay.classList.add('overlay');
   
//     // overlay.append(popup);

// //     popup.classList.add('popup');
// //     popup.classList.add('active');
// //     overlay.classList.add('active');
// }
// function cerrarPopup(element){
   
//     var popup = document.querySelector(element);
//     overlay.classList.remove('active');
//     popup.classList.remove('active');
//     popup.classList.remove('popup');
// }

    // var btnAbrirPopup = document.querySelector(".btn-abrir-popup"), 
    // overlay = document.querySelector('.overlay'),
    // popup = document.querySelector('.popup'),
    // btnCerrarPopup = document.querySelector('.btn-cerrar-popup');


    // btnAbrirPopup.addEventListener('click', function(){
    //     overlay.classList.add('active');
    //     popup.classList.add('active');
    // })

    //   btnCerrarPopup.addEventListener('click', function(){
    //     overlay.classList.remove('active');
    //     popup.classList.remove('active');

    // })
    




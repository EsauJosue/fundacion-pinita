function regresar(){
    window.history.back();
}

var selectReport = document.querySelector('#verReporte');
if(selectReport){
    selectReport.addEventListener('click',function(){
        var miSelect = document.getElementById("select_report");
        var opcionSeleccionada = miSelect.value;
        
        if(opcionSeleccionada == "beneficiarios"){
            document.querySelector('#verReporte').href="reports/report-beneficiarios.php";
        }
        if(opcionSeleccionada == "benefactores"){
            document.querySelector('#verReporte').href="reports/report-benefactores.php";
        }
        if(opcionSeleccionada == "apoyos"){
            document.querySelector('#verReporte').href="reports/report-apoyos.php";
        }
        
    });
}
var registroStaff = document.querySelector('#registrarStaff');
if(registroStaff){
    registroStaff.addEventListener('click',function(){

        const password = document.querySelector('#txtPass1').value;
        console.log('dio click');
        if (/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/.test(password)) {
        console.log("La contraseña cumple con los requisitos");
        return true;
        } else {
        console.log("La contraseña no cumple con los requisitos");
        return false;
        
        }
    
    });
}

function passAdmin(){
    alert('Hola');
 var contraseña = prompt('Ingrese la contraseña de administrador');
 if(contraseña == '123456789'){
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

function abrirPopupConfirm(element,phpurl,id,tipoop){

    const popup = document.querySelector(element);
    const overlay = popup.closest('.overlay');
    popup.classList.add('popup');
    popup.classList.add('active');
    overlay.classList.add('active');
    overlay.style.zIndex=9999;
    const div = document.querySelector('.content__confirm__box-body-buttons');
    const elemento = document.querySelector('.content__confirm__box-body-buttons-ok');
    const operacion = document.querySelector('.content__confirm__box-body-operation');
    const tipo_op = document.querySelector('.content__confirm__box-body-operation-tipo');
    if(!elemento){
        const link = document.createElement("a");
        link.classList.add('content__confirm__box-body-buttons-ok');
        link.textContent="Confirmar";
        link.href= phpurl + id;
        div.appendChild(link);

    }
    if(!tipo_op){
     const tipo = document.createElement("p");
     tipo.classList.add('content__confirm__box-body-operation-tipo');
     tipo.textContent=tipoop;
     operacion.appendChild(tipo);
        if(tipoop == 'Eliminar Registro' || tipoop == 'Rechazar Apoyo'){
         tipo.style.color = '#cf050c';
        }else{
         tipo.style.color = '#009abf';
        }
    }  else{
        tipo_op.remove();
        abrirPopupConfirm(element,phpurl,id,tipoop);
    }
     
}
function confirmacion(){
    var decision = confirm("¿Son correctos los datos?");    
    if(decision==true){
        return true;
    }else{ 
       return false; 
    }
}
function cerrarPopup(element){
   
        const popup = document.querySelector(element);
        const overlay = popup.closest('.overlay');
        overlay.classList.remove('active');
        popup.classList.remove('active');
        popup.classList.remove('popup');
    }


function calcularTotal(precio,idCantidad,idTotal){
    var cantidad = document.getElementById(idCantidad).value;
    var total = cantidad * precio;
    document.getElementById(idTotal).innerHTML = total;
    console.log(idCantidad,idTotal);
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
    




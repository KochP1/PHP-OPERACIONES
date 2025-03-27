// Función que se ejecuta al cargar la página para verificar el estado guardado
window.addEventListener('DOMContentLoaded', (event) => {
    const activeSumIndex = localStorage.getItem('activeSumIndex');
    if (activeSumIndex !== null) {
        deploySuma(activeSumIndex, true);
    }
});

function deploySuma(index, fromStorage = false) {
    const formSuma = document.getElementById(`sum-form-${index}`);

    if (formSuma.classList.contains('resuelta')) {
        return false;
    } else {
        const sumaContainer = document.getElementById(`${index}`);
        const checkContainers = document.querySelectorAll('.checked__container');
        let otrasSumas = document.querySelectorAll('.flex-suma__container');
        const gridContainer = document.getElementById('grid-container');
        let nums = document.querySelectorAll('.digito');
        const volver = document.getElementById(`volver-container-${index}`);
        const btnEnviar = document.getElementById(`send-container-${index}`);
        const inputsContainer = document.getElementById(`btns-container-${index}`);
        const inicio = document.getElementById('inicio');
        const logo = document.getElementById('logo');
        const span1 = document.querySelectorAll(`.digito-1-${index}`);
        const span2 = document.querySelectorAll(`.digito-2-${index}`);
        const body = document.getElementById('d-body');

        const digito1Array = [];

        for (let i = 0; i < span1.length; i++) {
            digito1Array.push(span1[i].textContent);
        }
        const digito1 = digito1Array[0] + digito1Array[1];
        const num1 = parseInt(digito1);

        for (let i = 0; i < span2.length; i++) {
            digito1Array.push(span2[i].textContent);
        }

        const digito2 = digito1Array[2] + digito1Array[3];
        const num2 = parseInt(digito2);

        const sumaResult = num1 + num2;
        const cantidadDigitos = String(sumaResult).length;

        if (cantidadDigitos === 3) {
            console.log(document.getElementById(`respuesta-3-${index}`));
            document.getElementById(`respuesta-3-${index}`).type = 'number';
            console.log(`El resultado tiene ${cantidadDigitos} digitos`);
        }

        for (let i = 0; i < nums.length; i++) {
            nums[i].classList.add('display-font')
        }
    
        for (let i = 0; i < otrasSumas.length; i++) {
            otrasSumas[i].style.display = 'none';
        }
    
        for (let i = 0; i < checkContainers.length; i++) {
            checkContainers[i].style.display = 'none';
        }
    
        gridContainer.classList.add('display-sum__container')
        sumaContainer.style.display = 'flex';
        sumaContainer.style.marginLeft = '70px';
        sumaContainer.classList.add('suma-border__container');
    
        volver.style.display = 'flex';
        btnEnviar.style.display = 'flex';
        inputsContainer.style.display = 'flex';
        inicio.removeAttribute('href');
        inicio.style.cursor = 'pointer';
        logo.removeAttribute('href');
        logo.style.cursor = 'pointer';
        formSuma.style.marginTop = '150px';
        body.style.backgroundColor = '#fff';
        
        // Solo almacenar si no viene del localStorage
        if (!fromStorage) {
            localStorage.setItem('activeSumIndex', index);
        }
    }
}

function volver() {
    const activeSumIndex = localStorage.getItem('activeSumIndex');
    if (activeSumIndex) {
        const sumaContainer = document.getElementById(`${activeSumIndex}`);
        const otrasSumas = document.querySelectorAll('.flex-suma__container');
        const gridContainer = document.getElementById('grid-container');
        const nums = document.querySelectorAll('.digito');
        const volver = document.getElementById(`volver-container-${activeSumIndex}`);
        const btnEnviar = document.getElementById(`send-container-${activeSumIndex}`);
        const inputsContainer = document.getElementById(`btns-container-${activeSumIndex}`);
        const inicio = document.getElementById('inicio');
        const logo = document.getElementById('logo');
        const formSuma = document.getElementById(`sum-form-${activeSumIndex}`);
        const body = document.getElementById('d-body');
        
        for (let i = 0; i < nums.length; i++) {
            nums[i].classList.remove('display-font');
        }
        
        for (let i = 0; i < otrasSumas.length; i++) {
            otrasSumas[i].style.display = 'flex';
        }
        
        gridContainer.classList.remove('display-sum__container');
        sumaContainer.style.display = 'flex';
        sumaContainer.style.marginLeft = '';
        sumaContainer.classList.remove('suma-border__container');
        
        volver.style.display = 'none';
        btnEnviar.style.display = 'none';
        inputsContainer.style.display = 'none';
        inicio.setAttribute('href', 'dashboard.php');
        logo.setAttribute('href', 'dashboard.php');
        formSuma.style.marginTop = '0px';
        body.style.backgroundColor = '#faffe0';

        localStorage.removeItem('activeSumIndex');
    }

    window.location.reload();
}

const mediaQuery = window.matchMedia('(max-width: 810px)');

function handleScreenChange(e) {
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.onkeydown = e.matches ? null : () => false;
    });
}

// Ejecutar al cambio y al cargar
mediaQuery.addListener(handleScreenChange);
handleScreenChange(mediaQuery);
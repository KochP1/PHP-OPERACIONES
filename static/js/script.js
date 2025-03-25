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

        localStorage.removeItem('activeSumIndex');
    }

    window.location.reload();
}
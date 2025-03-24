function deploySuma(index) {
    const sumaContainer = document.getElementById(`${index}`);
    const checkContainers = document.querySelectorAll('.checked__container');
    let otrasSumas = document.querySelectorAll('.flex-suma__container');
    const gridContainer = document.getElementById('grid-container');
    let nums = document.querySelectorAll('.digito');
    const volver = document.getElementById(`volver-container-${index}`);
    const inputsContainer = document.getElementById(`btns-container-${index}`)

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

    inputsContainer.style.display = 'flex';
    
}

function volver() {
    window.location.reload();
}
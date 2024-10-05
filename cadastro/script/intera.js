document.querySelector('#nome').addEventListener('change', (e)=>{
    const valor = e.target.value;
    document.querySelector('#valNome').innerHTML = valor;
})

//Interações das dots
let valDot = 0;
const progress = document.querySelector('#progress');

function intDots(val){
    valDot += val;
    console.log(valDot);
    progress.style.width = `${valDot}%`;
    
}
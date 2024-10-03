document.querySelector('#nome').addEventListener('change', (e)=>{
    const valor = e.target.value;
    document.querySelector('#valNome').innerHTML = valor;
})
document.querySelector('#nome').addEventListener('change', (e)=>{
    const valor = e.target.value;
    document.querySelector('#valNome').innerHTML = valor;
})

//Interações das dots
let valDot = 0;
const progress = document.querySelector('#progress');

//dots
const dot1 = document.querySelector('#dot1');
const dot2 = document.querySelector('#dot2');
const dot3 = document.querySelector('#dot3');
function intDots(val){
    if(valDot>=0){
        valDot += val;
        console.log(valDot);
        progress.style.width = `${valDot}%`;

        if (valDot==0){
            dot1.style.backgroundColor = 'var(--third-color)';
            dot1.style.color = 'var(--primary-color)';
            dot1.innerHTML = '1';
        }

        if(valDot==50){
            dot1.style.backgroundColor = 'var(--primary-color)';
            dot1.style.color = 'var(--third-color)';
            dot1.innerHTML = '✔';

            //Retorna a 2
            dot2.style.backgroundColor = 'var(--third-color)';
            dot2.style.color = 'var(--primary-color)';
            dot2.innerHTML = '2';
        }
        if(valDot==100){
            //retorna a 1
            dot2.style.backgroundColor = 'var(--primary-color)';
            dot2.style.color = 'var(--third-color)';
            dot2.innerHTML = '✔';
        }
    }   
    
}

//Interação do numero de telefone 

const numTel = document.querySelector('#num-tel');

numTel.addEventListener('change',()=>{
    
});


function ModoNum(){
    let tamNum = numTel.value.length;
    if(tamNum===9){

        
            let priNum = numTel.value.slice(0,1)
            let priPart = numTel.value.slice(1,5);
            let segPart = numTel.value.slice(5);
            let numComple = `${priNum} ${priPart}-${segPart}`
            console.log(numComple);


    
        numTel.value = numComple;
    }

}
//Seleciona os botões
const btnNext = document.querySelector('#next');
const btnBack = document.querySelector('#back');

//pegar etapas
const etapa1 = document.querySelector('#etapa1');
const etapa2 = document.querySelector('#etapa2');
const etapa3 = document.querySelector('#etapa3');
const etapaEnd = document.querySelector('#etapaEnd');

let counter = 1;
//Evento do botão next
btnNext.addEventListener('click',()=>{
    counter ++;
    btnBack.style.display = 'block';
    if(counter ==3 ){
        btnNext.innerHTML = 'Concluir';
    }else{
        btnNext.innerHTML = 'Próximo';
    }
    if(counter==4){
        btnBack.style.display = 'none';
        btnNext.style.display = 'none';
    }
    StepEtapa(counter);
    intDots(50);
})

//Evendo de botão back
btnBack.addEventListener('click',()=>{
    counter --;
    if(counter <= 1){
        btnBack.style.display = 'none';
    }
    if(counter!=3){
        btnNext.innerHTML = 'Próximo';
    }
    StepEtapa(counter);
    intDots(-50);
})

//Pular as etapas
function StepEtapa(value){
    if(value==1){
        etapa1.style.display = 'flex';
        //Apaga
        etapa2.style.display = 'none';
        etapa3.style.display = 'none';
        etapaEnd.style.display = 'none';


    }
    
    if(value==2){
        etapa2.style.display = 'flex';
        //Apaga
        etapa1.style.display = 'none';
        etapa3.style.display = 'none';
        etapaEnd.style.display = 'none';




    }

    if(value==3){
        etapa3.style.display = 'flex';
        //Apaga
        etapa1.style.display = 'none';
        etapa2.style.display = 'none';
        etapaEnd.style.display = 'none';

    }

    if(value==4){
        etapaEnd.style.display = 'flex';
        //Apaga
        etapa1.style.display = 'none';
        etapa2.style.display = 'none';
        etapa3.style.display = 'none';  
        document.querySelector('#dots').style.display = 'none';


    }
    
}

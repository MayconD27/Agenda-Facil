//Seleciona os botões
const btnNext = document.querySelector('#next');
const btnBack = document.querySelector('#back');

//pegar etapas
const etapa1 = document.querySelector('#etapa1');
const etapa2 = document.querySelector('#etapa2');
const etapa3 = document.querySelector('#etapa3');
const etapaEnd = document.querySelector('#etapaEnd');

//reset

const reset = document.querySelector('#reset');


let counter = 1;
//Evento do botão next

//Reseta
reset.addEventListener('click',()=>{
    counter =1;
    

    etapa1.style.display = 'flex';
    //Apaga
    etapa2.style.display = 'none';
    etapa3.style.display = 'none';
    etapaEnd.style.display = 'none';
    //Retorna a barra
    document.querySelector('#dots').style.display = 'flex';
    btnNext.style.display='block';
    
    intDots(-150);
    dot2.style.backgroundColor = 'var(--third-color)';
    dot2.style.color = 'var(--primary-color)';
    dot2.innerHTML = '2';
})


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
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
reset.addEventListener('click',()=>{
    counter =1;
})
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


// Seleciona o elemento de inputs
const dataCadastro = document.querySelector('#dataCadastro');
const horariosDisponiveisSelect = document.querySelector('#horariosDisponiveis');
const quantidadeSelect = document.querySelector('#quantidadeHorarios');


dataCadastro.addEventListener('change', () => {
    const valData = dataCadastro.value;

    // Se não houver data selecionada, sai da função
    if (!valData) return;

    // Faz uma requisição ao servidor para obter os horários disponíveis nessa data
    fetch(`../consulta.php?data=${valData}`)
        .then(response => {
            // Verifica se a resposta da requisição está ok
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json(); // Converte a resposta para JSON
        })
        .then(({ success, data, error }) => {
            // Se a consulta não foi bem-sucedida, exibe o erro
            if (!success) {
                console.error('Erro:', error);
                return;
            }
            updateHorariosSelect(data);
        })
        .catch(error => console.error('Erro na requisição:', error)); // Captura e exibe erros da requisição
});


const updateHorariosSelect = (horarios) => {

    horariosDisponiveisSelect.innerHTML = '<option value="">Selecione um horário</option>';
    horarios.forEach(horario => {
        const option = document.createElement('option'); 
        option.value = horario;
        option.textContent = horario;
        horariosDisponiveisSelect.appendChild(option);
    });
};

// Adiciona um evento de mudança no select de horários disponíveis

// Adiciona o listener para o select de horários
horariosDisponiveisSelect.addEventListener('change', () => {
    const horarioSelecionado = horariosDisponiveisSelect.value;
    const valData = dataCadastro.value;

    if (!horarioSelecionado || !valData) return;

    fetch(`../consulta_qnt_horario.php?data=${valData}&horario=${horarioSelecionado}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(({ success, quantidade, error }) => {
            if (!success) {
                console.error('Erro:', error);
                return;
            }
            updateQuantidadeSelect(quantidade);
        })
        .catch(error => console.error('Erro na requisição para quantidade:', error));
});

// Atualiza o select de quantidade
const updateQuantidadeSelect = (quantidade) => {
    quantidadeSelect.innerHTML = '<option value="">Selecione a quantidade</option>';
    for (let i = 1; i <= quantidade; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        quantidadeSelect.appendChild(option);
    }
};

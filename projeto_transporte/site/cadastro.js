// =====================================
// REFERÊNCIAS
// =====================================

const linhaModelo =
document.querySelector(".linha-modelo");

const corpoTabela =
document.getElementById("corpoTabela");


// =====================================
// FUNÇÃO CRIAR LINHA
// =====================================

function criarLinha(){

    let novaLinha =
    linhaModelo.cloneNode(true);

    // REMOVE classe modelo
    novaLinha.classList.remove("linha-modelo");

    // MOSTRA linha
    novaLinha.style.display = "table-row";

    // LIMPA INPUTS
    novaLinha
    .querySelectorAll("input")
    .forEach(input => {

        input.value = "";

    });

    // RESETA SELECTS
    novaLinha
    .querySelectorAll("select")
    .forEach(select => {

        select.selectedIndex = 0;

    });

    // ADICIONA
    corpoTabela.appendChild(novaLinha);

}


// =====================================
// PRIMEIRA LINHA
// =====================================

criarLinha();


// =====================================
// ADICIONAR LINHAS
// =====================================

document
.getElementById("btnAdd")
.addEventListener("click", function(){

    let quantidade =
    parseInt(
        document.getElementById("quantidadeLinhas").value
    );

    // SE INVÁLIDO
    if(isNaN(quantidade) || quantidade < 1){

        quantidade = 1;

    }

    // ADICIONA VÁRIAS
    for(let i = 0; i < quantidade; i++){

        criarLinha();

    }

});


// =====================================
// REMOVER
// =====================================

document.addEventListener("click", function(e){

    let botao =
    e.target.closest(".btn-remover");

    if(botao){

        let linha =
        botao.closest("tr");

        linha.remove();

    }

});
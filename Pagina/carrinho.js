let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.icon-close');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', () => {
    body.classList.add('active')
})

closeShopping.addEventListener('click', () => {
    body.classList.remove('active')
})

let produtos = [
   
];


let listCards = [];
function initApp() {
    produtos.forEach((value, key) => {
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
        <a href="../Produtos/${value.telaP}"><img src="../imagem/${value.imagem}"/></a>
        <div class="titulo">${value.nome}</div>
        <div class="precos">${value.preço.toLocaleString()}</div>
        <button class="btn-produtc" onclick="addToCard(${key})">adicionar ao carrinho</button>
        `;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        listCards[key] = produtos[key];
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
}
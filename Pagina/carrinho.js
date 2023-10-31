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
    {
        ID: 1,
        nome: 'Chá Matte Leão',
        imagem: '1.png',
        preço: 12.90,
        telaP: '../Produtos/telaProduto1.php',
    },
    {
        ID: 2,
        nome: 'Chá Verde Leão',
        imagem: '2.png',
        preço: 9.30,
        telaP: '../Produtos/telaProduto2.php',
    },
    {
        ID: 3,
        nome: 'Chá de Capim Cidreira Leão',
        imagem: '3.webp',
        preço: 26.50,
        telaP: '../Produtos/telaProduto3.php',
    },
    {
        ID: 4,
        nome: 'Chá de Hortelã',
        imagem: '4.png',
        preço: 22.00,
        telaP: '../Produtos/telaProduto4.php',
    },
    {
        ID: 5,
        nome: 'Ice Tea Pessego',
        imagem: '5.jpg',
        preço: 9.99,
        telaP: '../Produtos/telaProduto5.php',
    },
    {
        ID: 6,
        nome: 'Chá Preto Leão',
        imagem: '6.jpg',
        preço: 6.45,
        telaP: '../Produtos/telaProduto6.php',
    }
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
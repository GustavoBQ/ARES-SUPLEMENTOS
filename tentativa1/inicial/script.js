// Seleciona todos os elementos com o atributo data-anime
const target = document.querySelectorAll('[data-anime]');
const animationClass = 'animate';

// Função que adiciona ou remove a classe de animação conforme a rolagem da página
function animeScroll() {
    const windowTop = window.pageYOffset + ((window.innerHeight * 3) / 4);
    target.forEach(function(element) {
        if((windowTop) > element.offsetTop) {
            element.classList.add(animationClass);
        } else {
            element.classList.remove(animationClass);
        }
    });
}

// Adiciona o evento de rolagem da página para chamar a função de animação
window.addEventListener('scroll', function() {
    animeScroll();
});

// Chama a função uma vez para garantir que os elementos visíveis sejam animados ao carregar a página
animeScroll();

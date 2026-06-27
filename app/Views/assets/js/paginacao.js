console.log("paginacao.js carregado");

export function paginacao() {
  const cards = Array.from(document.querySelectorAll(".card-home"));
  const dots = document.querySelectorAll(".dot");
  const cardsPerPage = 16;
  let cardsFiltrados = cards;


  function mostrarPagina(pagina) {
    cards.forEach(card => {
      card.style.display = "none";
    });
    const inicio = pagina * cardsPerPage;
    const fim = inicio + cardsPerPage;
    cardsFiltrados.slice(inicio, fim).forEach(card => {
      card.style.display = "flex";
    });
  }


  function atualizarBolinhas() {
    const totalPages = Math.ceil(cardsFiltrados.length / cardsPerPage);
    dots.forEach((dot, index) => {
      if(index >= totalPages){
        dot.style.display = "none";
      } else {
        dot.style.display = "block";
      }
    });
  }

  window.atualizarPaginacao = function(novosCards){
    cardsFiltrados = novosCards;
    atualizarBolinhas();
    mostrarPagina(0);
  };

  dots.forEach((dot,index)=>{
    dot.addEventListener("click",()=>{
      dots.forEach(d=>d.classList.remove("active"));
      dot.classList.add("active");
      mostrarPagina(index);
    });
  });

  atualizarBolinhas();
  mostrarPagina(0);

}
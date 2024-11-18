const textLabel = {
  title: 'Título',
  description: 'Descrição',
  category: 'Categoria'
};

window.addEventListener("load", function () {
  const params = new URLSearchParams(window.location.search);
  const output = document.getElementById("output");
  params.forEach((value, key) => {
    const p = document.createElement("p");
    p.textContent = `${textLabel[key]}: ${value}`;
    output.appendChild(p);
  });
});

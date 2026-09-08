const productos = [
  { nombre: "Ja 4 Nighmare", precio: 9000, imagen: "img/JA-4.jpg" },
  { nombre: "Nike Free Metcon 7 - Black White", precio: 8800, imagen: "img/NIKE-FREE-METCON-7.jpg" },
  { nombre: "Nike Giannis Immortality 5", precio: 6500, imagen: "img/GIANNIS-IMMORTALITY-5.jpg" },
  { nombre: "Nike SB Blazer", precio: 7500, imagen: "img/NIKE-SB-ZOOM-BLAZER-MID.jpg" }
];


////formatear precio (Elvira)
function formatearPrecio(numero) {
    return "RD$" + numero.toLocaleString("en-US");
}

function renderDestacados(productos) {
  const contenedor = document.querySelector(".destacados__grid");
  contenedor.innerHTML = "";

  for (const producto of productos) {
    const tarjeta = document.createElement("article");
    tarjeta.classList.add("card");

    tarjeta.innerHTML = `
      <img class="card__imagen" src="${producto.imagen}" alt="${producto.nombre}">
      <h3 class="card__titulo">${producto.nombre}</h3>
      <p class="card__precio">${formatearPrecio(producto.precio)}</p>
    `;

    contenedor.appendChild(tarjeta);
  }
}

renderDestacados(productos);

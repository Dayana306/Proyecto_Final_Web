
const pedidos = JSON.parse(localStorage.getItem("pedidos")) || [];

const listaPedidos = document.getElementById("listaPedidos");

if (pedidos.length === 0) {

    listaPedidos.innerHTML = `

    <div class="pedido">

        <h2>No existen pedidos registrados.</h2>

    </div>

    `;

} else {

    pedidos.forEach(function (pedido) {

        let productosHTML = "";

        pedido.productos.forEach(function (producto) {

            let subtotal = producto.precio * producto.cantidad;

            productosHTML += `

    <div class="producto">

        <span>
        ${producto.nombre} x${producto.cantidad}
        </span>

        <span>
        S/ ${subtotal.toFixed(2)}
        </span>

    </div>

    `;

        });

        listaPedidos.innerHTML += `

        <div class="pedido">

            <h2>Pedido #${pedido.numero}</h2>

            <p><strong>Cliente:</strong> ${pedido.cliente}</p>

            <p><strong>Dirección:</strong> ${pedido.direccion}</p>

            <p><strong>Estado:</strong> <span class="proceso">${pedido.estado}</span></p>

            <br>

            <strong>Productos</strong>

            <br><br>

            ${productosHTML}

            <div style="margin-top:15px;
                        padding-top:10px;
                        border-top:2px solid orange;
                        display:flex;
                        justify-content:space-between;
                        font-weight:bold;">

                <span>TOTAL</span>

                <span>S/ ${pedido.total.toFixed(2)}</span>

            </div>

        </div>

        `;

    });

}

if (localStorage.getItem("modo") == "oscuro") {

    document.body.classList.add("dark");

}
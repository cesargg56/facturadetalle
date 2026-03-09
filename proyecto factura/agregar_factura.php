<?php
require_once 'conexion.inc.php';
require_once 'RepositorioFactura.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $idEmpleado = $_POST['empleado'];
        $idCliente = $_POST['cliente'];
        $productos = $_POST['productos'] ?? [];
        
        if (empty($productos)) {
            throw new Exception("No hay productos seleccionados");
        }
        
        $idFactura = RepositorioFacturas::agregarFactura($idEmpleado, $idCliente, $productos);
        
        header("Location: FacturaEsquema.php?idFactura=" . $idFactura);
        exit;
        
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Compra</title>
</head>
<body>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            color: #e74c3c;
            margin: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #e74c3c;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: #c0392b;
        }

        .search-results {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            width: calc(100% - 40px);
            z-index: 1000;
            display: none;
        }

        .search-item {
            padding: 8px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .search-item:hover {
            background-color: #f5f5f5;
        }

        .productos-lista {
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .producto-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .producto-item:last-child {
            border-bottom: none;
        }

        .remove-producto {
            color: #e74c3c;
            cursor: pointer;
            padding: 5px;
        }
    </style>
    <div class="container">
        <header class="header">
            <h1>Realizar Compra</h1>
        </header>
        <form id="compraForm" action="agregarFactura.php" method="post">
            <div class="form-group">
                <label for="empleado">Id Empleado:</label>
                <input type="text" id="empleado" name="empleado" required>
            </div>
            <div class="form-group">
                <label for="cliente">Id Cliente:</label>
                <input type="text" id="cliente" name="cliente" required>
            </div>
            <div class="form-group">
                <label for="buscarProducto">Buscar Producto:</label>
                <input type="text" id="buscarProducto" autocomplete="off">
                <div id="searchResults" class="search-results"></div>
            </div>

            <div id="productosSeleccionados" class="productos-lista">
                <h3>Productos Seleccionados</h3>
            </div>

            <button type="submit" class="button">Generar Factura</button>
            <a href="correo.php" class="button">Regresar</a>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const buscarProducto = document.getElementById('buscarProducto');
    const searchResults = document.getElementById('searchResults');
    const productosSeleccionados = document.getElementById('productosSeleccionados');
    let productos = [];

    buscarProducto.addEventListener('input', function() {
        const searchTerm = this.value;
        if (searchTerm.length < 1) {
            searchResults.style.display = 'none';
            return;
        }

        fetch(`buscarProductos.php?term=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                searchResults.style.display = 'block';
                
                data.forEach(producto => {
                    const div = document.createElement('div');
                    div.className = 'search-item';
                    div.textContent = `${producto.nombre} - Q${producto.precio} (${producto.unidad})`;
                    div.onclick = () => agregarProducto(producto);
                    searchResults.appendChild(div);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function agregarProducto(producto) {
        const productoExistente = productos.find(p => p.id === producto.id);
        if (productoExistente) {
            alert('Este producto ya está en la lista');
            return;
        }

        producto.cantidad = 1;
        productos.push(producto);
        actualizarListaProductos();
        buscarProducto.value = '';
        searchResults.style.display = 'none';
    }

    function actualizarListaProductos() {
        productosSeleccionados.innerHTML = '<h3>Productos Seleccionados</h3>';
        let total = 0;
        
        productos.forEach((producto, index) => {
            const subtotal = producto.precio * producto.cantidad;
            total += subtotal;

            const div = document.createElement('div');
            div.className = 'producto-item';
            div.innerHTML = `
                <span>${producto.nombre} - Q${producto.precio} (${producto.unidad})</span>
                <div class="producto-controles">
                    <input type="number" 
                           value="${producto.cantidad}" 
                           min="1" 
                           onchange="actualizarCantidad(${index}, this.value)"
                           style="width: 60px; margin: 0 10px;">
                    <span>Subtotal: Q${subtotal.toFixed(2)}</span>
                    <span class="remove-producto" onclick="eliminarProducto(${index})">✖</span>
                </div>
                <input type="hidden" name="productos[${index}][id]" value="${producto.id}">
                <input type="hidden" name="productos[${index}][cantidad]" value="${producto.cantidad}">
                <input type="hidden" name="productos[${index}][precio]" value="${producto.precio}">
            `;
            productosSeleccionados.appendChild(div);
        });

        if (productos.length > 0) {
            const totalDiv = document.createElement('div');
            totalDiv.className = 'total-compra';
            totalDiv.innerHTML = `<strong>Total: Q${total.toFixed(2)}</strong>`;
            productosSeleccionados.appendChild(totalDiv);
        }
    }

    window.eliminarProducto = function(index) {
        productos.splice(index, 1);
        actualizarListaProductos();
    };

    window.actualizarCantidad = function(index, cantidad) {
        cantidad = parseInt(cantidad);
        if (cantidad < 1) cantidad = 1;
        productos[index].cantidad = cantidad;
        actualizarListaProductos();
    };

    document.addEventListener('click', function(e) {
        if (!searchResults.contains(e.target) && e.target !== buscarProducto) {
            searchResults.style.display = 'none';
        }
    });

    document.getElementById('compraForm').addEventListener('submit', function(e) {
        if (productos.length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un producto a la compra');
            return;
        }
    });
});
    </script>
</body>
</html>
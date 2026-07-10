CREATE TABLE detalle_pedido(

    id INT AUTO_INCREMENT PRIMARY KEY,

    id_pedido INT,

    id_producto INT,

    cantidad INT,

    precio DECIMAL(10,2)

);
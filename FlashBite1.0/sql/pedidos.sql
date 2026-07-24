CREATE TABLE pedidos(

    id INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario INT,

    direccion VARCHAR(200),

    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,

    estado VARCHAR(30) DEFAULT 'Pendiente',

    total DECIMAL(10,2)

);
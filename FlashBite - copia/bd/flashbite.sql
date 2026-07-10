DROP TABLE IF EXISTS detalle_pedido;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios(

    id_usuario INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    correo VARCHAR(100) NOT NULL UNIQUE,

    contraseña VARCHAR(255) NOT NULL,

    telefono VARCHAR(20),

    direccion VARCHAR(200),

    idioma VARCHAR(20) DEFAULT 'es'

);


CREATE TABLE productos(

    id_producto INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    descripcion VARCHAR(200),

    precio_original DECIMAL(8,2),

    precio_descuento DECIMAL(8,2),

    stock INT DEFAULT 0,

    imagen VARCHAR(255)

);



CREATE TABLE pedidos(

    id_pedido INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario INT NOT NULL,

    direccion_entrega VARCHAR(200),

    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,

    estado VARCHAR(30) DEFAULT 'Pendiente',

    CONSTRAINT fk_usuario

    FOREIGN KEY(id_usuario)

    REFERENCES usuarios(id_usuario)

);


CREATE TABLE detalle_pedido(

    id_detalle INT AUTO_INCREMENT PRIMARY KEY,

    id_pedido INT NOT NULL,

    id_producto INT NOT NULL,

    cantidad INT NOT NULL,

    precio DECIMAL(8,2),

    CONSTRAINT fk_pedido

    FOREIGN KEY(id_pedido)

    REFERENCES pedidos(id_pedido),

    CONSTRAINT fk_producto

    FOREIGN KEY(id_producto)

    REFERENCES productos(id_producto)

);



INSERT INTO productos
(nombre,descripcion,precio_original,precio_descuento,stock,imagen)

VALUES

('Pizza Familiar',
'Pizza con queso y pepperoni',
40,
25,
20,
'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'),

('Hamburguesa',
'Hamburguesa doble carne',
30,
18,
20,
'https://images.unsplash.com/photo-1550547660-d9450f859349'),

('Pollo Broaster',
'Pollo crocante con papas',
28,
15,
20,
'https://images.unsplash.com/photo-1504674900247-0877df9cc836'),

('Ensalada',
'Ensalada saludable fresca',
20,
10,
20,
'https://images.unsplash.com/photo-1529042410759-befb1204b468'),

('Pay de Limón',
'Una tajada',
9,
5,
20,
'https://www.cocinadelirante.com/sites/default/files/images/2024/09/como-hacer-el-pay-de-limon-helado-estilo-vips-con-leche-condensada.jpg'),

('Pay de Manzana',
'Para 20 personas',
70,
29.50,
20,
'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSG0khN8AC5_GOFrJn-1dxRQOU03Jb3UndFA&s'),

('Brownie',
'16 piezas',
35,
19.30,
20,
'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwXDgxkhDSo59_ajNGWe6kJ4T4DEOle-AQ5A&s'),

('Donas',
'Caja de 6 unidades',
65.40,
30,
20,
'https://pbs.twimg.com/media/BbNLddDCEAEVXRx.jpg');
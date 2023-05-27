INSERT INTO pais(id_pais, nombre, bandera, descripcion) VALUES
(1, 'Argentina', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Flag_of_Argentina.svg/1280px-Flag_of_Argentina.svg.png', 'Argentina es un país sudamericano con una superficie de 2.780.400 km² y una población de más de 44 millones de habitantes.'),
(2, 'Bolivia', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Flag_of_Bolivia_%28state%29.svg/1280px-Flag_of_Bolivia_%28state%29.svg.png', 'Bolivia es un país sudamericano sin salida al mar que cuenta con una superficie de 1.098.581 km² y una población de más de 11 millones de habitantes.'),
(3, 'Brasil', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/1280px-Flag_of_Brazil.svg.png', 'Brasil es un país sudamericano con una superficie de 8.515.767 km² y una población de más de 213 millones de habitantes.'),
(4, 'Chile', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Flag_of_Chile.svg/1280px-Flag_of_Chile.svg.png', 'Chile es un país sudamericano con una superficie de 756.096 km² y una población de más de 19 millones de habitantes.'),
(5, 'Colombia', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Colombia.svg/1280px-Flag_of_Colombia.svg.png', 'Colombia es un país sudamericano con una superficie de 1.141.748 km² y una población de más de 50 millones de habitantes.'),
(6, 'Costa Rica', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Flag_of_Costa_Rica.svg/1280px-Flag_of_Costa_Rica.svg.png', 'Costa Rica es un país centroamericano con una superficie de 51.100 km² y una población de más de 5 millones de habitantes.'),
(7, 'Cuba', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Flag_of_Cuba.svg/1280px-Flag_of_Cuba.svg.png', 'Cuba es un país insular del Caribe con una superficie de 109.884 km² y una población de más de 11 millones de habitantes.'),
(8, 'Ecuador', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Flag_of_Ecuador.svg/1280px-Flag_of_Ecuador.svg.png', 'Ecuador es un país sudamericano con una superficie de 283.561 km² y una población de más de 17 millones de habitantes.'),
(9, 'El Salvador', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Flag_of_El_Salvador.svg/1280px-Flag_of_El_Salvador.svg.png', 'El Salvador es un país centroamericano con una superficie de 21.041 km² y una población de más de 6 millones de habitantes.'),
(10, 'Guatemala', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Flag_of_Guatemala.svg/1280px-Flag_of_Guatemala.svg.png', 'Guatemala es un país centroamericano con una superficie de 108.889 km² y una población de más de 17 millones de habitantes.'),
(11, 'Honduras', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_Honduras.svg/1280px-Flag_of_Honduras.svg.png', 'Honduras es un país centroamericano con una superficie de 112.492 km² y una población de más de 9 millones de habitantes.'),
(12, 'México', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/1280px-Flag_of_Mexico.svg.png', 'México es un país ubicado en América del Norte con una superficie de 1.964.375 km² y una población de más de 126 millones de habitantes.'),
(13, 'Nicaragua', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Flag_of_Nicaragua.svg/1280px-Flag_of_Nicaragua.svg.png', 'Nicaragua es un país centroamericano con una superficie de 130.373 km² y una población de más de 6 millones de habitantes.'),
(14, 'Panamá', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Flag_of_Panama.svg/1280px-Flag_of_Panama.svg.png', 'Panamá es un país centroamericano con una superficie de 75.517 km² y una población de más de 4 millones de habitantes.'),
(15, 'Paraguay', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Paraguay.svg/1280px-Flag_of_Paraguay.svg.png', 'Paraguay es un país sudamericano con una superficie de 406.752 km² y una población de más de 7 millones de habitantes.'),
(16, 'Perú', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flag_of_Peru.svg/1280px-Flag_of_Peru.svg.png', 'Perú es un país sudamericano con una superficie de 1.285.216 km² y una población de más de 32 millones de habitantes.'),
(17, 'República Dominicana', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_the_Dominican_Republic.svg/1280px-Flag_of_the_Dominican_Republic.svg.png', 'República Dominicana es un país del Caribe con una superficie de 48.442 km² y una población de más de 10 millones de habitantes.'),
(18, 'Uruguay', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Uruguay.svg/1280px-Flag_of_Uruguay.svg.png', 'Uruguay es un país sudamericano con una superficie de 176.215 km² y una población de más de 3 millones de habitantes.'),
(19, 'Venezuela', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Venezuela.svg/1280px-Flag_of_Venezuela.svg.png', 'Venezuela es un país sudamericano con una superficie de 916.445 km² y una población de más de 28 millones de habitantes.'),
(20, 'Puerto Rico', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Flag_of_Puerto_Rico.svg/1280px-Flag_of_Puerto_Rico.svg.png', 'Puerto Rico es un territorio no incorporado de Estados Unidos ubicado en el noreste del Caribe.');
-- Insertar productos de Argentina
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (1, 'Asado', 'Plato tradicional de carne vacuna asada a la parrilla', 25.99, 1, 1, 'https://ejemplo.com/asado.jpg'),
    (2,'Empanadas', 'Masa rellena con carne, cebolla y especias', 7.99, 1, 2, 'https://ejemplo.com/empanadas.jpg'),
    (3,'Milanesa', 'Carne empanizada y frita, servida con papas fritas', 14.99, 1, 3, 'https://ejemplo.com/milanesa.jpg');

-- Insertar productos de Brasil
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (4,'Feijoada', 'Plato de frijoles negros con carne de cerdo', 19.99, 3, 4, 'https://ejemplo.com/feijoada.jpg'),
    (5,'Coxinha', 'Bolita de masa rellena de pollo y frita', 5.99, 3, 5, 'https://ejemplo.com/coxinha.jpg'),
    (6,'Pão de Queijo', 'Panecillo de queso hecho con almidón de yuca', 3.99, 3, 6, 'https://ejemplo.com/paodequeijo.jpg');

-- Insertar productos de Chile
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (7,'Empanadas de pino', 'Empanadas rellenas de carne molida, cebolla, pasas y aceitunas', 6.99, 4, 7, 'https://ejemplo.com/empanadasdepino.jpg'),
    (8,'Completo', 'Hot dog con tomate, palta, mayonesa y mostaza', 4.99, 4, 8, 'https://ejemplo.com/completo.jpg'),
    (9,'Curanto', 'Plato de mariscos, papas, carne y verduras cocidos al vapor en un hoyo en la tierra', 29.99, 4, 9, 'https://ejemplo.com/curanto.jpg');

-- Insertar productos de Bolivia
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (10,'Salteñas', 'Empanadas de carne picada, papas y especias', 5.99, 2, 4, 'https://ejemplo.com/saltenas.jpg'),
    (11,'Silpancho', 'Carne de res empanizada, servida con arroz, papas y ensalada', 12.99, 2, 7, 'https://ejemplo.com/silpancho.jpg'),
    (12,'Picante de Pollo', 'Guiso de pollo con papas, maní y especias', 9.99, 2, 5, 'https://ejemplo.com/picantedepollo.jpg');

-- Insertar productos de Colombia
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (13,'Ajiaco', 'Sopa espesa de papas, pollo, maíz y guascas', 14.99, 5, 6, 'https://ejemplo.com/ajiaco.jpg'),
    (14,'Bandeja paisa', 'Plato con arroz, frijoles, carne, huevo frito, chorizo, aguacate y plátano', 18.99, 5, 6, 'https://ejemplo.com/bandejapaisa.jpg'),
    (15,'Arepa', 'Panecillo de maíz relleno de queso, carne o aguacate', 5.99, 5, 5, 'https://ejemplo.com/arepa.jpg');

-- Insertar productos de Costa Rica
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (16,'Gallo pinto', 'Arroz con frijoles, servido con huevos, natilla y plátano maduro', 10.99, 6, 3, 'https://ejemplo.com/gallopinto.jpg'),
    (17,'Casado', 'Plato con arroz, frijoles, carne, plátano maduro, ensalada y tortilla', 13.99, 6, 1, 'https://ejemplo.com/casado.jpg'),
    (18,'Olla de carne', 'Sopa con carne, yuca, plátano, chayote, elote y ñampí', 19.99, 6, 3, 'https://ejemplo.com/olladecarne.jpg');

-- Insertar productos de Cuba
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (19,'Ropa vieja', 'Carne de res deshebrada en salsa de tomate, servida con arroz y plátanos', 16.99, 7, 3, 'https://ejemplo.com/ropavieja.jpg'),
    (20,'Moros y cristianos', 'Arroz con frijoles negros', 9.99, 7, 11, 'https://ejemplo.com/morosycristianos.jpg'),
    (21,'Cubano', 'Sándwich de jamón, cerdo, queso, mostaza y pepinillos', 8.99, 7, 1, 'https://ejemplo.com/cubano.jpg');

--Insertar productos de República Dominicana
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(22,'Mangu', 'Puré de plátanos verdes, servido con cebolla y queso', 7.99, 17, 1, 'https://ejemplo.com/mangu.jpg'),
(23,'Sancocho', 'Sopa espesa con carne, yuca, plátanos, ñame y maíz', 15.99, 17, 11, 'https://ejemplo.com/sancocho.jpg'),
(24,'Tostones', 'Plátanos verdes fritos y aplastados', 5.99, 17, 14, 'https://ejemplo.com/tostones.jpg');

-- Insertar productos de Ecuador
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(25,'Ceviche', 'Plato de mariscos marinados en limón y cebolla', 12.99, 8, 13, 'https://ejemplo.com/ceviche.jpg'),
(26,'Locro', 'Sopa de papas con maíz, aguacate y queso', 9.99, 8, 11, 'https://ejemplo.com/locro.jpg'),
(27,'Hornado', 'Cerdo asado con papas y mote', 16.99, 8, 12, 'https://ejemplo.com/hornado.jpg');

-- Insertar productos de El Salvador
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(28,'Pupusa', 'Tortilla de maíz rellena de queso, frijoles y carne', 6.99, 9, 11, 'https://ejemplo.com/pupusa.jpg'),
(29,'Yucca con chicharrón', 'Yuca frita con carne de cerdo frita', 8.99, 9, 11, 'https://ejemplo.com/yuccaconchicharron.jpg'),
(30,'Sopa de pata', 'Sopa de patas de cerdo con maíz, yuca y plátano', 12.99, 9, 11, 'https://ejemplo.com/sopadepata.jpg');

-- Insertar productos de Guatemala
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(31,'Pepián', 'Guiso de pollo con salsa de semillas de calabaza y tomate', 14.99, 10, 10, 'https://ejemplo.com/pepian.jpg'),
(32,'Chiles rellenos', 'Chiles rellenos de carne y verduras, cubiertos de salsa de tomate', 10.99, 10, 9, 'https://ejemplo.com/chilesrellenos.jpg'),
(33,'Tamales', 'Masa de maíz rellena de carne y envuelta en hojas de plátano', 8.99, 10, 9, 'https://ejemplo.com/tamales.jpg');

-- Insertar productos de Honduras
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(35,'Baleada', 'Tortilla de harina rellena de frijoles, queso y carne', 7.99, 11, 7, 'https://ejemplo.com/baleada.jpg'),
(36,'Sopa de caracol', 'Sopa de caracoles con verduras y especias', 14.99, 11, 8, 'https://ejemplo.com/sopadecaracol.jpg'),
(37,'Pastelitos de carne', 'Empanadas de carne picada, papas y especias', 5.99, 11, 8, 'https://ejemplo.com/pastelitosdecarne.jpg');

-- Insertar productos de Nicaragua
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(38,'Gallo pinto', 'Arroz con frijoles, servido con huevos, natilla y plátano maduro', 10.99, 13, 7, 'https://ejemplo.com/gallopinto.jpg'),
(39,'Nacatamal', 'Masa de maíz rellena de carne o cerdo, verduras y especias, envuelta en hojas de plátano y cocida', 12.99, 13, 6, 'https://ejemplo.com/nacatamal.jpg'),
(40,'Quesillo', 'Queso fresco enrollado en una tortilla de maíz con cebolla y crema', 4.99, 13, 6, 'https://ejemplo.com/quesillo.jpg');

-- Insertar productos de Panamá
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(41,'Sancocho', 'Sopa espesa de pollo, ñame, culantro, cebolla y ajo', 14.99, 14, 5, 'https://ejemplo.com/sancocho.jpg'),
(42,'Arroz con guandú', 'Arroz con guisantes y coco, servido con carne y plátano maduro', 12.99, 14, 6, 'https://ejemplo.com/arrozconguandu.jpg'),
(43,'Ceviche', 'Plato de pescado o mariscos marinados en limón, con cebolla, cilantro y ají', 16.99, 14, 5, 'https://ejemplo.com/ceviche.jpg');

-- Insertar productos de México
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(44,'Tacos al pastor', 'Tortillas con carne de cerdo adobada, piña, cebolla y cilantro', 8.99, 12, 4, 'https://ejemplo.com/tacosalpastor.jpg'),
(45,'Chiles en nogada', 'Chiles poblanos rellenos de carne, frutas y nueces, bañados en salsa de nuez y granada', 20.99, 12, 4, 'https://ejemplo.com/chilesennogada.jpg'),
(46,'Guacamole', 'Puré de aguacate con tomate, cebolla, chile y cilantro', 6.99, 12, 3, 'https://ejemplo.com/guacamole.jpg');

-- Insertar productos de Paraguay
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(47,'Sopa paraguaya', 'Pan de maíz con queso y cebolla', 7.99, 15, 1, 'https://ejemplo.com/sopaparaguaya.jpg'),
(48,'Chipa guazú', 'Pastel de maíz con queso y leche', 9.99, 15, 2, 'https://ejemplo.com/chipaguazu.jpg'),
(49,'Asado paraguayo', 'Carne asada con mandioca, ensalada y chimichurri', 18.99, 15, 1, 'https://ejemplo.com/asadoparaguayo.jpg');

-- Insertar productos de Uruguay
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(50,'Chivito', 'Sándwich de carne, panceta, queso, huevo, lechuga, tomate y mayonesa', 12.99, 18, 1, 'https://ejemplo.com/chivito.jpg'),
(51,'Pasta frola', 'Tarta dulce de membrillo o dulce de leche', 8.99, 18, 11, 'https://ejemplo.com/pastafrola.jpg'),
(52,'Asado uruguayo', 'Carne asada con chimichurri, ensalada y papas fritas', 19.99, 18, 11, 'https://ejemplo.com/asadouruguayo.jpg');

-- Insertar productos de Venezuela
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
(53,'Arepa', 'Panecillo de maíz relleno de carne, queso o aguacate', 5.99, 19, 12, 'https://ejemplo.com/arepa.jpg'),
(54,'Pabellón criollo', 'Plato con arroz, frijoles, carne y plátano maduro', 16.99, 19, 3, 'https://ejemplo.com/pabelloncriollo.jpg'),
(55,'Hallacas', 'Tamal relleno de carne, pasas, aceitunas y especias', 12.99, 19, 2, 'https://ejemplo.com');

-- Insertar productos de Perú
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES
    (56,'Ceviche', 'Plato de pescado marinado en jugo de limón, cebolla, chile y cilantro', 15.99, 16, 11, 'https://ejemplo.com/ceviche.jpg'),
    (57,'Lomo saltado', 'Plato de carne salteada con cebolla, tomate y papas fritas', 17.99, 16, 12, 'https://ejemplo.com/lomosaltado.jpg'),
    (58,'Anticuchos', 'Brochetas de corazón de res adobadas y asadas', 12.99, 16, 12, 'https://ejemplo.com/anticuchos.jpg');

-- Insertar productos de Puerto Rico
INSERT INTO producto (id_producto, nombre, descripcion, precio, id_pais, id_restaurante, imagen)
VALUES 
(59, 'Mofongo', 'Plato hecho de plátano verde frito que se machaca y se mezcla con chicharrón y ajo.', 12.99, 20, 4, 'mofongo.jpg'),
(60, 'Arroz con gandules', 'Arroz amarillo cocido con gandules (habichuelas) y carne de cerdo', 9.99, 20, 5, 'arroz-con-gandules.jpg'),
(61, 'Asopao de pollo', 'Guiso de arroz con pollo y vegetales, se asemeja a una sopa espesa', 8.99, 20, 6, 'asopao-de-pollo.jpg'); 

-- Restaurantes
INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (1, 'Avenida Corrientes 348', 'La Brigada', 1, 'https://www.example.com/la-brigada.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (2, 'Calle Reconquista 885', 'El Establo', 1, 'https://www.example.com/el-establo.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (3, 'Rua da Alfândega 35', 'Confeitaria Colombo', 3, 'https://www.example.com/confeitaria-colombo.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (4, 'Rua Almirante Alexandrino 332', 'Bar do Mineiro', 3, 'https://www.example.com/bar-do-mineiro.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (5, 'Carrera 6', 'La Puerta Falsa', 5, 'https://www.example.com/la-puerta-falsa.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (6, 'Calle 11', 'Andrés Carne de Res', 5, 'https://www.example.com/andres-carne-de-res.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (7, 'Jirón Zepita 214', 'La Lucha Sanguchería Criolla', 16, 'https://www.example.com/la-lucha.jpg');

INSERT INTO restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (8, 'Jirón de la Unión 1085', 'Panchita', 16, 'https://www.example.com/panchita.jpg');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (9, 'Calle Monjitas 578', 'El Fogón', 4, 'https://fogonrestaurant.cl/wp-content/uploads/2017/08/El-Fogon-Restaurant-Santiago-de-Chile.png');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (14, 'Avenida Francisco Bilbao 465', 'Como agua para chocolate', 4, 'https://www.comoaguaparachocolate.cl/wp-content/uploads/2021/02/logo-CAPC.png');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (10, 'Calle Rocafuerte y 10 de Agosto', 'Hasta la Vuelta Señor', 8, 'https://www.hastalavueltasenor.com/images/logo.svg');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (11, 'Calle Numa Pompilio Llona', 'El Pobre Diablo', 8, 'https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_350,h_300/https://elpobrediablo.com.ec/wp-content/uploads/2018/11/logo-1.png');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (12, 'Av. España', 'Lido Bar', 15, 'https://www.lidobar.com.py/wp-content/uploads/2019/05/logo-lido-02.png');

INSERT INTO public.restaurante (id_restaurante, direccion, nombre, id_pais, imagen)
VALUES (13, 'Chaco Boreal esquina Guaraní', 'La Cabrera', 15, 'https://www.hoy.com.py/files/image/3/348/1200_630/la-cabrera.jpg');

INSERT INTO cliente (id_usuario, nombre, apellidos, correo, dni, direccion, username, password)
VALUES (1, 'Juan', 'Pérez', 'juanperez@example.com', '12345678A', 'Calle Falsa 123', 'jperez', 'jperez');


INSERT INTO hostelero (id_usuario, nombre, apellidos, username, password, id_restaurante)
VALUES (1, 'Daniel', 'Martín', 'danim', 'danim', 1);

https://i.ibb.co/HG2rDK5/cabrera.jpg
https://i.ibb.co/kDfWpsf/lido-bar.jpg
https://i.ibb.co/KK9Pv0Y/pobrediablo.jpg
https://i.ibb.co/g3jxcwG/hastalavu.jpg
https://i.ibb.co/FXQDsX7/restaurante-como-agua-para-chocolate-santiago-1.jpg
https://i.ibb.co/vk1Wrq5/el-fogon-de-trifon.jpg
https://i.ibb.co/8KsZNz5/Panchita-ficha-listo.jpg
https://i.ibb.co/0YM7tNK/la-lucha.jpg
https://i.ibb.co/M1HkMrg/andres-carne-de-res.jpg
https://i.ibb.co/1JjZy85/puertafalsa.jpg
https://i.ibb.co/wSGFhxm/do-mineiro.jpg
https://i.ibb.co/kBFkbzm/La-Brigada-Interior.jpg
https://i.ibb.co/ss05x6N/caf-da-manh-colombo-600x375.jpg
https://i.ibb.co/NtJr0kj/el-establo.jpg
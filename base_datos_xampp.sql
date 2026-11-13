-- 1. Crear la base de datos con soporte para acentos y eñes
CREATE DATABASE IF NOT EXISTS tienda_libros CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tienda_libros;

-- 2. Tabla de usuarios (para el registro e inicio de sesión)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabla de libros (catálogo de productos)
CREATE TABLE IF NOT EXISTS libros (
    id INT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- 4. Tabla de ventas (encabezado de cada pedido)
CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(150) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    metodo_pago VARCHAR(50) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 5. Tabla de detalle de ventas (libros incluidos en cada pedido)
CREATE TABLE IF NOT EXISTS detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    libro_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id) ON DELETE CASCADE,
    FOREIGN KEY (libro_id) REFERENCES libros(id)
) ENGINE=InnoDB;

-- 6. Alta de los 10 libros de la categoría "Novela"
INSERT INTO libros (id, titulo, autor, categoria, precio, imagen) VALUES
(1, 'Cien Años de Soledad', 'Gabriel García Márquez', 'Novela', 349.00, 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500'),
(3, 'El Principito', 'Antoine de Saint-Exupéry', 'Novela', 199.00, 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=500'),
(5, 'La Sombra del Viento', 'Carlos Ruiz Zafón', 'Novela', 379.00, 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=500'),
(6, 'Pedro Páramo', 'Juan Rulfo', 'Novela', 229.00, 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=500'),
(7, 'Como Agua para Chocolate', 'Laura Esquivel', 'Novela', 269.00, 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=500'),
(14, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Novela', 420.00, 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=500'),
(15, 'Crónica de una Muerte Anunciada', 'Gabriel García Márquez', 'Novela', 249.00, 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500'),
(16, 'Rayuela', 'Julio Cortázar', 'Novela', 359.00, 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=500'),
(17, 'La Tregua', 'Mario Benedetti', 'Novela', 239.00, 'https://images.unsplash.com/photo-1589998059171-988d887df646?w=500'),
(18, 'Orgullo y Prejuicio', 'Jane Austen', 'Novela', 289.00, 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500');

-- 7. Alta de los 10 libros de la categoría "Ciencia Ficción"
INSERT INTO libros (id, titulo, autor, categoria, precio, imagen) VALUES
(2, '1984', 'George Orwell', 'Ciencia Ficción', 299.00, 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500'),
(8, 'Dune', 'Frank Herbert', 'Ciencia Ficción', 449.00, 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=500'),
(9, 'Fahrenheit 451', 'Ray Bradbury', 'Ciencia Ficción', 259.00, 'https://images.unsplash.com/photo-1589998059171-988d887df646?w=500'),
(10, 'Un Mundo Feliz', 'Aldous Huxley', 'Ciencia Ficción', 279.00, 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=500'),
(19, 'Fundación', 'Isaac Asimov', 'Ciencia Ficción', 339.00, 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500'),
(20, 'Yo, Robot', 'Isaac Asimov', 'Ciencia Ficción', 289.00, 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=500'),
(21, 'El Juego de Ender', 'Orson Scott Card', 'Ciencia Ficción', 319.00, 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=500'),
(22, 'Neuromante', 'William Gibson', 'Ciencia Ficción', 329.00, 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=500'),
(23, 'Crónicas Marcianas', 'Ray Bradbury', 'Ciencia Ficción', 269.00, 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=500'),
(24, 'El Problema de los Tres Cuerpos', 'Cixin Liu', 'Ciencia Ficción', 399.00, 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=500');

-- 8. Alta de los 10 libros de la categoría "Desarrollo Personal"
INSERT INTO libros (id, titulo, autor, categoria, precio, imagen) VALUES
(4, 'Hábitos Atómicos', 'James Clear', 'Desarrollo Personal', 389.00, 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=500'),
(11, 'El Poder del Ahora', 'Eckhart Tolle', 'Desarrollo Personal', 319.00, 'https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?w=500'),
(12, 'Cómo Ganar Amigos e Influir sobre las Personas', 'Dale Carnegie', 'Desarrollo Personal', 289.00, 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=500'),
(13, 'Piense y Hágase Rico', 'Napoleon Hill', 'Desarrollo Personal', 249.00, 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=500'),
(25, 'Los 7 Hábitos de la Gente Altamente Efectiva', 'Stephen R. Covey', 'Desarrollo Personal', 369.00, 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500'),
(26, 'Padre Rico, Padre Pobre', 'Robert T. Kiyosaki', 'Desarrollo Personal', 299.00, 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=500'),
(27, 'El Club de las 5 de la Mañana', 'Robin Sharma', 'Desarrollo Personal', 349.00, 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=500'),
(28, 'Inteligencia Emocional', 'Daniel Goleman', 'Desarrollo Personal', 359.00, 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=500'),
(29, 'El Hombre en Busca de Sentido', 'Viktor Frankl', 'Desarrollo Personal', 259.00, 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=500'),
(30, 'La Psicología del Dinero', 'Morgan Housel', 'Desarrollo Personal', 339.00, 'https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=500');

<?php
// Incluir el archivo de la clase Author y Genre
require_once 'models/Author.php';
require_once 'models/Genre.php';
require_once 'models/Book.php';
require_once 'models/Stock.php';

// Instanciar las clases
$author = new Author();
$genre = new Genre();
$book = new Book();
$stock = new Stock();

// Manejar autores
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['author_action'])) {
    if ($_POST['author_action'] == 'create') {
        $data = [
            'full_name' => $_POST['full_name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'date_of_death' => $_POST['date_of_death']
        ];
        $author->create($data);
    } elseif ($_POST['author_action'] == 'update') {
        $data = [
            'id_author' => $_POST['id_author'],
            'full_name' => $_POST['full_name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'date_of_death' => $_POST['date_of_death']
        ];
        $author->update($data);
    } elseif ($_POST['author_action'] == 'delete') {
        $id_author = $_POST['id_author'];
        $author->delete($id_author);
    }
}
$authors = $author->getAll(); // Obtener todos los autores

// Manejar géneros
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genre_action'])) {
    if ($_POST['genre_action'] == 'create') {
        $data = ['name' => $_POST['name']];
        $genre->create($data);
    } elseif ($_POST['genre_action'] == 'update') {
        $data = [
            'id_genre' => $_POST['id_genre'],
            'name' => $_POST['name']
        ];
        $genre->update($data);
    } elseif ($_POST['genre_action'] == 'delete') {
        $id_genre = $_POST['id_genre'];
        $genre->delete($id_genre);
    }
}
$genres = $genre->getAll(); // Obtener todos los géneros

// Manejar libros
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_action'])) {
    if ($_POST['book_action'] == 'create') {
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'year_publication' => $_POST['year_publication'],
            'id_author' => $_POST['id_author'],
            'id_genre' => $_POST['id_genre']
        ];
        $book->create($data);
    } elseif ($_POST['book_action'] == 'update') {
        $data = [
            'id_book' => $_POST['id_book'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'year_publication' => $_POST['year_publication'],
            'id_author' => $_POST['id_author'],
            'id_genre' => $_POST['id_genre']
        ];
        $book->update($data);
    } elseif ($_POST['book_action'] == 'delete') {
        $id_book = $_POST['id_book'];
        $book->delete($id_book);
    }
}
$books = $book->getAll(); // Obtener todos los libros

// Manejar STOCK
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['stock_action'])) {
    if ($_POST['stock_action'] == 'create') {
        $data = [
            'id_book' => $_POST['id_book'],
            'total_stock' => $_POST['total_stock'],
            'notes' => $_POST['notes'],
            'last_inventory' => $_POST['last_inventory'],
        ];
        $stock->create($data);
    } elseif ($_POST['stock_action'] == 'update') {
        $data = [
            'id_stock' => $_POST['id_stock'],
            'id_book' => $_POST['id_book'],
            'total_stock' => $_POST['total_stock'],
            'notes' => $_POST['notes'],
            'last_inventory' => $_POST['last_inventory'],
        ];
        $stock->update($data);
    } elseif ($_POST['stock_action'] == 'delete') {
        $id_stock = $_POST['id_stock'];
        $stock->delete($id_stock); 
    }
}
$stocks = $stock->getAll(); 

// Determinar qué sección mostrar
$section = isset($_GET['section']) ? $_GET['section'] : 'authors';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Biblioteca</title>

    <style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

th {
    background-color: #f2f2f2;
}


</style>
</head>
<body>
    <h1>Gestión de Biblioteca</h1>
    <nav>
        <ul>
            <li><a href="?section=authors">Gestión de Autores</a></li>
            <li><a href="?section=book">Gestión de Libros</a></li>
            <li><a href="?section=genre">Gestión de Géneros</a></li>
            <li><a href="?section=stock">Gestión de Stocks</a></li>
        </ul>
    </nav>

    <!-- Contenido dinámico según la sección -->
    <?php if ($section == 'authors'): ?>
        <h2>Gestión de Autores</h2>
        <form method="POST">
            <input type="hidden" name="author_action" value="create">
            <input type="text" name="full_name" placeholder="Nombre Completo" required>
            <input type="date" name="date_of_birth" required>
            <input type="date" name="date_of_death">
            <button type="submit">Crear Autor</button>
        </form>
        <h3>Lista de Autores</h3>
        <ul>
            <?php foreach ($authors as $author): ?>
                <li>
                    <?php echo $author['FULL_NAME']; ?> (Nacido: <?php echo $author['DATE_OF_BIRTH']; ?>)
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="author_action" value="update">
                        <input type="hidden" name="id_author" value="<?php echo $author['ID_AUTHOR']; ?>">
                        <input type="text" name="full_name" value="<?php echo $author['FULL_NAME']; ?>" required>
                        <input type="date" name="date_of_birth" value="<?php echo $author['DATE_OF_BIRTH']; ?>" required>
                        <input type="date" name="date_of_death" value="<?php echo $author['DATE_OF_DEATH']; ?>">
                        <button type="submit">Actualizar</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="author_action" value="delete">
                        <input type="hidden" name="id_author" value="<?php echo $author['ID_AUTHOR']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php elseif ($section == 'genre'): ?>
        <h2>Gestión de Géneros</h2>
        <form method="POST">
            <input type="hidden" name="genre_action" value="create">
            <input type="text" name="name" placeholder="Nombre del Género" required>
            <button type="submit">Crear Género</button>
        </form>
        <h3>Lista de Géneros</h3>
        <ul>
            <?php foreach ($genres as $genre): ?>
                <li>
                    <?php echo $genre['NAME']; ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="genre_action" value="update">
                        <input type="hidden" name="id_genre" value="<?php echo $genre['ID_GENRE']; ?>">
                        <input type="text" name="name" value="<?php echo $genre['NAME']; ?>" required>
                        <button type="submit">Actualizar</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="genre_action" value="delete">
                        <input type="hidden" name="id_genre" value="<?php echo $genre['ID_GENRE']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        
    <!-- Book -->
    <?php elseif ($section == 'book'): ?>
        <h2>Gestión de Libros</h2>
        <form method="POST">
            <input type="hidden" name="book_action" value="create">
            <input type="text" name="title" placeholder="Título" required>
            <textarea name="description" placeholder="Descripción" required></textarea>
            <input type="number" name="year_publication" placeholder="Año de publicación" required>
            <select name="id_author" required>
                <option value="">Selecciona un autor</option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?php echo $author['ID_AUTHOR']; ?>"><?php echo $author['FULL_NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="id_genre" required>
                <option value="">Selecciona un género</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['ID_GENRE']; ?>"><?php echo $genre['NAME']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Crear Libro</button>
        </form>
        <h3>Lista de Libros</h3>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <strong><?php echo $book['TITLE']; ?></strong> 
                    (Publicado en: <?php echo $book['YEAR_PUBLICATION']; ?>)
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="book_action" value="update">
                        <input type="hidden" name="id_book" value="<?php echo $book['ID_BOOK']; ?>">
                        <input type="text" name="title" value="<?php echo $book['TITLE']; ?>" required>
                        <textarea name="description" required><?php echo $book['DESCRIPTION']; ?></textarea>
                        <input type="number" name="year_publication" value="<?php echo $book['YEAR_PUBLICATION']; ?>" required>
                        <select name="id_author" required>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?php echo $author['ID_AUTHOR']; ?>" <?php echo ($book['ID_AUTHOR'] == $author['ID_AUTHOR']) ? 'selected' : ''; ?>>
                                    <?php echo $author['FULL_NAME']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select name="id_genre" required>
                            <?php foreach ($genres as $genre): ?>
                                <option value="<?php echo $genre['ID_GENRE']; ?>" <?php echo ($book['ID_GENRE'] == $genre['ID_GENRE']) ? 'selected' : ''; ?>>
                                    <?php echo $genre['NAME']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Actualizar</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="book_action" value="delete">
                        <input type="hidden" name="id_book" value="<?php echo $book['ID_BOOK']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Stock -->
    <?php elseif ($section == 'stock'): ?>
        <h2>Gestión de stock</h2>
        <form method="POST">
            <input type="hidden" name="stock_action" value="create">
            <select name="id_book" required>
                <option value="">Selecciona un libro</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['ID_BOOK']; ?>"><?php echo $book['TITLE']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="total_stock" placeholder="Cantidad en stock" required>
            <input type="number" name="notes" placeholder="notas" required>
            <input type="date" name="last_inventory" placeholder="último inventario" required>
            <button type="submit">Crear un stock</button>
        </form>
        <h3>Lista de Stocks</h3>
        <ul>
            <?php foreach ($stocks as $stock): ?>
                <li>
                    <?php echo "Libro: " . $stock['ID_BOOK'] . " - Stock: " . $stock['TOTAL_STOCK']; ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="stock_action" value="update">
                        <select name="id_book" required>
                            <?php foreach ($books as $book): ?>
                                <option value="<?php echo $book['ID_BOOK']; ?>" <?php echo ($stock['ID_BOOK'] == $book['ID_BOOK']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($book['TITLE']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="total_stock" value="<?php echo $stock['TOTAL_STOCK']; ?>">
                        <input type="text" name="notes" value="<?php echo $stock['NOTES']; ?>" required>
                        <input type="date" name="last_inventory" value="<?php echo $stock['LAST_INVENTORY']; ?>" required>
                        <button type="submit">Actualizar</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="stock_action" value="delete">
                        <input type="hidden" name="id_stock" value="<?php echo $stock['ID_STOCK']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
</body>
</html>
<?php
session_start();
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $quantity = $_POST['quantity'];
    
    $query = $db->prepare("SELECT * FROM ksiazka WHERE id = ? AND ilosc >= ?");
    $query->execute([$book_id, $quantity]);
    $book = $query->fetch();
    
    if ($book) {
        $query = $db->prepare("INSERT INTO zamowienie (id_klienta, id_ksiazki, liczba_egzemplarzy) VALUES (?, ?, ?)");
        $query->execute([$_SESSION['user_id'], $book_id, $quantity]);
        header('Location: przeglad.php');
    } else {
        $error = "Nieprawidlowe dane lub brak dostepnej ilosci.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Filip Tutaj">
    <meta name="description" content="Skladanie zamowien">
    <meta name="keywords" content="ksiêgarnia, zamówienia, ksi¹¿ki">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z³ó¿ zamówienie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ksiêgarnia Internetowa</h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona g³ówna</a></li>
                <li><a href="login.php">Zaloguj</a></li>
                <li><a href="register.php">Zarejestruj</a></li>
                <li><a href="przeglad.php">Przegl¹daj zasoby</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Z³oz zamowienie</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="order.php">
            <label for="book_id">ID ksiazki:</label>
            <input type="number" id="book_id" name="book_id" required>
            <label for="quantity">Ilosc:</label>
            <input type="number" id="quantity" name="quantity" required>
            <button type="submit">Z³oz zamówienie</button>
        </form>

    </main>
    <footer>
        <p>Filip Tutaj - 2TP</p>
    </footer>
</body>
</html>




$book_id = $_POST['book_id'];
$quantity = $_POST['quantity'];
    
$query = $db->prepare("SELECT * FROM ksiazka WHERE id = ? AND ilosc >= ?");
$query->execute([$book_id, $quantity]);
$book = $query->fetch();

if ($book) {
        $query = $db->prepare("INSERT INTO zamowienie (id_klienta, id_ksiazki, liczba_egzemplarzy) VALUES (?, ?, ?)");
        $query->execute([$_SESSION['user_id'], $book_id, $quantity]);
        header('Location: przeglad.php');
    } else {
        $error = "Nieprawidlowe dane lub brak dostepnej ilosci.";
    }
?>
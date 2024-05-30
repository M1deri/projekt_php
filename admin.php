<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

$books = $db->query("SELECT * FROM ksiazki")->fetchAll();
$orders = $db->query("SELECT * FROM zamowienia")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Filip Tutaj">
    <meta name="description" content="Panel administracyjny">
    <meta name="keywords" content="ksiêgarnia, administracja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Panel administracyjny</h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona g³ówna</a></li>
                <li><a href="przeglad.php">Przegl¹daj zasoby</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Zarz¹dzaj ksi¹¿kami</h2>
        <ul>
            <?php foreach ($books as $book): ?>
                <li><?php echo htmlspecialchars($book['tytul']); ?> - <?php echo htmlspecialchars($book['autor']); ?> - <?php echo htmlspecialchars($book['ilosc']); ?> szt.</li>
            <?php endforeach; ?>
        </ul>
        <h2>Zarz¹dzaj zamówieniami</h2>
        <ul>
            <?php foreach ($orders as $order): ?>
                <li>Zamówienie ID: <?php echo htmlspecialchars($order['id']); ?> - Ksi¹¿ka ID: <?php echo htmlspecialchars($order['book_id']); ?> - Iloœæ: <?php echo htmlspecialchars($order['quantity']); ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
    <footer>
        <p>Filip Tutaj - 2TP</p>
    </footer>
</body>
</html>

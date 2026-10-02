<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($action === 'add' && $id !== false && $id !== null && isset($products[$id])) {

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    setFlash('Produk ditambahkan ke keranjang.');

} else {

    setFlash('Permintaan tidak valid.');
}

header('Location: index.php');
exit;
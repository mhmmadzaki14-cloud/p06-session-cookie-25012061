<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setFlash('Akses tidak valid.');
    header('Location: index.php');
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($action === 'add') {

    if ($id === false || $id === null || !isset($products[$id])) {

        setFlash('Produk tidak valid.');
        header('Location: index.php');
        exit;
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    setFlash('Produk ditambahkan ke keranjang.');

    header('Location: index.php');
    exit;
}

if ($action === 'remove') {

    if ($id === false || $id === null || !isset($_SESSION['cart'][$id])) {

        setFlash('Item keranjang tidak valid.');
        header('Location: cart.php');
        exit;
    }

    unset($_SESSION['cart'][$id]);

    setFlash('Produk dihapus dari keranjang.');

    header('Location: cart.php');
    exit;
}

if ($action === 'clear') {

    $_SESSION['cart'] = array();

    setFlash('Keranjang dikosongkan.');

    header('Location: cart.php');
    exit;
}

setFlash('Permintaan tidak valid.');

header('Location: index.php');
exit;
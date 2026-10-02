<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

/* Tema dari cookie */
$allowedThemes = array('light', 'dark');

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

/* Simpan tema */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {

    $candidate = $_POST['theme'];

    if (in_array($candidate, $allowedThemes, true)) {

        setcookie(
            'theme',
            $candidate,
            time() + (60 * 60 * 24 * 30),
            '/'
        );

        header('Location: index.php');
        exit;
    }
}

require __DIR__ . '/components/header.php';
?>

<style>
    body.light {
        background: #f4f6f8;
        color: #333;
    }

    body.dark {
        background: #212529;
        color: #f8f9fa;
    }

    body.dark .card {
        background: #343a40;
        color: white;
    }

    body.dark th {
        background: #495057;
        color: white;
    }

    body.dark td {
        border-color: #666;
    }

    .theme-form {
        display: inline-block;
        margin-left: 20px;
    }

    .theme-form select {
        padding: 6px 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }
</style>

<h1>Daftar Produk</h1>

<p>Silakan pilih produk yang ingin dimasukkan ke keranjang.</p>

<div class="card">

    <h3>Preferensi Tema</h3>

    <form action="index.php" method="POST" class="theme-form">
        <select name="theme" onchange="this.form.submit()">

            <option value="light" <?php echo ($theme === 'light') ? 'selected' : ''; ?>>
                Terang
            </option>

            <option value="dark" <?php echo ($theme === 'dark') ? 'selected' : ''; ?>>
                Gelap
            </option>

        </select>
    </form>

</div>

<?php foreach ($products as $id => $product): ?>

    <div class="card">

        <h2>
            <?= e($product['nama']) ?>
        </h2>

        <p>
            Harga:
            <strong>
                Rp <?= number_format($product['harga'], 0, ',', '.') ?>
            </strong>
        </p>

        <form action="actions.php" method="POST">

            <input
                type="hidden"
                name="action"
                value="add"
            >

            <input
                type="hidden"
                name="id"
                value="<?= e((string) $id) ?>"
            >

            <button
                type="submit"
                class="btn-add"
            >
                Tambah ke Keranjang
            </button>

        </form>

    </div>

<?php endforeach; ?>

<?php
require __DIR__ . '/components/footer.php';
?>
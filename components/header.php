<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../functions.php';

$flash = pullFlash();
$cartCount = cartCount($_SESSION['cart']);

$allowedThemes = array('light', 'dark');

$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang Belanja</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            transition: 0.3s;
        }

        body.light {
            background: #f4f6f8;
            color: #333;
        }

        body.dark {
            background: #212529;
            color: #f8f9fa;
        }

        .navbar {
            background: #198754;
            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            flex-wrap: wrap;
            gap: 10px;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .flash {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.08);
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

        button {
            border: none;
            padding: 9px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-add {
            background: #198754;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-clear {
            background: #212529;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .theme-box {
            display: inline-block;
        }

        .theme-box select {
            padding: 7px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            color: #666;
        }

        body.dark .footer {
            color: #bbb;
        }

    </style>

</head>

<body class="<?= e($theme) ?>">

<nav class="navbar">

    <h2>
        Keranjang Belanja
    </h2>

    <div>

        <a href="index.php">
            Produk
        </a>

        &nbsp;&nbsp;

        <a href="cart.php">
            🛒 Keranjang
            (<?= e((string) $cartCount) ?>)
        </a>

        &nbsp;&nbsp;

        <form
            action="index.php"
            method="POST"
            class="theme-box"
        >

            <select
                name="theme"
                onchange="this.form.submit()"
            >

                <option
                    value="light"
                    <?php echo ($theme === 'light') ? 'selected' : ''; ?>
                >
                    Terang
                </option>

                <option
                    value="dark"
                    <?php echo ($theme === 'dark') ? 'selected' : ''; ?>
                >
                    Gelap
                </option>

            </select>

        </form>

    </div>

</nav>

<div class="container">

<?php if ($flash !== null): ?>

    <div class="flash">
        <?= e($flash) ?>
    </div>

<?php endif; ?>
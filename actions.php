<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

require __DIR__ . '/components/header.php';
?>

<h1>Keranjang Belanja</h1>

<?php if (empty($_SESSION['cart'])): ?>

    <div class="card">

        <p>Keranjang masih kosong.</p>

        <a href="index.php">
            Kembali ke Produk
        </a>

    </div>

<?php else: ?>

    <div class="card">

        <table>

            <thead>

                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            <?php
            $total = 0;
            ?>

            <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>

                <?php

                if (!isset($products[$id])) {
                    continue;
                }

                $product = $products[$id];

                $subtotal = $product['harga'] * $quantity;

                $total += $subtotal;

                ?>

                <tr>

                    <td>
                        <?= e($product['nama']) ?>
                    </td>

                    <td>
                        Rp <?= number_format($product['harga'], 0, ',', '.') ?>
                    </td>

                    <td>
                        <?= e((string) $quantity) ?>
                    </td>

                    <td>
                        Rp <?= number_format($subtotal, 0, ',', '.') ?>
                    </td>

                    <td>

                        <form
                            action="actions.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="action"
                                value="remove"
                            >

                            <input
                                type="hidden"
                                name="id"
                                value="<?= e((string) $id) ?>"
                            >

                            <button
                                type="submit"
                                class="btn-delete"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

            <tfoot>

                <tr>

                    <th colspan="3">
                        Total
                    </th>

                    <th>
                        Rp <?= number_format($total, 0, ',', '.') ?>
                    </th>

                    <th></th>

                </tr>

            </tfoot>

        </table>

        <br>

        <form
            action="actions.php"
            method="POST"
        >

            <input
                type="hidden"
                name="action"
                value="clear"
            >

            <button
                type="submit"
                class="btn-clear"
            >
                Kosongkan Keranjang
            </button>

        </form>

    </div>

<?php endif; ?>

<?php
require __DIR__ . '/components/footer.php';
?>
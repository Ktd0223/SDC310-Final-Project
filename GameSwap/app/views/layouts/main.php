<?php $flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GameSwap Marketplace</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="index.php">GameSwap</a>
    <nav aria-label="Main navigation">
        <a href="index.php">Store</a>
        <a href="index.php?route=cart">Cart (<?= Cart::count() ?>)</a>
        <a href="index.php?route=admin">Manage Products</a>
    </nav>
</header>
<main class="container">
    <?php if ($flash): ?><p class="flash"><?= htmlspecialchars($flash) ?></p><?php endif; ?>
    <?= $content ?>
</main>
<footer><p>&copy; <?= date('Y') ?> GameSwap Marketplace</p></footer>
</body>
</html>


<section class="hero">
    <p class="eyebrow">Buy trade play</p>
    <h1>Find your next favorite game</h1>
    <p>Shop games, consoles, and collectibles from the GameSwap marketplace.</p>
</section>

<section>
    <h2>Marketplace inventory</h2>
    <?php if ($products === []): ?>
        <p>No products are available yet.</p>
    <?php else: ?>
        <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <article class="product-card">
                <div class="product-icon" aria-hidden="true"><?= htmlspecialchars(substr($product['category'], 0, 1)) ?></div>
                <p class="tag"><?= htmlspecialchars($product['category']) ?> · <?= htmlspecialchars($product['platform']) ?></p>
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <div class="product-meta">
                    <strong>$<?= number_format((float) $product['price'], 2) ?></strong>
                    <span><?= (int) $product['stock_quantity'] ?> available</span>
                </div>
                <form action="index.php?route=cart/add" method="post" class="add-form">
                    <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                    <label>Quantity
                        <input type="number" name="quantity" value="1" min="1" max="<?= (int) $product['stock_quantity'] ?>" required>
                    </label>
                    <button type="submit" <?= (int) $product['stock_quantity'] === 0 ? 'disabled' : '' ?>>Add to cart</button>
                </form>
            </article>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>


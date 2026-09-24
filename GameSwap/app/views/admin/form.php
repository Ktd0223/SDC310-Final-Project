<h1><?= $product ? 'Edit product' : 'Add product' ?></h1>
<?php if ($errors !== []): ?><div class="errors"><ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form action="index.php?route=admin/save" method="post" class="form-card">
    <input type="hidden" name="id" value="<?= (int) ($product['id'] ?? 0) ?>">
    <label>Product name<input type="text" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required></label>
    <div class="form-grid"><label>Category<input type="text" name="category" value="<?= htmlspecialchars($product['category'] ?? '') ?>" required></label><label>Platform<input type="text" name="platform" value="<?= htmlspecialchars($product['platform'] ?? '') ?>"></label></div>
    <label>Description<textarea name="description" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea></label>
    <div class="form-grid"><label>Price<input type="number" name="price" step="0.01" min="0.01" value="<?= htmlspecialchars((string) ($product['price'] ?? '')) ?>" required></label><label>Stock quantity<input type="number" name="stock_quantity" min="0" value="<?= (int) ($product['stock_quantity'] ?? 0) ?>" required></label></div>
    <label>Image URL optional<input type="url" name="image_url" value="<?= htmlspecialchars($product['image_url'] ?? '') ?>"></label>
    <button type="submit">Save product</button>
</form>


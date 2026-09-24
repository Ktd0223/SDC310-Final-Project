<h1>Checkout</h1>
<p>Order total: <strong>$<?= number_format($subtotal, 2) ?></strong></p>
<?php if ($errors !== []): ?><div class="errors"><ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form action="index.php?route=checkout/place" method="post" class="form-card">
    <label>Full name<input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required></label>
    <label>Email address<input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required></label>
    <label>Shipping address<textarea name="address" rows="4" required><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea></label>
    <button type="submit">Place order</button>
</form>


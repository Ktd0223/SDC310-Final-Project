<h1>Your cart</h1>
<?php if ($items === []): ?>
    <div class="empty-state"><p>Your cart is empty.</p><a class="button" href="index.php">Browse products</a></div>
<?php else: ?>
    <div class="table-wrap">
    <table>
        <thead><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>$<?= number_format((float) $item['price'], 2) ?></td>
                <td>
                    <form action="index.php?route=cart/update" method="post" class="inline-form">
                        <input type="hidden" name="product_id" value="<?= (int) $item['id'] ?>">
                        <input type="number" name="quantity" value="<?= (int) $item['quantity'] ?>" min="0" max="<?= (int) $item['stock_quantity'] ?>">
                        <button type="submit" class="secondary">Update</button>
                    </form>
                </td>
                <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                <td><form action="index.php?route=cart/remove" method="post"><input type="hidden" name="product_id" value="<?= (int) $item['id'] ?>"><button class="danger">Remove</button></form></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="cart-summary"><p>Subtotal <strong>$<?= number_format($subtotal, 2) ?></strong></p><a class="button" href="index.php?route=checkout">Proceed to checkout</a></div>
<?php endif; ?>


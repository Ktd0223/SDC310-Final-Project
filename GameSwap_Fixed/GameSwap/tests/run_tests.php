<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/models/Cart.php';
session_start();
$_SESSION['cart'] = [];

$failures = 0;
function check(bool $condition, string $name): void {
    global $failures;
    echo ($condition ? '[PASS] ' : '[FAIL] ') . $name . PHP_EOL;
    if (!$condition) $failures++;
}

$product = ['id' => 1, 'name' => 'Test Game', 'price' => 19.99, 'stock_quantity' => 3];
Cart::add($product, 2);
check(Cart::count() === 2, 'Adding an item stores its quantity');
check(abs(Cart::subtotal() - 39.98) < 0.001, 'Subtotal uses price times quantity');
Cart::add($product, 5);
check(Cart::count() === 3, 'Quantity cannot exceed available stock');
Cart::update(1, 1);
check(Cart::count() === 1, 'Updating quantity changes the cart');
Cart::update(1, 0);
check(Cart::items() === [], 'A zero quantity removes the item');
Cart::add($product, -2);
check(Cart::count() === 1, 'Invalid negative add quantity becomes one');
Cart::clear();
check(Cart::subtotal() === 0.0, 'Clearing the cart resets the subtotal');

exit($failures === 0 ? 0 : 1);


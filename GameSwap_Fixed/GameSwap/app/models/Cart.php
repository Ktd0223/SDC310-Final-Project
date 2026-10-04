<?php
declare(strict_types=1);

final class Cart
{
    public static function add(array $product, int $quantity): void
    {
        $quantity = max(1, min($quantity, (int) $product['stock_quantity']));
        $id = (int) $product['id'];
        $current = $_SESSION['cart'][$id]['quantity'] ?? 0;
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'name' => $product['name'],
            'price' => (float) $product['price'],
            'stock_quantity' => (int) $product['stock_quantity'],
            'quantity' => min($current + $quantity, (int) $product['stock_quantity']),
        ];
    }

    public static function update(int $id, int $quantity): void
    {
        if (!isset($_SESSION['cart'][$id])) {
            return;
        }
        if ($quantity <= 0) {
            self::remove($id);
            return;
        }
        $_SESSION['cart'][$id]['quantity'] = min(
            $quantity,
            (int) $_SESSION['cart'][$id]['stock_quantity']
        );
    }

    public static function remove(int $id): void
    {
        unset($_SESSION['cart'][$id]);
    }

    public static function items(): array
    {
        return array_values($_SESSION['cart'] ?? []);
    }

    public static function subtotal(): float
    {
        return array_reduce(
            self::items(),
            fn(float $total, array $item): float => $total + ($item['price'] * $item['quantity']),
            0.0
        );
    }

    public static function count(): int
    {
        return array_sum(array_column(self::items(), 'quantity'));
    }

    public static function clear(): void
    {
        $_SESSION['cart'] = [];
    }
}


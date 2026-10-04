<?php
declare(strict_types=1);

final class Order
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $customer, array $items): int
    {
        if ($items === []) {
            throw new InvalidArgumentException('The cart is empty.');
        }

        $this->db->beginTransaction();
        try {
            $total = array_reduce(
                $items,
                fn(float $sum, array $item): float => $sum + ($item['price'] * $item['quantity']),
                0.0
            );
            $orderStatement = $this->db->prepare(
                'INSERT INTO orders (customer_name, customer_email, shipping_address, total_amount, status)
                 VALUES (:customer_name, :customer_email, :shipping_address, :total_amount, "Completed")'
            );
            $orderStatement->execute([
                'customer_name' => $customer['name'],
                'customer_email' => $customer['email'],
                'shipping_address' => $customer['address'],
                'total_amount' => $total,
            ]);
            $orderId = (int) $this->db->lastInsertId();

            $itemStatement = $this->db->prepare(
                'INSERT INTO order_items (order_id, product_id, quantity, unit_price)
                 VALUES (:order_id, :product_id, :quantity, :unit_price)'
            );
            $stockStatement = $this->db->prepare(
                'UPDATE products SET stock_quantity = stock_quantity - :quantity
                 WHERE id = :id AND stock_quantity >= :required_quantity'
            );

            foreach ($items as $item) {
                $stockStatement->execute(['quantity' => $item['quantity'], 'id' => $item['id'], 'required_quantity' => $item['quantity']]);
                if ($stockStatement->rowCount() !== 1) {
                    throw new RuntimeException('Insufficient stock for ' . $item['name'] . '.');
                }
                $itemStatement->execute([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Throwable $error) {
            $this->db->rollBack();
            throw $error;
        }
    }
}


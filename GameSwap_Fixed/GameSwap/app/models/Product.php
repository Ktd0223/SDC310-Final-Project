<?php
declare(strict_types=1);

final class Product
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT id, name, category, platform, description, price, stock_quantity, image_url
             FROM products ORDER BY name'
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare(
            'SELECT id, name, category, platform, description, price, stock_quantity, image_url
             FROM products WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $product = $statement->fetch();
        return $product ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO products (name, category, platform, description, price, stock_quantity, image_url)
             VALUES (:name, :category, :platform, :description, :price, :stock_quantity, :image_url)'
        );
        $statement->execute($data);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $statement = $this->db->prepare(
            'UPDATE products SET name = :name, category = :category, platform = :platform,
             description = :description, price = :price, stock_quantity = :stock_quantity,
             image_url = :image_url WHERE id = :id'
        );
        return $statement->execute($data);
    }

    public function delete(int $id): bool
    {
        $statement = $this->db->prepare('DELETE FROM products WHERE id = :id');
        return $statement->execute(['id' => $id]);
    }
}


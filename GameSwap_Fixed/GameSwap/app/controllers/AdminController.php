<?php
declare(strict_types=1);

final class AdminController extends BaseController
{
    private Product $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('admin/index', ['products' => $this->products->all()]);
    }

    public function form(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $product = $id > 0 ? $this->products->find($id) : null;
        $this->render('admin/form', ['product' => $product, 'errors' => []]);
    }

    public function save(): void
    {
        $this->requirePost();
        $id = (int) ($_POST['id'] ?? 0);
        $data = [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'category' => trim((string) ($_POST['category'] ?? '')),
            'platform' => trim((string) ($_POST['platform'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'price' => (float) ($_POST['price'] ?? 0),
            'stock_quantity' => max(0, (int) ($_POST['stock_quantity'] ?? 0)),
            'image_url' => trim((string) ($_POST['image_url'] ?? '')),
        ];
        $errors = [];
        if ($data['name'] === '') $errors[] = 'Product name is required.';
        if ($data['category'] === '') $errors[] = 'Category is required.';
        if ($data['price'] <= 0) $errors[] = 'Price must be greater than zero.';

        if ($errors !== []) {
            $product = array_merge(['id' => $id], $data);
            $this->render('admin/form', compact('product', 'errors'));
            return;
        }

        $id > 0 ? $this->products->update($id, $data) : $this->products->create($data);
        $_SESSION['flash'] = 'Product saved.';
        $this->redirect('admin');
    }

    public function delete(): void
    {
        $this->requirePost();
        try {
            $this->products->delete((int) ($_POST['id'] ?? 0));
            $_SESSION['flash'] = 'Product deleted.';
        } catch (PDOException $error) {
            $_SESSION['flash'] = 'Products included in an order cannot be deleted.';
        }
        $this->redirect('admin');
    }
}


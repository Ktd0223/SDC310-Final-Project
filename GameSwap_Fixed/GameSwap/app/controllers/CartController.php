<?php
declare(strict_types=1);

final class CartController extends BaseController
{
    private Product $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('cart/index', ['items' => Cart::items(), 'subtotal' => Cart::subtotal()]);
    }

    public function add(): void
    {
        $this->requirePost();
        $product = $this->products->find((int) ($_POST['product_id'] ?? 0));
        if ($product !== null && (int) $product['stock_quantity'] > 0) {
            Cart::add($product, filter_var($_POST['quantity'] ?? 1, FILTER_VALIDATE_INT) ?: 1);
            $_SESSION['flash'] = 'Item added to your cart.';
        }
        $this->redirect('cart');
    }

    public function update(): void
    {
        $this->requirePost();
        Cart::update((int) ($_POST['product_id'] ?? 0), (int) ($_POST['quantity'] ?? 0));
        $_SESSION['flash'] = 'Cart updated.';
        $this->redirect('cart');
    }

    public function remove(): void
    {
        $this->requirePost();
        Cart::remove((int) ($_POST['product_id'] ?? 0));
        $_SESSION['flash'] = 'Item removed.';
        $this->redirect('cart');
    }
}


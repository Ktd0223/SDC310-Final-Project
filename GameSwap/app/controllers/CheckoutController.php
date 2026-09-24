<?php
declare(strict_types=1);

final class CheckoutController extends BaseController
{
    public function __construct(private Order $orders)
    {
    }

    public function index(): void
    {
        if (Cart::items() === []) {
            $_SESSION['flash'] = 'Add at least one item before checking out.';
            $this->redirect('cart');
        }
        $this->render('checkout/index', ['subtotal' => Cart::subtotal(), 'errors' => []]);
    }

    public function placeOrder(): void
    {
        $this->requirePost();
        $customer = [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
            'address' => trim((string) ($_POST['address'] ?? '')),
        ];
        $errors = [];
        if ($customer['name'] === '') $errors[] = 'Name is required.';
        if (!filter_var($customer['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
        if ($customer['address'] === '') $errors[] = 'Shipping address is required.';
        if (Cart::items() === []) $errors[] = 'The cart is empty.';

        if ($errors !== []) {
            $this->render('checkout/index', ['subtotal' => Cart::subtotal(), 'errors' => $errors]);
            return;
        }

        try {
            $orderId = $this->orders->create($customer, Cart::items());
            Cart::clear();
            $this->render('checkout/success', ['orderId' => $orderId]);
        } catch (Throwable $error) {
            $this->render('checkout/index', [
                'subtotal' => Cart::subtotal(),
                'errors' => ['The order could not be completed: ' . $error->getMessage()],
            ]);
        }
    }
}


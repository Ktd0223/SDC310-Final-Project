<?php
declare(strict_types=1);

final class ProductController extends BaseController
{
    private Product $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index(): void
    {
        $this->render('products/index', ['products' => $this->products->all()]);
    }
}


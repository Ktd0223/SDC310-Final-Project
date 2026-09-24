<?php
declare(strict_types=1);

final class ProductController extends BaseController
{
    public function __construct(private Product $products)
    {
    }

    public function index(): void
    {
        $this->render('products/index', ['products' => $this->products->all()]);
    }
}


<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/models/Product.php';
require_once __DIR__ . '/../app/models/Cart.php';
require_once __DIR__ . '/../app/models/Order.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';
require_once __DIR__ . '/../app/controllers/CheckoutController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

try {
    $db = Database::connection();
    $products = new Product($db);
    $route = trim((string) ($_GET['route'] ?? ''), '/');

    switch ($route) {
        case '': (new ProductController($products))->index(); break;
        case 'cart': (new CartController($products))->index(); break;
        case 'cart/add': (new CartController($products))->add(); break;
        case 'cart/update': (new CartController($products))->update(); break;
        case 'cart/remove': (new CartController($products))->remove(); break;
        case 'checkout': (new CheckoutController(new Order($db)))->index(); break;
        case 'checkout/place': (new CheckoutController(new Order($db)))->placeOrder(); break;
        case 'admin': (new AdminController($products))->index(); break;
        case 'admin/form': (new AdminController($products))->form(); break;
        case 'admin/save': (new AdminController($products))->save(); break;
        case 'admin/delete': (new AdminController($products))->delete(); break;
        default: http_response_code(404); echo 'Page not found.';
    }
} catch (PDOException $error) {
    http_response_code(500);
    echo '<h1>Database connection error</h1><p>Import database/gameswap.sql and verify app/config/settings.php.</p>';
}


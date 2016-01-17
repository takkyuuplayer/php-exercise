<?php
require_once __DIR__ . '/../bootstrap.php';

$id = 3;
$product = $entityManager->find('Product', $id);
if (is_null($product)) {
    echo "Product not found \n";
    exit(1);
}

echo sprintf("-%s\n", $product->getName());

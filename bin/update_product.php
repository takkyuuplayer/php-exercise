<?php
require_once __DIR__ . '/../bootstrap.php';

$id = 3;
$newName = 'new name ' . time();

$product = $entityManager->find('Product', $id);
if (is_null($product)) {
    echo "Product not found \n";
    exit(1);
}

$product->setName($newName);
$entityManager->flush();

<?php

require '../Repositories/ProductRepository.php';


$productRepo = new ProductRepository();
$productIDs = $_POST['productIDs'];
echo json_encode($productRepo->deleteProducts($productIDs));
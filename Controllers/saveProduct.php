<?php

require '../Repositories/ProductRepository.php';

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['productType'];
$size = $_POST['size'];
$height = $_POST['height'];
$width = $_POST['width'];
$length = $_POST['length'];
$weight = $_POST['weight'];


//$data = array("sku" => $sku,
//    "name" => $name,
//    "price" => $price,
//    "productType" => $productType,
//    "size" => $size,
//    "height" => $height,
//    "width" => $width,
//    "length" => $length,
//    "weight" => $weight
//
//);
//
//
//echo json_encode($data);

$info = array("status" => "ok");
$productRepo = new ProductRepository();
if ($productRepo->checkSKU($sku)) {
    $res = $productRepo->saveProduct($sku, $name, $price, $productType, $size, $height, $width, $length, $weight);
    $info['status'] = $res;
} else {
    $info["status"] = "error";
    $info["message"] = "SKU_not_unique";

}
echo json_encode($info);



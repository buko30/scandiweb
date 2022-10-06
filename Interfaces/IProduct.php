<?php

interface IProduct
{
    public function saveProduct($sku, $name, $price, $productType, $size, $height, $width, $length, $weight);

    public function checkSKU($sku);

    public function getAllProducts();

    public function deleteProducts($productIDs);

}
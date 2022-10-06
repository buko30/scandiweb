<?php
require '../Interfaces/IProduct.php';
require '../Controllers/DatabaseUtils.php';
require '../Models/Product.php';


class ProductRepository implements IProduct
{

    public function saveProduct($sku, $name, $price, $productType, $size, $height, $width, $length, $weight)
    {
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $queryString = "INSERT INTO product (SKU, Name, Price, type, MB, Height, Width, Length, KG)
                            VALUES (:sku, :name, :price, :type, :mb, :height, :width, :length, :kg)";
            $statement = $handler->prepare($queryString);
            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':price', $price, PDO::PARAM_STR);
            $statement->bindParam(':type', $productType, PDO::PARAM_STR);
            $statement->bindParam(':mb', $size, ($size != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(':height', $height, ($height != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(':width', $width, ($width != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(':length', $length, ($length != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindParam(':kg', $weight, ($weight != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);

            $statement->execute();

            return "success";
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return "error";
        }
    }

    public function checkSKU($sku)
    {
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $count = 0;

        try {

            $queryString = "SELECT COUNT(SKU) from product where SKU = :sku";
            $statement = $handler->prepare($queryString);

            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
            $statement->execute();

            $count = (int)$statement->fetchColumn();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        return $count == 0;

    }

    public function getAllProducts()
    {
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $info = array();
        $cont = array();
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $queryString = "select ID, SKU, Name, Price, type, MB, Height, Width, Length, KG from product";
            $statement = $handler->query($queryString);
            $statement->setFetchMode(PDO::FETCH_OBJ);

            while ($row = $statement->fetch()) {
                $cont[] = $row;
            }
            $info['status'] = 'success';
            $info['data'] = $cont;
        } catch (PDOException $ex) {
            //echo $ex->getMessage();
            $info['status'] = 'error';
            $info['message'] = $ex->getMessage();
        }
        return $info;
    }

    public function deleteProducts($productIDs)
    {
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $info = array();
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $queryString = "DELETE FROM product WHERE ID IN (".implode(', ',$productIDs).")";
            $statement = $handler->prepare($queryString);
            $statement->execute();
            $info["status"] = "success";
            $info["rowCount"] = $statement->rowCount();
        }
        catch (PDOException $ex) {
            //echo $ex->getMessage();
            $info['status'] = 'error';
            $info['message'] = $ex->getMessage();
        }
        return $info;
    }
}
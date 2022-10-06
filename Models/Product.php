<?php

class Product
{
private $ID, $SKU,$Name, $Price, $type, $MB, $KG, $Height, $Width, $Length;

    /**
     * @param $ID
     * @param $SKU
     * @param $Name
     * @param $Price
     * @param $type
     * @param $MB
     * @param $KG
     * @param $Height
     * @param $Width
     * @param $Length
     */
    public function __construct($ID, $SKU, $Name, $Price, $type, $MB, $KG, $Height, $Width, $Length)
    {
        $this->ID = $ID;
        $this->SKU = $SKU;
        $this->Name = $Name;
        $this->Price = $Price;
        $this->type = $type;
        $this->MB = $MB;
        $this->KG = $KG;
        $this->Height = $Height;
        $this->Width = $Width;
        $this->Length = $Length;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getSKU()
    {
        return $this->SKU;
    }

    /**
     * @param mixed $SKU
     */
    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param mixed $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMB()
    {
        return $this->MB;
    }

    /**
     * @param mixed $MB
     */
    public function setMB($MB)
    {
        $this->MB = $MB;
    }

    /**
     * @return mixed
     */
    public function getKG()
    {
        return $this->KG;
    }

    /**
     * @param mixed $KG
     */
    public function setKG($KG)
    {
        $this->KG = $KG;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->Height;
    }

    /**
     * @param mixed $Height
     */
    public function setHeight($Height)
    {
        $this->Height = $Height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->Width;
    }

    /**
     * @param mixed $Width
     */
    public function setWidth($Width)
    {
        $this->Width = $Width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->Length;
    }

    /**
     * @param mixed $Length
     */
    public function setLength($Length)
    {
        $this->Length = $Length;
    }


}
<?php
class Product {
    public $productID;
    public $name;
    public $description;
    public $price;
    public $brandID;
    public $categoryID;
    public $stockStatus;
    public $imageURL;

    function __construct($productID, $name, $description, $price, $brandID, $categoryID, $stockStatus, $imageURL) {
        $this->productID = $productID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->brandID = $brandID;
        $this->categoryID = $categoryID;
        $this->stockStatus = $stockStatus;
        $this->imageURL = $imageURL;
    }

    public function viewDetails() {
        return [
            "productID" => $this->productID,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "brandID" => $this->brandID,
            "categoryID" => $this->categoryID,
            "stockStatus" => $this->stockStatus,
            "imageURL" => $this->imageURL
        ];
    }
}
?>

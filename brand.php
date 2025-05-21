<?php
require_once 'C:\wamp64\www\(Local-shop)\connect.php';
class Brand {
    private $conn;
    private $brandID;
    private $brandName;
    private $brandDescription;
    private $brandOwnerID;
    private $brandLogoURL;

    public function __construct($brandID, $brandName, $brandDescription, $brandOwnerID, $brandLogoURL,$conn) {
        $this->conn = $conn;
        $this->brandID = $brandID;
        $this->brandName = $brandName;
        $this->brandDescription = $brandDescription;
        $this->brandOwnerID = $brandOwnerID;
        $this->brandLogoURL = $brandLogoURL;
    }

    
    public function getBrandID() {
        return $this->brandID;
    }

    public function getBrandName() {
        return $this->brandName;
    }

    public function getBrandDescription() {
        return $this->brandDescription;
    }

    public function getBrandOwnerID() {
        return $this->brandOwnerID;
    }

    public function getBrandLogoURL() {
        return $this->brandLogoURL;
    }

   
    public function setBrandName($name) {
        $this->brandName = $name;
    }

    public function setBrandDescription($description) {
        $this->brandDescription = $description;
    }

    public function setBrandOwnerID($ownerID) {
        $this->brandOwnerID = $ownerID;
    }

    public function setBrandLogoURL($logoURL) {
        $this->brandLogoURL = $logoURL;
    }

   
    public function updateDetails($brandName, $brandDescription, $brandOwnerID, $brandLogoURL) {
        $this->brandName = $brandName;
        $this->brandDescription = $brandDescription;
        $this->brandOwnerID = $brandOwnerID;
        $this->brandLogoURL = $brandLogoURL;
        echo "Brand details for {$this->brandName} have been updated.<br>";
    }
    
   
    
   
    public function getBrand($brandID) {
    $stmt = $this->conn->prepare("SELECT * FROM brands WHERE brandID = ?");
    $stmt->bind_param("i", $brandID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return new Brand(
            $row['brandID'],
            $row['brandName'],
            $row['brandDescription'],
            $row['brandOwnerID'],
            $row['brandLogoURL'],
            $this->conn 
        );
    } else {
        return null;
    }
}

  
    public function updateBrand(Brand $brand) {
        $stmt = $this->conn->prepare("UPDATE brands 
                                      SET brandName = ?, brandDescription = ?, brandLogoURL = ? 
                                      WHERE brandID = ?");
        
        $id = $brand->getBrandID();
        $name = $brand->getBrandName();
        $description = $brand->getBrandDescription();
        $logoURL = $brand->getBrandLogoURL();
        
        $stmt->bind_param("sssi", $name, $description, $logoURL, $id);
        
        return $stmt->execute();
    }
    
  
    public function getBrandCategories($brandID) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE brandID = ?");
        $stmt->bind_param("i", $brandID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $categories = [];
        while($row = $result->fetch_assoc()) {
            $categories[] = [
                'id' => $row['categoryID'],
                'name' => $row['categoryName']
            ];
        }
        
        return $categories;
    }
}
?>
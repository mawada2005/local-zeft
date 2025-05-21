
<?php
require_once 'C:\wamp64\www\(Local-shop)\Models\brand.php';
require_once 'C:\wamp64\www\(Local-shop)\connect.php';

class BrandController {
    private $conn;
    private $brandModel;
    public function __construct($Conn) {
        $this->conn = $Conn;
        
    }

    public function showBrand($brandID) {
        $brand = new Brand($this->conn);
        if ($brand->loadByID($brandID)) {
            require_once 'Dbrandowner.php'; 
        } else {
            echo "Brand not found.";
        }
    }

    public function updateBrand($postData) {
        $brand = new Brand($this->conn);
        if ($brand->loadByID($postData['brandID'])) {
            $brand->setBrandName($postData['brandName']);
            $brand->setBrandDescription($postData['brandDescription']);
            $brand->setBrandLogoURL($postData['brandLogoURL']);

            if ($brand->updateBrand($brand)) {
                echo "Brand updated successfully.";
            } else {
                echo "Failed to update brand.";
            }
        } else {
            echo "Brand not found.";
        }
    }
  

    public function getBrandDetails($brandID) {
        
        $brand = $this->brandModel->getBrand($brandID);
        if ($brand) {
            
            return [
                'brandID' => $brand->getBrandID(),
                'brandName' => $brand->getBrandName(),
                'brandDescription' => $brand->getBrandDescription(),
                'brandOwnerID' => $brand->getBrandOwnerID(),
                'brandLogoURL' => $brand->getBrandLogoURL(),
            ];
        } else {
            return null; 
        }
    }
}


?>

class Brand {
    public $brandID;
    public $ownerID;
    public $name;
    public $description;
    public $logoURL;
    public $categoryID;

    function __construct($brandID, $ownerID, $name, $description, $logoURL, $categoryID) {
        $this->brandID = $brandID;
        $this->ownerID = $ownerID;
        $this->name = $name;
        $this->description = $description;
        $this->logoURL = $logoURL;
        $this->categoryID = $categoryID;
    }

    public function getBrandID() {
        return $this->brandID;
    }

    public function getBrandName() {
        return $this->name;
    }
}

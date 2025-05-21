<?php
require_once(__DIR__ . "/../Model/User.php");
require_once(__DIR__ . "/Model/Brand.php");
require_once(__DIR__ . "/Model/SimpleNotification.php");
require_once(__DIR__ . "/Model/StatisticsManager.php");


class Admin extends User {

    // Aggregation: Admin manages users and brands
    private array $managedUsers = [];
    private array $managedBrands = [];

    // Dependency: not owned, just used
    private StatisticsManager $statisticsManager;

    public function __construct($userID, $name, $email, $password, StatisticsManager $statisticsManager) {
        parent::__construct($userID, $name, $email, $password);
        $this->statisticsManager = $statisticsManager;
    }

    // ================= Manage Users =================
    public function addUser(User $user) {
        $this->managedUsers[$user->getUserID()] = $user;
        echo "Admin {$this->getName()} added user: {$user->getName()}<br>";
    }

    public function removeUser($userID) {
        if (isset($this->managedUsers[$userID])) {
            $userName = $this->managedUsers[$userID]->getName();
            unset($this->managedUsers[$userID]);
            echo "Admin {$this->getName()} removed user: $userName<br>";
        } else {
            echo "User ID $userID not found.<br>";
        }
    }

    // ================= Manage Brands =================
    public function addBrand(Brand $brand) {
        $this->managedBrands[$brand->getBrandID()] = $brand;
        echo "Admin {$this->getName()} added a new brand: {$brand->getBrandName()}<br>";
    }

    public function deleteBrand($brandID) {
        if (isset($this->managedBrands[$brandID])) {
            $brandName = $this->managedBrands[$brandID]->getBrandName();
            unset($this->managedBrands[$brandID]);
            echo "Admin {$this->getName()} deleted the brand: $brandName<br>";
        } else {
            echo "Brand ID $brandID not found.<br>";
        }
    }

    // ================= Notifications =================
    public function sendNotification(Notification $notification) {
        echo "Admin {$this->getName()} sent notification: \"{$notification->getMessage()}\"<br>";
    }

    // ================= Reports =================
    public function viewReports() {
        $report = $this->statisticsManager->generateReport();
        echo "Admin {$this->getName()} is viewing reports: $report<br>";
    }
}
?>

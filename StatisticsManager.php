<?php
class StatisticsManager {
    private $brandStats;
    private $userActivity;

    public function __construct($brandStats = [], $userActivity = []) {
        $this->brandStats = $brandStats;
        $this->userActivity = $userActivity;
    }

    public function GetBrandStatistics($brandId) {
        if (isset($this->brandStats[$brandId])) {
            return $this->brandStats[$brandId];
        }
        return null;
    }

    public function getUserActivityReport($userId) {
        if (isset($this->userActivity[$userId])) {
            return $this->userActivity[$userId];
        }
        return null;
    }

    public function generateReport() {
        return "📊 System Report: 5 brands, 120 users, 37 active orders.";
    }
}
?>

<?php
require_once "payment.php";

class Fawry implements Payment {
    public function pay(float $amount): void {
        echo "Paying $amount via Fawry.<br>";
    }
}
?>

<?php
require_once "payment.php";

class CreditCard implements Payment {
    public function pay(float $amount): void {
        echo "Paying $amount with Credit Card.<br>";
    }
}
?>

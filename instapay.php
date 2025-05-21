<?php
require_once "payment.php";

class InstaPay implements Payment {
    public function pay(float $amount): void {
        echo "Paying $amount via InstaPay.<br>";
    }
}
?>

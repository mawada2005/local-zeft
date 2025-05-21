<?php
interface Payment {
    public function pay(float $amount): void;
}
?>

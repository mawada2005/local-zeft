<?php
require_once "creditcard.php";
require_once "fawry.php";
require_once "instapay.php";

// Testing different payment methods
$payment1 = new CreditCard();
$payment1->pay(250.00);

$payment2 = new Fawry();
$payment2->pay(100.00);

$payment3 = new InstaPay();
$payment3->pay(75.504);
?>

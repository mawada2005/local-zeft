<?php
// الكلاس البسيط المطلوب من Admin.php
class Notification {
    private $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }
}
?>

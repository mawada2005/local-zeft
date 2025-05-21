<?php
    require_once ("deliverypersonal.php");
    require_once ("order.php");

class delivery{
    private $deliveryID;
    private $orderID;
    private $deliverypersonal;
    private $status;

    public function getdeliveryID()
    {
        return $this->deliveryID;
    }
    public function setdeliveryID($deliveryID): self
    {
            $this->deliveryID = $deliveryID;
            return $this;
    }

    public function getorderID()
    {
        return $this->orderID;
    }
    public function setorderID($orderID): self
    {
            $this->orderID = $orderID;
            return $this;
    }

    public function getdeliverypersonal()
    {
        return $this->deliverypersonal;
    }
    public function setdeliverypersonal($deliverypersonal): self
    {
            $this->deliverypersonal = $deliverypersonal;
            return $this;
    }

    public function getstatus()
    {
        return $this->status;
    }
    public function setstatus($status): self
    {
            $this->status = $status;
            return $this;
    }

    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
        return $this;        
    }
}
?>
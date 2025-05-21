<?php

class order{
    private $orderID;
    private $customerID;
    private $brandID;
    private $status;
    private $dpID;



    public function getorderID()
    {
        return $this->orderID;
    }
    public function setorderID($orderID): self
    {
        $this->orderID = $orderID;
        return $this;
    }

    public function getcustomerID()
    {
        return $this->customerID;
    }
    public function setcustomerID($customerID): self
    {
        $this->customerID = $customerID;
        return $this;
    }

    public function getbrandID()
    {
        return $this->brandID;
    }
    public function setbrandID($brandID): self
    {
        $this->brandID = $brandID;
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

    public function AssignToDelivery($deliverypersonal)
    {
        $this->dpID = $deliverypersonal->getDeliveryID();
        $deliverypersonal->assignOrder($this); 
    }
}

?>
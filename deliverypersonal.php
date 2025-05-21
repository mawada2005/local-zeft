<?php
    require_once ("user.php");
    require_once ("order.php");

    class deliverypersonal extends user
    {
        private $assignedOrders = [];
        private $deliveryID;

        public function __construct($userID, $name, $email, $password)
        {
            parent::__construct($userID, $name, $email, $password);
        }

        public function getdeliveryID()
        {
            return $this->deliveryID;
        }
        public function setdeliveryID($deliveryID): self
        {
            $this->deliveryID = $deliveryID;
            return $this;
        }

        public function receiveOrders(array $allOrders): self
        {
            foreach ($allOrders as $order) 
            {
                if ($order['dpID'] == $this->deliveryID) 
                {
                    $this->assignedOrders[] = $order;
                }
            }
            return $this;
        }

        public function updateDeliveryStatus($orderID, $newStatus): self 
        {
           foreach ($this->assignedOrders as $index => $order)
            {
                  if ($order->getorderID() == $orderID)
                    {
                         $this->assignedOrders[$index]->setstatus($newStatus);
                         return $this;
                    }
            }
        }

        

        public function assignOrder(Order $order): void {
            $this->assignedOrders[] = $order;
        }
    
        public function viewAssignedOrders(): array {
            return $this->assignedOrders;
        }
    }

?>
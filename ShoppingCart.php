<?php
require_once('connect.php');

class ShoppingCart {
    private $items = [];
    private $connection; // make sure this is declared

    public function setItems(array $items) {
        $this->items = $items;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function setConnection($connection) {
        $this->connection = $connection;
    }

    public function getItemsAsJson(): string {
        return json_encode($this->items);
    }

    public function addProduct($product) {
        $productID = $product['productID'];
        $found = false;

        foreach ($this->items as &$item) {
            if ($item['productID'] == $productID) {
                $item['quantity'] += $product['quantity'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $this->items[] = $product;
        }
    }

    public function removeProduct($productID) {
        foreach ($this->items as $index => $item) {
            if ($item['productID'] == $productID) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                break;
            }
        }
    }

    public function getProducts(): array {
        return $this->getItems();
    }

    public function getTotal(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // ✅ MySQLi-compatible version
    public function loadFromDatabase($customerID) {
        $query = "SELECT items FROM shoppingCart WHERE customerID = ?";
        $stmt = $this->connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $customerID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if (!empty($row['items'])) {
                    $this->items = json_decode($row['items'], true);
                }
            }

            $stmt->close();
        } else {
            die("MySQLi prepare() failed: " . $this->connection->error);
        }
    }

    // ✅ MySQLi-compatible version
    public function saveToDatabase($customerID) {
        $itemsJson = $this->getItemsAsJson();
        $query = "UPDATE shoppingCart SET items = ? WHERE customerID = ?";
        $stmt = $this->connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $itemsJson, $customerID);
            $stmt->execute();
            $stmt->close();
        } else {
            die("MySQLi prepare() failed: " . $this->connection->error);
        }
    }
}

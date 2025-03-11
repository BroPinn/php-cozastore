<?php
class OrderModel {
    private $orderID;
    private $customerID;
    private $orderDate;
    private $totalAmount;
    private $status;
    private $shippingAddress;
    private $paymentMethod;
    private $trackingNumber;
    private $created_at;
    private $updated_at;
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getOrders() {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }
            
            $stmt = $pdo->query("SELECT o.*, c.firstName, c.lastName, c.email 
                                FROM tbl_order o
                                JOIN tbl_customer c ON o.customerID = c.customerID
                                ORDER BY o.orderDate DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Order Fetch Error: " . $e->getMessage());
            return [];
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return [];
        }
    }

    public function getOrderById($orderID) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT o.*, c.firstName, c.lastName, c.email 
                                  FROM tbl_order o
                                  JOIN tbl_customer c ON o.customerID = c.customerID
                                  WHERE o.orderID = ?");
            $stmt->execute([$orderID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Order Fetch Error: " . $e->getMessage());
            return null;
        }
    }

    public function getOrdersByCustomer($customerID) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT * FROM tbl_order WHERE customerID = ? ORDER BY orderDate DESC");
            $stmt->execute([$customerID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Order Fetch Error: " . $e->getMessage());
            return [];
        }
    }

    public function createOrder($customerID, $totalAmount, $shippingAddress, $paymentMethod) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            // Start transaction
            $pdo->beginTransaction();

            // Insert order
            $stmt = $pdo->prepare("INSERT INTO tbl_order (customerID, orderDate, totalAmount, status, shippingAddress, paymentMethod) 
                                  VALUES (?, NOW(), ?, 'pending', ?, ?)");
            $success = $stmt->execute([
                $customerID,
                $totalAmount,
                $shippingAddress,
                $paymentMethod
            ]);

            if (!$success) {
                $pdo->rollBack();
                return false;
            }

            $orderID = $pdo->lastInsertId();

            // Insert order items from cart
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $stmt = $pdo->prepare("INSERT INTO tbl_order_item (orderID, productID, quantity, price) 
                                      VALUES (?, ?, ?, ?)");
                
                foreach ($_SESSION['cart'] as $item) {
                    $success = $stmt->execute([
                        $orderID,
                        $item['productID'],
                        $item['quantity'],
                        $item['price']
                    ]);
                    
                    if (!$success) {
                        $pdo->rollBack();
                        return false;
                    }
                }
                
                // Clear the cart after successful order
                unset($_SESSION['cart']);
            }

            // Commit transaction
            $pdo->commit();
            return $orderID;
        } catch (PDOException $e) {
            if ($pdo) {
                $pdo->rollBack();
            }
            error_log("Order Creation Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateOrderStatus($orderID, $status, $trackingNumber = null) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $sql = "UPDATE tbl_order SET status = ?, updated_at = NOW()";
            $params = [$status];

            if ($trackingNumber !== null) {
                $sql .= ", trackingNumber = ?";
                $params[] = $trackingNumber;
            }

            $sql .= " WHERE orderID = ?";
            $params[] = $orderID;

            $stmt = $pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Order Status Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItems($orderID) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT oi.*, p.productName, p.image_path 
                                  FROM tbl_order_item oi
                                  JOIN tbl_product p ON oi.productID = p.productID
                                  WHERE oi.orderID = ?");
            $stmt->execute([$orderID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Order Items Fetch Error: " . $e->getMessage());
            return [];
        }
    }

    public function getOrderStatistics() {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stats = [];

            // Total orders
            $stmt = $pdo->query("SELECT COUNT(*) as total FROM tbl_order");
            $stats['totalOrders'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Total revenue
            $stmt = $pdo->query("SELECT SUM(totalAmount) as revenue FROM tbl_order WHERE status != 'cancelled'");
            $stats['totalRevenue'] = $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;

            // Orders by status
            $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM tbl_order GROUP BY status");
            $stats['ordersByStatus'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Recent orders
            $stmt = $pdo->query("SELECT o.*, c.firstName, c.lastName 
                                FROM tbl_order o
                                JOIN tbl_customer c ON o.customerID = c.customerID
                                ORDER BY o.orderDate DESC LIMIT 5");
            $stats['recentOrders'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $stats;
        } catch (PDOException $e) {
            error_log("Order Statistics Error: " . $e->getMessage());
            return [];
        }
    }

    // Getters and Setters
    public function getOrderID() { return $this->orderID; }
    public function getCustomerID() { return $this->customerID; }
    public function getOrderDate() { return $this->orderDate; }
    public function getTotalAmount() { return $this->totalAmount; }
    public function getStatus() { return $this->status; }
    public function getShippingAddress() { return $this->shippingAddress; }
    public function getPaymentMethod() { return $this->paymentMethod; }
    public function getTrackingNumber() { return $this->trackingNumber; }
    
    public function setOrderID($value) { $this->orderID = $value; }
    public function setCustomerID($value) { $this->customerID = $value; }
    public function setOrderDate($value) { $this->orderDate = $value; }
    public function setTotalAmount($value) { $this->totalAmount = $value; }
    public function setStatus($value) { $this->status = $value; }
    public function setShippingAddress($value) { $this->shippingAddress = $value; }
    public function setPaymentMethod($value) { $this->paymentMethod = $value; }
    public function setTrackingNumber($value) { $this->trackingNumber = $value; }
}

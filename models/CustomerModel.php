<?php
class CustomerModel {
    private $customerID;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $address;
    private $phone;
    private $created_at;
    private $updated_at;
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCustomers() {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }
            
            $stmt = $pdo->query("SELECT * FROM tbl_customer ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Customer Fetch Error: " . $e->getMessage());
            return [];
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return [];
        }
    }

    public function getCustomerById($customerID) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE customerID = ?");
            $stmt->execute([$customerID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Customer Fetch Error: " . $e->getMessage());
            return null;
        }
    }

    public function getCustomerByEmail($email) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Customer Fetch Error: " . $e->getMessage());
            return null;
        }
    }

    public function createCustomer($firstName, $lastName, $email, $password, $address, $phone) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO tbl_customer (firstName, lastName, email, password, address, phone) 
                                  VALUES (?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $firstName,
                $lastName,
                $email,
                $hashedPassword,
                $address,
                $phone
            ]);
        } catch (PDOException $e) {
            error_log("Customer Creation Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateCustomer($customerID, $firstName, $lastName, $email, $address, $phone) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("UPDATE tbl_customer 
                                  SET firstName = ?, lastName = ?, email = ?, address = ?, phone = ?, updated_at = NOW() 
                                  WHERE customerID = ?");
            return $stmt->execute([
                $firstName,
                $lastName,
                $email,
                $address,
                $phone,
                $customerID
            ]);
        } catch (PDOException $e) {
            error_log("Customer Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function updatePassword($customerID, $newPassword) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE tbl_customer SET password = ?, updated_at = NOW() WHERE customerID = ?");
            return $stmt->execute([$hashedPassword, $customerID]);
        } catch (PDOException $e) {
            error_log("Password Update Error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCustomer($customerID) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("DELETE FROM tbl_customer WHERE customerID = ?");
            return $stmt->execute([$customerID]);
        } catch (PDOException $e) {
            error_log("Customer Deletion Error: " . $e->getMessage());
            return false;
        }
    }

    public function authenticateCustomer($email, $password) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE email = ?");
            $stmt->execute([$email]);
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($customer && password_verify($password, $customer['password'])) {
                return $customer;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Authentication Error: " . $e->getMessage());
            return false;
        }
    }

    // Getters and Setters
    public function getCustomerID() { return $this->customerID; }
    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getEmail() { return $this->email; }
    public function getAddress() { return $this->address; }
    public function getPhone() { return $this->phone; }
    
    public function setCustomerID($value) { $this->customerID = $value; }
    public function setFirstName($value) { $this->firstName = $value; }
    public function setLastName($value) { $this->lastName = $value; }
    public function setEmail($value) { $this->email = $value; }
    public function setAddress($value) { $this->address = $value; }
    public function setPhone($value) { $this->phone = $value; }
}

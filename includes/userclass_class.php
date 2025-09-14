<?php
class user {
    private $conn;
    public int $id = 0;
    public string $username = '';

    public function __construct($usernameOrId) {
        $this->conn = Database::getConnection();

        // Use prepared statement for security
        $sql = "SELECT `id`, `username` FROM `live` WHERE `username` = ? OR `id` = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $usernameOrId, $usernameOrId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows) {
            $row = $result->fetch_assoc();
            $this->id = (int)$row['id'];
            $this->username = $row['username'];
        } else {
            $stmt->close();
            throw new Exception("User not found.");
        }
        $stmt->close();
    }

    public function __call($name, $arguments) {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3));
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property));

        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        } else {
            throw new Exception("function -> $name is not available");
        }
    }

    public static function signup($user, $pass, $email, $phone) {
        $options = ['cost' => 11];
        $passHash = password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();

        $sql = "INSERT INTO `live` (`username`, `password`, `phone`, `email`, `blocked`) VALUES (?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($sql);

        $error = false;
        try {
            if ($stmt) {
                $stmt->bind_param("ssss", $user, $passHash, $phone, $email);
                if ($stmt->execute()) {
                    // Success
                } else {
                    $error = $stmt->error;
                }
                $stmt->close();
            } else {
                $error = $conn->error;
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        // Do not close connection here; close after all operations
        return $error;
    }

    public static function login($user, $pass) {
        $conn = Database::getConnection();
        $sql = "SELECT `id`, `password` FROM `live` WHERE `username` = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($pass, $row['password'])) {
                    $userId = $row['id'];
                    $stmt->close();
                    return $userId;
                }
            }
            $stmt->close();
        }
        return false;
    }

    private function _get_data($var) {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Use prepared statement if the property is user-supplied
        $sql = "SELECT `$var` FROM `users` WHERE `id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $value = ($result && $result->num_rows === 1) ? $result->fetch_assoc()[$var] : null;
        $stmt->close();
        return $value;
    }

    private function _set_data($var, $data) {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        // Use prepared statement if the data is user-supplied
        $sql = "UPDATE `users` SET `$var`=? WHERE `id`=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $data, $this->id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function setDob($year, $month, $day) {
        if (checkdate($month, $day, $year)) {
            return $this->_set_data('dob', "$year.$month.$day");
        }
        return false;
    }

    public function getUsername() {
        return $this->username;
    }

    public function authenticate() {
        // Left empty intentionally
    }
}
?>
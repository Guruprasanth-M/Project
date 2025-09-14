<?php
class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn instanceof mysqli && self::$conn->ping()) {
            // Connection exists and is alive
            return self::$conn;
        }

        $servername = get_config('db_server');
        $username = get_config('db_username');
        $password = get_config('db_password');
        $dbname = get_config('db_name');

        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            throw new Exception("Connection failed: " . $connection->connect_error);
        }

        self::$conn = $connection;
        return self::$conn;
    }

    public static function closeConnection() {
        if (self::$conn instanceof mysqli) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
?>
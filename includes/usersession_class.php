<?php

class UserSession
{
    private $conn;
    private string $token;
    private ?array $data = null;
    private int $uid;
    private const SESSION_TIMEOUT = 3600; // 1 hour

    /**
     * Authenticate user and create new session row.
     */
    public static function authenticate($user, $pass, $fingerprint = null)
    {
        $username = User::login($user, $pass);
        if ($username) {
            $userObj = new User(usernameOrId: $username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $token = bin2hex(random_bytes(32)); // Secure random token

            // Fingerprint is a hash for privacy/security
            $fingerprint = hash('sha256', $fingerprint ?? $ip . $agent);

            // Use prepared statement for security
            $stmt = $conn->prepare(
                "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`)
                 VALUES (?, ?, NOW(), ?, ?, 1, ?)"
            );
            $stmt->bind_param("issss", $userObj->id, $token, $ip, $agent, $fingerprint);

            if ($stmt->execute()) {
                Session::set('session_token', $token);
                Session::set('fingerprint', $fingerprint);
                return $token;
            } else {
                error_log("DB Error: " . $stmt->error);
                return false;
            }
        }
        return false;
    }

    /**
     * Authorize current session by token and fingerprint.
     */
    public static function authorize($token)
    {
        try {
            $session = new UserSession($token);
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $agent = $_SERVER["HTTP_USER_AGENT"] ?? '';
            $fingerprint = Session::get('fingerprint', null);

            // Checks: is valid, active, IP, User Agent, Fingerprint
            if (
                $session->isValid()
                && $session->isActive()
                && $ip === $session->getIP()
                && $agent === $session->getUserAgent()
                && hash_equals($session->getFingerprint(), (string)$fingerprint)
            ) {
                return true;
            } else {
                $session->removeSession();
                return false;
            }
        } catch (\Throwable $e) {
            error_log("Session Auth Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Construct session from token.
     */
    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;

        // Secure lookup
        $stmt = $this->conn->prepare("SELECT * FROM `session` WHERE `token` = ? LIMIT 1");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = (int)$row['uid'];
        } else {
            throw new Exception("Session is invalid.");
        }
    }

    public function getUser()
    {
        return new User($this->uid);
    }

    public function isValid(): bool
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            return (self::SESSION_TIMEOUT > time() - $login_time->getTimestamp());
        }
        throw new Exception("Login time is null");
    }

    public function getIP()
    {
        return $this->data["ip"] ?? false;
    }

    public function getUserAgent()
    {
        return $this->data["user_agent"] ?? false;
    }

    public function deactivate()
    {
        $stmt = $this->conn->prepare("UPDATE `session` SET `active` = 0 WHERE `token` = ?");
        $stmt->bind_param("s", $this->token);
        return $stmt->execute();
    }

    public function isActive()
    {
        return isset($this->data['active']) ? (bool)$this->data['active'] : false;
    }

    public function getFingerprint()
    {
        return $this->data['fingerprint'] ?? false;
    }

    public function removeSession()
    {
        if (isset($this->data['id'])) {
            $id = (int)$this->data['id'];
            $stmt = $this->conn->prepare("DELETE FROM `session` WHERE `id` = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }
}
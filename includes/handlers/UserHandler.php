<?php
if ( !class_exists('BaseHandler') ) {
    include ABS_PATH . 'includes/handlers/BaseHandler.php';
}

class UserHandler extends BaseHandler {
    private $user;
    
    function __construct() {
        parent::__construct();
        
        if ( isset($_SESSION['user']) ) {
            $this->user = $_SESSION['user'];
        }
    }
    
    public function register($email, $password, $first_name, $last_name, $timezone_id) {
        include ABS_PATH . 'libs/PasswordLib/PasswordLib.php';
        $password_hasher = new PasswordLib\PasswordLib;
        
        $this->db->exec('
        INSERT INTO users
        SET
            email = ' . $this->db->quote(trim($email)) . ',
            password = ' . $this->db->quote($password_hasher->createPasswordHash(trim($password))) . ',
            first_name = ' . $this->db->quote(trim($first_name)) . ',
            last_name = ' . $this->db->quote(trim($last_name)) . ',
            registered = ' . $_SERVER['REQUEST_TIME'] . '
        ');
        
        return $this->db->lastInsertId();
    }
    
    public function edit($user_id, array $data) {
        $first_name = trim($data['first_name']);
        $last_name = trim($data['last_name']);
        
        $this->db->exec('
        UPDATE users
        SET
            first_name = ' . $this->db->quote(trim($first_name)) . ',
            last_name = ' . $this->db->quote(trim($last_name)) . '
        WHERE id = ' . $this->db->quote($user_id)
        );
        
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        
        $this->user = $_SESSION['user'];
    }
    
    public function login($email, $password) {
        $email = trim($email);
        
        $result_user = $this->db->query('
        SELECT id, email, password, first_name, last_name, admin
        FROM users
        WHERE email = ' . $this->db->quote($email) . '
        LIMIT 1
        ');
        
        if ( !($user = $result_user->fetch(PDO::FETCH_ASSOC)) ) {
            return false; // No user with that email
        }
        
        include ABS_PATH . 'libs/PasswordLib/PasswordLib.php';
        $password_hasher = new PasswordLib\PasswordLib;
        
        if ( !$password_hasher->verifyPasswordHash($password, $user['password']) ) {
            return false; // Wrong password
        }
        
        $this->db->exec('
        UPDATE users
        SET
            last_login = ' . $_SERVER['REQUEST_TIME'] . ',
            num_logins = num_logins + 1
        WHERE id = ' . $this->db->quote($user['id'])
        );
        
        $_SESSION['user'] = array(
            'id' => $user['id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name']
        );
        
        return true;
    }
    
    public function logout() {
        unset($_SESSION['user']);
    }
    
    public function isLoggedIn() {
        return $this->user ? $this->user : false;
    }
    
    public function getAll($limit = 0) {
        return $this->db->query('
        SELECT *
        FROM users
        ' . ($limit ? 'LIMIT ' . $limit : '') . '
        ');
    }
    
    public function getFirstName($user_id) {
        return $this->db->query('
        SELECT first_name
        FROM users
        WHERE id = ' . $this->db->quote($user_id) . '
        LIMIT 1
        ')->fetchColumn();
    }
    
    public function getLastName($user_id) {
        return $this->db->query('
        SELECT last_name
        FROM users
        WHERE id = ' . $this->db->quote($user_id) . '
        LIMIT 1
        ')->fetchColumn();
    }
}
?>
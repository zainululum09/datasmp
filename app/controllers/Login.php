<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Auth.php';

class Login extends Controller
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        $query = "SELECT * FROM users WHERE username = :username";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $user = $this->db->single();

        if (!$user || !password_verify($password, $user['password'])) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Login gagal']);
            return;
        }

        $token = Auth::generateToken($user);
        echo json_encode(['status' => 'success', 'token' => $token]);
    }
}

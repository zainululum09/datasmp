<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Auth.php';

class Login extends Controller{
   
    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $user = $this->model('UserModel')->getUserByUsername($input['username']);

        if ($user && password_verify($input['password'], $user['password'])) {
            $token = Auth::generateToken($user);
            echo json_encode(['status' => 'success', 'token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Login gagal']);
        }
    }
}

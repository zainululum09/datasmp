<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/UserModel.php';

class Auth {
    private static $secret = 'jwt_secret_key_anda';

    public static function generateToken($user)
    {
        $payload = [
            'iss' => 'yourdomain.com',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user['id'],
            'username' => $user['username']
        ];
        return JWT::encode($payload, self::$secret, 'HS256');
    }

    public static function check($db)
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Authorization header tidak ditemukan']);
            exit;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decoded = JWT::decode($token, new Key(self::$secret, 'HS256'));
            return (array)$decoded;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Token tidak valid']);
            exit;
        }
    }
}

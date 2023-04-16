<?php

namespace App;

use App\Connection;

class Auth {
    private static $conn;

    public static function login($username, $password) {
        $stmt = self::getConnection()->prepare('SELECT * FROM usuarios WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    
    public static function logout() {
        session_unset();
        session_destroy();
    }

    public static function isAuthenticated() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public static function getCurrentUser() {
        session_start();
        if (!self::isAuthenticated()) {
            return null;
        }
        $stmt = self::getConnection()->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetch();
    }

    private static function getConnection() {
        if (!self::$conn) {
            self::$conn = (new Connection())->getConnection();
        }
        return self::$conn;
    }
}

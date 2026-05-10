<?php
// app/models/User.php

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users WHERE username = :username LIMIT 1'
        );
        $stmt->execute([':username' => $username]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM users WHERE id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(string $username, string $password, string $role = 'user'): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (username, password, role) VALUES (:username, :password, :role)'
        );
        return $stmt->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':role'     => $role,
        ]);
    }

    public function isUsernameExist(string $username): bool
    {
        $stmt = $this->db->prepare(
            'SELECT COUNT(*) FROM users WHERE username = :username'
        );
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }
}
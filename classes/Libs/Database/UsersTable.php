<?php

namespace Libs\Database;

use PDOException;

class UsersTable
{
    private $db;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function getAll()
    {
        try {

            $query = "SELECT users.*, roles.name AS role, roles.value FROM users LEFT JOIN roles ON users.role_id = role.id";
            $statement = $this->db->query($query);
            return $statement->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function insert($data)
    {
        try {

            $query = "INSERT INTO users (name, email, phone, address, password, role_id, created_at) VALUES (:name, :email, :phone, :address, :password, :role_id, NOW())";

            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function checkAuthUser($email)
    {
        try {
            $query = "SELECT users.*, roles.name AS role, roles.value FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.email = :email";

            $statement = $this->db->prepare($query);
            $statement->execute([
                ':email' => $email
            ]);
            $user = $statement->fetch();
            return $user ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function suspended($id)
    {
        try {
            $statement = $this->db->prepare(
                "SELECT * FROM users WHERE id = :id AND suspended = 1"
            );

            $statement->execute([
                ':id' => $id
            ]);

            $suspend = $statement->fetch();
            return $suspend ?? false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
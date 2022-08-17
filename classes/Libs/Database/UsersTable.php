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

            $query = "SELECT users.*, roles.name AS role, roles.value FROM users LEFT JOIN roles ON users.role_id = roles.id";
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

    public function uploadProfile($id, $name)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE users SET profile = :name WHERE id = :id"
            );
            $statement->execute([
                ':name' => $name,
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function uploadCoverPhoto($id, $name)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE users SET cover = :name WHERE id = :id"
            );
            $statement->execute([
                ':name' => $name,
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function changeRole($id, $role)
    {
        try {
            $query = "UPDATE users SET role_id = :role WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->execute([
                ':role' => $role,
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function doSuspend($id)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE users SET suspended = 1 WHERE id = :id"
            );
            $statement->execute([
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function doUnsuspend($id)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE users SET suspended = 0 WHERE id = :id"
            );
            $statement->execute([
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public function deleteUser($id)
    {
        try {
            $statement = $this->db->prepare(
                "DELETE FROM users WHERE id = :id"
            );
            $statement->execute([
                ':id' => $id
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
<?php
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$password = $_POST['password'];
$confirmPassword = $_POST['confirm'];

$table = new UsersTable(new MySQL());

if (strlen($password) > 8) {
    $strongPassword = checkStrongPassword($password);

    if ($strongPassword) {
        if ($password === $confirmPassword) {
            $data = [
                'name' => $_POST['name'] ?? 'Unknown',
                'email' => $_POST['email'] ?? 'Unknown',
                'phone' => $_POST['phone'] ?? 'Unknown',
                'address' => $_POST['address'] ?? 'Unknown',
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role_id' => 1
            ];

            if ($table) {
                $row = $table->insert($data);
                HTTP::redirect('/index.php', 'register=true');
            } else {
                HTTP::redirect('/register.php', 'error=true');
            }
        } else {
            HTTP::redirect('/register.php', 'notmatch=true');
        }
    } else {
        HTTP::redirect('/register.php', 'weak=true');
    }
} else {
    HTTP::redirect('/register.php', 'less=true');
}

function checkStrongPassword($pass)
{
    $uppercase = false;
    $lowercase = false;
    $number = false;
    $specialCharacter = false;

    if (preg_match('/[A-Z]/', $pass)) {
        $uppercase = true;
    }
    if (preg_match('/[a-z]/', $pass)) {
        $lowercase = true;
    }
    if (preg_match('/[0-9]/', $pass)) {
        $number = true;
    }
    if (preg_match('/[!@#$%&*]/', $pass)) {
        $specialCharacter = true;
    }

    if ($uppercase and $lowercase and $number and $specialCharacter) {
        return true;
    } else {
        return false;
    }
}
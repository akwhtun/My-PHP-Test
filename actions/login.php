<?php
session_start();
include("../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$email = $_POST['email'];
$password = $_POST['password'];

$table = new UsersTable(new MySQL());

$authUser = $table->checkAuthUser($email);

if (password_verify($password, $authUser->password)) {
    $suspendUser = $table->suspended($authUser->id);
    if ($suspendUser) {
        HTTP::redirect('/index.php', 'suspended=true');
    }
    $_SESSION['user'] = $authUser;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/index.php", "incorrect=true");
}
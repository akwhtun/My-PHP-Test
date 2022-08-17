<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Auth;

$auth = Auth::check();

$table = new UsersTable(new MySQL());

$name = $_FILES['profile']['name'];
$error = $_FILES['profile']['error'];
$tmp = $_FILES['profile']['tmp_name'];
$type = $_FILES['profile']['type'];

if ($error) {
    HTTP::redirect('/profile.php', 'profile=error');
}

if ($type === "image/jpeg" or $type === "image/png" or $type === "image/jpg") {

    $profile = $table->uploadProfile($auth->id, $name);
    move_uploaded_file($tmp, "profile/$name");
    $auth->profile = $name;
    HTTP::redirect('/profile.php');
} else {
    HTTP::redirect('/profile.php', 'type=error');
}
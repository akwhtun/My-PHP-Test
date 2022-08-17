<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;
use Helpers\HTTP;

$auth = Auth::check();

$name = $_FILES['cover']['name'];
$tmp = $_FILES['cover']['tmp_name'];
$type = $_FILES['cover']['type'];
$error = $_FILES['cover']['error'];

$table = new UsersTable(new MySQL());

if ($error) {
    HTTP::redirect('/profile.php', 'cover=error');
}

if ($type === "image/jpeg" or $type === "image/png" or $type === "image/jpg") {
    $table->uploadCoverPhoto($auth->id, $name);
    move_uploaded_file($tmp, "cover/$name");
    $auth->cover = $name;
    HTTP::redirect('/profile.php');
} else {
    HTTP::redirect('/profile.php', 'type=error');
}
<?php
include("./vendor/autoload.php");

use Helpers\Auth;

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <title>Profile</title>
</head>

<body>

    <div class="position-relative bg-dark mx-auto mt-1" style="width:600px; height:300px;">
        <?php if ($auth->cover) : ?>
        <img src="./actions/cover/<?= $auth->cover ?>" class="w-100 h-100">
        <?php else : ?>
        <img src="./actions/cover/default.jpg" class="w-100 h-100">
        <?php endif ?>
        <?php if ($auth->profile) : ?>
        <img src="./actions/profile/<?= $auth->profile ?>"
            class="img-thumbnail rounded-circle position-absolute start-50 translate-middle" width="220px"
            style="transform:translateX(-50%); top:63%;">
        <?php else : ?>
        <img src="./actions/profile/default.jpg"
            class="img-thumbnail rounded-circle position-absolute start-50 translate-middle" width="220px"
            style="transform:translateX(-50%); top:63%;">
        <?php endif ?>
    </div>

    <?php if (isset($_GET['profile'])) : ?>
    <div class="alert alert-warning w-25 mx-auto mt-1">Cannot Upload Profile</div>
    <?php endif ?>
    <?php if (isset($_GET['cover'])) : ?>
    <div class="alert alert-warning w-25 mx-auto mt-1">Cannot Upload CoverPhoto</div>
    <?php endif ?>
    <?php if (isset($_GET['type'])) : ?>
    <div class="alert alert-warning w-25 mx-auto mt-1">Your Image Cannot Upload</div>
    <?php endif ?>

    <div class="d-flex mx-auto mt-2" style="width: 600px;">
        <form action="./actions/upload_profile.php" method="post" enctype="multipart/form-data">
            <div class="input-group w-100">
                <input type="file" name="profile" class="form-control">
                <button type="submit" class="btn btn-secondary">Upload Profile</button>
            </div>
        </form>
        <form action="./actions/uploadCoverPhoto.php" method="post" enctype="multipart/form-data">
            <div class="input-group w-100 ps-3">
                <input type="file" name="cover" class="form-control">
                <button type="submit" class="btn btn-secondary">Upload CoverPhoto</button>
            </div>
        </form>
    </div>
    <div class="bg-white shadow-sm px-5 py-2 mx-auto text-secondary " style="width:650px;">
        <div class="ms-5 mt-3 d-flex">
            <i class="fas fa-user fs-2"></i>
            <p class="ms-4 fs-3"><?= $auth->name ?> <span class="text-dark">(<?= $auth->role ?>)</span></p>
        </div>
        <div class="ms-5 mt-3 d-flex">
            <i class="fas fa-envelope fs-2"></i>
            <p class="ms-4 fs-3"><?= $auth->email ?></p>
        </div>
        <div class="ms-5 mt-3 d-flex">
            <i class="fas fa-phone fs-2"></i>
            <p class="ms-4 fs-3"><?= $auth->phone ?></p>
        </div>
        <div class="ms-5 mt-3 d-flex">
            <i class="fas fa-map-marked fs-2"></i>
            <p class="ms-4 fs-3"><?= $auth->address ?></p>
        </div>
        <a href="./admin.php" class="btn btn-primary ms-5 mt-3">Manage Users</a>
        <a href="./actions/logout.php" class="btn btn-danger ms-3 mt-3">Logout</a>
    </div>
</body>

<script src="./javascript/bootstrap.min.js"></script>

</html>
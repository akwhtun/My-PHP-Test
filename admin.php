<?php
include("./vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;
use Helpers\HTTP;

$table = new UsersTable(new MySQL());

$all = $table->getAll();

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>All Users</title>
</head>

<body>
    <div class="container">
        <div class="d-flex mt-3 mb-5 justify-content-between">
            <h1 class="">
                All Users
                <span class="badge text-white bg-dark">
                    <?= count($all) ?>
                </span>
            </h1>
            <div>
                <a href="./profile.php" class="btn btn-primary">Profile</a> |
                <a href="./actions/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <tr class="text-center">
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($all as $user) : ?>
            <tr>
                <td class="text-center">
                    <?php if ($user->profile) : ?>
                    <img src="./actions/profile/<?= $user->profile ?>" alt="Profile" class="img-thumbnail"
                        width="100px">
                    <?php else : ?>
                    <img src="./actions/profile/default.jpg" alt="Profile" class="img-thumbnail" width="100px">
                    <?php endif ?>
                </td>
                <td class="text-center">
                    <?= $user->name ?>
                </td>
                <td class="text-center">
                    <?= $user->email ?>
                </td>
                <td class="text-center">
                    <?= $user->phone ?>
                </td>

                <?php if ($user->value === '1') : ?>
                <td class="text-center">
                    <span class=" badge bg-danger" style="font-size:15px;"><?= $user->role ?></span>
                </td>
                <?php endif ?>

                <?php if ($user->value === '2') : ?>
                <td class="text-center">
                    <span class=" badge bg-primary" style="font-size:15px;"><?= $user->role ?></span>
                </td>
                <?php endif ?>

                <?php if ($user->value === '3') : ?>
                <td class="text-center">
                    <span class=" badge bg-success" style="font-size:15px;"><?= $user->role ?></span>
                </td>
                <?php endif ?>


                <?php if ($auth->value > 1) : ?>

                <td>
                    <div class="d-flex justify-content-around">
                        <div class="dropdown">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenu"
                                data-bs-toggle="dropdown">Change Role</button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                                <li>
                                    <a href="./actions/role.php?id=<?= $user->id ?>&role=1"
                                        class="dropdown-item">User</a>
                                </li>
                                <li>
                                    <a href="./actions/role.php?id=<?= $user->id ?>&role=2"
                                        class="dropdown-item">Manager</a>
                                </li>
                                <li>
                                    <a href="./actions/role.php?id=<?= $user->id ?>&role=3"
                                        class="dropdown-item">Admin</a>
                                </li>
                            </ul>
                        </div>

                        <?php if ($user->suspended != 1) : ?>
                        <a href="./actions/suspend.php?id=<?= $user->id ?>" class="btn btn-outline-success">Active</a>
                        <?php endif ?>
                        <?php if ($user->suspended == 1) : ?>
                        <a href="./actions/unsuspend.php?id=<?= $user->id ?>"
                            class="btn bg-danger text-white">Suspended</a>
                        <?php endif ?>

                        <?php if ($auth->id != $user->id) : ?>
                        <a href="./actions/delete.php?id=<?= $user->id ?>" class="btn btn-outline-danger">Delete</a>
                        <?php else : ?>
                        <span class="btn btn-outline-secondary">You</span>
                        <?php endif ?>
                    </div>
                </td>

                <?php else : ?>
                <td>
                    Nothing to show.
                </td>
                <?php endif ?>

            </tr>
            <?php endforeach ?>
        </table>
    </div>

    <script src="./javascript/bootstrap.bundle.min.js"></script>
</body>

</html>
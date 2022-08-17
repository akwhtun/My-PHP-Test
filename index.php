<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <div class="mx-auto mt-5 px-5 shadow-sm" style="width:560px;">
        <h2 class="text-dark text-center my-5">Login</h2>
        <?php if (isset($_GET['register'])) : ?>
        <div class="alert alert-success">Account Created Successful.Please Login.</div>
        <?php endif ?>
        <?php if (isset($_GET['incorrect'])) : ?>
        <div class="alert alert-warning">Incorrect Email or Password</div>
        <?php endif ?>
        <?php if (isset($_GET['suspended'])) : ?>
        <div class="alert alert-danger">Your Account is suspended.</div>
        <?php endif ?>
        <form action="./actions/login.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control mb-3">
            <button type="submit" class="btn btn-primary w-100 my-4">Login</button>
        </form>
        <a href="./register.php" class="w-100 d-block text-center pb-3">Register</a>
    </div>
</body>

</html>
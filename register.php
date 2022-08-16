<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Register</title>
</head>

<body>
    <div class="mx-auto mt-5 px-5 shadow-sm" style="width:560px;">
        <h2 class="text-dark text-center my-5">Register</h2>
        <?php if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning">Cannot Create Account.Try Again!</div>
        <?php endif ?>
        <?php if (isset($_GET['less'])) : ?>
        <div class="alert alert-warning">Password must have at least 8 characters.</div>
        <?php endif ?>
        <?php if (isset($_GET['weak'])) : ?>
        <div class="alert alert-warning">Password must contain Capital Letter,Small Letter, Number & Special
            Characters(eg.!,@,#,$,%,&,*)</div>
        <?php endif ?>
        <?php if (isset($_GET['notmatch'])) : ?>
        <div class="alert alert-warning">Your Password and Confirm Password did not match</div>
        <?php endif ?>
        <form action="./actions/create.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control mb-3" required>
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control mb-3" required>
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control mb-3" required>
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control mb-3" required>
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control mb-3" required>
            <label for="password">Confirm Password</label>
            <input type="password" name="confirm" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary w-100 my-4">Create Account</button>
        </form>
        <a href="./register.php" class="w-100 d-block text-center pb-3">Login</a>
    </div>
</body>

</html>
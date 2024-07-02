<?php
if (isset($_SESSION['error'])) {
    $errors = $_SESSION['error'];
}
if (isset($_SESSION['input'])) {
    $input = $_SESSION['input'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="/login" method="post" class="d-flex-c reg-form">
        <div class="title"> Sign In </div>
        <div>
            <input type="text" class="email" name="email" placeholder="Email Address*" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>">
            <span class="error">
                <?php echo isset($errors['email']) ? $errors['email']  : ''; ?>
            </span>
        </div>
        <div>
            <input type="text" class="password" name="password" placeholder="Password*">
            <span class="error">
                <?php echo isset($errors['password']) ? $errors['password']  : ''; ?>
            </span>
        </div>
        <div>
            <input type="submit" name="submit" value="Login" class="btn-blue">
        </div>
        <div class="login-text">
            <span> Don't have an Account? <a href="/registration"> Register </a> </span>
        </div>
    </form>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['input']);
?>
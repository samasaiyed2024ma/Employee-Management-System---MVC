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
    <form action="/registration" method="post" class="d-flex-c reg-form">
        <div class="title"> Registration </div>
        <span class="error">
            <?php echo isset($errors['registration_error']) ? $errors['registration_error']  : ''; ?>
        </span>
        <div>
            <input type="text" class="fname" name="firstname" placeholder="First Name*" value="<?php echo isset($input['firstname']) ? $input['firstname'] : ''; ?>">
            <span class="error">
                <?php echo isset($errors['firstname']) ? $errors['firstname']  : ''; ?>
            </span>
        </div>
        <div>
            <input type="text" class="lname" name="lastname" placeholder="Last Name*" value="<?php echo isset($input['lastname']) ? $input['lastname'] : ''; ?>">
            <span class="error">
                <?php echo isset($errors['lastname']) ? $errors['lastname']  : ''; ?>
            </span>
        </div>
        <div>
            <input type="text" class="email" name="email" placeholder="Email Address*" value="<?php echo isset($input['email']) ? $input['email'] : ''; ?>">
            <span class="error">
                <?php echo isset($errors['email']) ? $errors['email']  : ''; ?>
            </span>
        </div>
        <div>
            <input type="text" class="password" name="password" placeholder="Password*">
        </div>
        <div>
            <input type="text" class="password" name="confirm_password" placeholder="Confirm Password*">
        </div>
        <span class="error">
            <?php echo isset($errors['password']) ? $errors['password']  : ''; ?>
        </span>
        <div>
            <input type="submit" name="submit" class="btn-blue">
        </div>

        <div class="login-text">
            <span> Have an Account? <a href="/login"> Login </a> </span>
        </div>
    </form>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['input']);
?>
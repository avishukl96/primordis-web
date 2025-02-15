<!-- application/views/auth/reset_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('auth/reset_password'); ?>
    <label for="email">Enter your email to reset password:</label>
    <input type="email" name="email" required />

    <button type="submit">Reset Password</button>
<?php echo form_close(); ?>

</body>
</html>

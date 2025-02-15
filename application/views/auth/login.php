<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Primordis.tech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .login-form {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-form h1 {
            font-size: 32px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .login-form h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px #3498db;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #8e44ad, #3498db);
        }

        .error-message {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
        }

        .register-options {
            margin-top: 20px;
        }

        .register-options p {
            font-size: 14px;
            color: #777;
        }

        .register-options a {
            color: #3498db;
            text-decoration: none;
        }

        .register-options a:hover {
            text-decoration: underline;
        }

        .password-container {
            position: relative;
        }

        .eye-icon {
            font-size: larger;
            position: absolute;
            top: 67%;
            right: 10px;
            transform: translateY(-48%);
            cursor: pointer;
            color: #aaa;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="login-form">
        <!-- Brand Logo -->
        <div class="brand">
            <h1> 🌐Primordis</h1>
        </div>

        <h2>Login to Your Account</h2>

        <!-- Display flashdata error message -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="error-message">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Display validation errors -->
        <?php if(validation_errors()): ?>
            <div class="error-message">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <!-- Login form -->
        <?php echo form_open('auth/login_process'); ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-label="Email address" />
            </div>

            <div class="form-group password-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required aria-label="Password" />
                <i class="fas fa-eye eye-icon" id="toggle-password"></i>
            </div>

            <button type="submit" class="btn-submit">Login</button>
        <?php echo form_close(); ?>

        <div class="register-options">
            <p>Don't have an account? <a href="register">Register here</a></p>
        </div>
        <div class="register-options">
             <a href="<?= site_url(); ?>">www.primordis.tech</a>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var icon = this;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>

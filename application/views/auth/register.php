<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Primordis.tech</title>
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

        .register-form {
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

        .register-form h1 {
            font-size: 32px;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .register-form h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
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

        .form-footer {
            margin-top: 20px;
        }

        .form-footer p {
            font-size: 14px;
            color: #666;
        }

        .form-footer a {
            color: #3498db;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-form">
        <div class="brand">
            <h1> 🌐Primordis</h1>
        </div>

        <h2>Create an Account</h2>

        <?php if(validation_errors()): ?>
            <div class="error-message">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        

        <?php echo form_open('auth/register_process', ['id' => 'registerForm']); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter your username" value="<?php echo set_value('username'); ?>" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required />
            </div>

            <!-- Terms and Privacy Checkbox -->
            <!-- <div class="form-group"> -->
                
                <label for="terms">
                     <input type="checkbox" id="terms" required>  I agree to the <a href="<?= site_url('home/terns_conditions'); ?>" target="blank">T&C</a> and <a href="<?= site_url('home/privacy'); ?>" target="blank">Privacy Policy</a>
                </label>
             
            <!-- </div> -->

            <br> <br>
            <button type="submit" id="submitBtn" class="btn-submit" disabled>Register</button>
        <?php echo form_close(); ?>

        <div class="form-footer">
            <p>Already have account? <a href="login">Login here</a></p>
        </div>

        <div class="form-footer">
           <a href="<?= site_url(); ?>">www.primordis.tech </a>
        </div>
        
        
    </div>
</div>

<script>



    const termsCheckbox = document.getElementById('terms');
    const submitBtn = document.getElementById('submitBtn');

    termsCheckbox.addEventListener('change', () => {
        submitBtn.disabled = !termsCheckbox.checked;
    });

</script>

</body>
</html>

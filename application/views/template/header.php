<!-- header.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primordis.tech</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css'); ?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Popper.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->


    <!-- Custom Styles -->
    <style>
      
      
        /* Sticky footer */
        footer {
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

       .navbar{background: linear-gradient(135deg, #3498db, #8e44ad);}
       /* .header-nav{
            padding: 1rem 1rem;
        } */

         /* Main content padding */
         main {
            padding-top: 50px;  /* Adjusted for the sticky navbar */
            padding-bottom: 50px; /* Ensure space for the sticky footer */
        }

        .sidebar{position: -webkit-sticky;
position: sticky;
top: 0;}

        .nav-link{font-color:white;}

        #loader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>


<script>
    window.onload = function() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
    };
</script>

    

    
</head>
<body>

<div id="loader">
    <div class="spinner"></div>
    
    <p> </p>
</div>

<!-- Header Section (Navbar) -->
<nav class="header-nav navbar navbar-expand-lg navbar-dark bg-dark fixed-top text-white">
    <div class="container py-3 text-white"  >
        <a class="navbar-brand" href="<?= site_url(); ?>">🌐Primordis.tech</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item active">
                    <a class="nav-link animate__animated animate__fadeIn"  href="<?php echo site_url(); ?>">Home</a>
                </li>
                <!-- <li class="nav-item active">
                    <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url(); ?>#about">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url(); ?>#services">Services</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url(); ?>#contact">Contact</a>
                </li> -->

                <?php 
                
                 // Load the tank_auth library manually
                 $CI =& get_instance();
                 //$CI->load->library('tank_auth');
                    //var_dump($CI->tank_auth->get_username());die;
                if ($CI->tank_auth->is_logged_in()): ?>
                    <!-- User is logged in, show username and logout -->
                    
                    <li class="nav-item active">
                        <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                     <span class="nav-link animate__animated animate__fadeIn">Welcome, <strong><?php echo $CI->tank_auth->get_username(); ?></strong></span>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <!-- User is not logged in, show login/register options -->
                    <li class="nav-item active">
                        <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url('auth/login'); ?>">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animate__animated animate__fadeIn" href="<?php echo site_url('auth/register'); ?>">Register</a>
                    </li>
                   
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main class="mt-3" id="content" style="display: none;">
    
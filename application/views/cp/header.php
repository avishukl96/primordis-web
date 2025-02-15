<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for Styling -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .card-header {
            background-color: #17a2b8;
            color: white;
        }

        .card-body {
            background-color: #f8f9fa;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .user-table th, .user-table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-group button {
            margin-right: 5px;
        }

        .pagination {
            justify-content: center;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container input {
            max-width: 250px;
        }

        .card-body .card-title {
            font-size: 1.5rem;
        }

        /* Small screens styling */
        @media (max-width: 768px) {
            .user-table th, .user-table td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Priomordis Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url(); ?>">Website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('cp/admin'); ?>">Users</a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link active" href="<?php echo base_url('/cp/admin/processed_data/'); ?>">User Reports</a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link active" href="<?php echo base_url('/cp/admin/contact_leads/'); ?>">Contact Lead</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('cp/admin/logout'); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-2">
        <h2>Welcome to the Primordis Administration</h2>
        <!-- <p>Manage users and settings efficiently</p> -->
    </header>
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
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('cp/dashboard'); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('cp/logout'); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-4">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Manage users and settings efficiently</p>
    </header>

    <!-- Dashboard Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Dashboard Stats -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-success">
                        <h5>Total Users</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_users; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-warning">
                        <h5>Pending Users</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $pending_users; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-info">
                        <h5>Approved Users</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $approved_users; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-danger">
                        <h5>Rejected Users</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $rejected_users; ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4 class="mb-4">Users</h4>
                <!-- Filter Buttons -->
                <div class="filter-container d-flex justify-content-between">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary" onclick="filterUsers('all')">All</button>
                        <button type="button" class="btn btn-outline-warning" onclick="filterUsers('pending')">Pending</button>
                        <button type="button" class="btn btn-outline-info" onclick="filterUsers('approved')">Approved</button>
                        <button type="button" class="btn btn-outline-danger" onclick="filterUsers('rejected')">Rejected</button>
                    </div>
                    <div class="d-flex">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Search...">
                        <button class="btn btn-outline-secondary" onclick="resetFilter()">Reset</button>
                    </div>
                </div>

                <!-- User Table -->
                <table class="table table-hover table-bordered user-table mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr class="user-row" data-status="<?php echo $user['status']; ?>">
                            <th><?php echo $user['id']; ?></th>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo ucfirst($user['status']); ?></td>
                            <td>
                                <?php if ($user['status'] === 'pending'): ?>
                                    <a href="<?php echo base_url('cp/approve/'.$user['id']); ?>" class="btn btn-success btn-sm">Approve</a>
                                    <a href="<?php echo base_url('cp/reject/'.$user['id']); ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php elseif ($user['status'] === 'approved'): ?>
                                    <a href="<?php echo base_url('cp/reject/'.$user['id']); ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php elseif ($user['status'] === 'rejected'): ?>
                                    <a href="<?php echo base_url('cp/approve/'.$user['id']); ?>" class="btn btn-success btn-sm">Approve</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- Pagination Links (Example) -->
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 Primordis Tech. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterUsers(status) {
            document.querySelectorAll('.user-row').forEach(row => {
                row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
            });
        }
        function resetFilter() {
            document.getElementById('searchInput').value = '';
            filterUsers('all');
        }
    </script>
</body>

</html>

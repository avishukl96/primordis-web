<style> tbody .btn{width:80px; } </style>

    <?php if ($this->session->userdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->userdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

    <!-- Dashboard Content -->
    <div class="container mt-4">
    <h2 class="text-center">Manage Users</h2>
        <div class="row mt-4">
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
                        <?php //var_dump($selected_status); ?>
                        <a href="<?php echo site_url('cp/admin/index/'); ?>" class="btn <?php echo $selected_status==NULL ? 'btn-secondary': 'btn-outline-secondary'; ?>" onclick="filterUsers('all')">All</a>
                        <a href="<?php echo site_url('cp/admin/index/pending'); ?>" class="btn <?php echo $selected_status=='pending' ? 'btn-warning': 'btn-outline-warning'; ?>" onclick="filterUsers('pending')">Pending</a>
                        <a href="<?php echo site_url('cp/admin/index/approved'); ?>" class="btn <?php echo $selected_status=='approved' ? 'btn-info': 'btn-outline-info'; ?>" onclick="filterUsers('approved')">Approved</a>
                        <a href="<?php echo site_url('cp/admin/index/rejected'); ?>" class="btn <?php echo $selected_status=='rejected' ? 'btn-danger': 'btn-outline-danger'; ?>" onclick="filterUsers('rejected')">Rejected</a>
                    </div>
                    <div class="d-flex">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Search...">
                        <a href="#" class="btn btn-outline-secondary" onclick="resetFilter()">Reset</a>
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
                        <?php if($get_all_users){?>
                            
                       
                        <?php foreach ($get_all_users as $user): 
                            //var_dump($user);
                            ?>
                        <tr class="user-row" data-status="<?php echo $user['status']; ?>">
                            <th><?php echo $user['id']; ?></th>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                            <?php //echo ucwords($user['status']); ?>
                            <?php if($user['status'] == "pending"){ ?>
                                    <span class="text-warning"> <?php echo ucwords($user['status']); ?> </span>
                                <?php } else if($user['status'] == "approved"){  ?>
                                    <span class="text-success"> <?php echo ucwords($user['status']); ?> </span>
                                <?php } else if($user['status'] == "rejected"){ ?>
                                    <span class="text-danger"> <?php echo ucwords($user['status']); ?> </span>
                                <?php }  ?>
                        </td>
                            <td>
                                <?php if ($user['status'] === 'pending'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_user_status/approved/'.$user['id']); ?>" class="btn btn-success btn-sm"> Approve</a>
                                    <a href="<?php echo base_url('cp/admin/change_user_status/rejected/'.$user['id']); ?>" class="btn btn-danger btn-sm" > Reject</a>
                                <?php elseif ($user['status'] === 'approved'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_user_status/rejected/'.$user['id']); ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php elseif ($user['status'] === 'rejected'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_user_status/approved/'.$user['id']); ?>" class="btn btn-success btn-sm">Approve</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php } else { ?> 
                            <tr>
                               <td colspan="5" class="text-center"> No <?= ucwords($selected_status); ?> Record Found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Pagination -->
                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav> -->
            </div>
        </div>
    </div>
                        </div>

<style> 
tbody .btn{width:80px; }
 
</style>


    <!-- Dashboard Content -->
    <div class="container mt-4">
        <h2 class="text-center">User Process Data</h2> 
        <div class="row mt-4">
            <!-- Dashboard Stats -->
            <!-- <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-success">
                        <h5>Total Process Data</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $total_count; ?></h4>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-warning">
                        <h5>New Leads</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php //echo count($get_new_contacts); ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-info">
                        <h5>Already Contacted Leads</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php //echo count($get_already_contacted); ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white bg-danger">
                        <h5>Spam Leads</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php //echo count($get_spam_contacts); ?></h4>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Users Table Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <!-- <h4 class="mb-4">Process Data</h4> -->
                <!-- Filter Buttons -->
                <div class="filter-container d-flex justify-content-between">
                    <div class="btn-group" role="group">
                        <!-- <?php //var_dump($selected_status); ?>
                        <a href="<?php echo site_url('cp/admin/contact_leads/'); ?>" class="btn <?php echo $selected_status==NULL ? 'btn-secondary': 'btn-outline-secondary'; ?>" >All</a>
                        <a href="<?php echo site_url('cp/admin/contact_leads/0'); ?>" class="btn <?php echo $selected_status=='0' ? 'btn-warning': 'btn-outline-warning'; ?>">New</a>
                        <a href="<?php echo site_url('cp/admin/contact_leads/1'); ?>" class="btn <?php echo $selected_status=='1' ? 'btn-info': 'btn-outline-info'; ?>">Already Contacted</a>
                        <a href="<?php echo site_url('cp/admin/contact_leads/2'); ?>" class="btn <?php echo $selected_status=='2' ? 'btn-danger': 'btn-outline-danger'; ?>" >Spam</a> -->
                    </div>
                    <!-- <div class="d-flex">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Search...">
                        <a href="#" class="btn btn-outline-secondary" onclick="resetFilter()">Reset</a>
                    </div> -->
                </div>
                <!-- User Table -->
                <table class="table table-hover table-bordered user-table mt-4">
                    <thead class="table-dark" style="    font-size: smaller;">
                        <tr>
                            <th>SN</th>
                            <th>User Name</th>
                            <th>Report</th>
                            <th>Cell Chemistry</th>
                            <th>Nominal Capacity (Ah)</th>
                            <th>Nominal Voltage (V)</th>
                            <th>Cycling Parameter:<br> Discharge C-Rate (C)</th>
                            <th>EOL Criterion:<br> (% SOH)</th>
                            <th>Current State of Health<br> (SOH)</th>
                            <th>Reported Generated On</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($Process_data){
                            $index = 1
                            ?>
                            
                       
                        <?php foreach ($Process_data as $data): 
                          //  var_dump($data);
                            ?>
                        <tr class="user-row" data-status="<?php echo $data['status']; ?>">


                                      
                                        <th><?= $index ++; ?></th>
                                        <td><?= htmlspecialchars($data['username']); ?><br><?= htmlspecialchars($data['username']); ?></td>
                                        <td style="width:200px;"><a class="btn btn-primary btn-sm" href="<?= site_url('public/'.$data['file_path']); ?>" download>View data<?php //echo htmlspecialchars(str_replace("uploads/","",$data['file_path'])); ?></a>
                                        <a class="btn btn-info btn-sm" href="<?= site_url('public/uploads/generated_plot/plot_image_'.$data['process_data_id'].'.png'); ?>" download> Report<?php //echo htmlspecialchars(str_replace("uploads/","",$data['file_path'])); ?></a>
                                    </td>
                                        <td><?= htmlspecialchars($data['cell_chemistry']); ?></td>
                                        <td><?= htmlspecialchars($data['nominal_capacity']); ?></td>
                                        <td><?= htmlspecialchars($data['nominal_voltage']); ?></td>
                                        <td><?= htmlspecialchars($data['cycling_parameters']); ?></td>
                                        <td><?= htmlspecialchars($data['end_of_life_criterion']); ?></td>
                                        <td><?= htmlspecialchars($data['current_state_of_health']); ?></td>
                            <!-- <td>
                            <?php //echo ucwords($user['status']); ?>
                            <?php if($contact['status'] == "0"){ ?>
                                    <span class="text-warning"> New Lead </span>
                                <?php } else if($contact['status'] == "1"){  ?>
                                    <span class="text-success"> Already Contacted </span>
                                <?php } else if($contact['status'] == "2"){ ?>
                                    <span class="text-danger"> Spam </span>
                                <?php }  ?>
                        </td> -->
                            <!-- <td>
                                <?php if ($contact['status'] === '0'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_contact_status/1/'. $contact['id']); ?>" class="btn btn-success btn-sm">  Contacted</a>
                                    <a href="<?php echo base_url('cp/admin/change_contact_status/2/'. $contact['id']); ?>" class="btn btn-danger btn-sm" > Spam</a>
                                <?php elseif ($contact['status'] === '1'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_contact_status/2/'. $contact['id']); ?>" class="btn btn-danger btn-sm">Spam</a>
                                <?php elseif ($contact['status'] === '2'): ?>
                                    <a href="<?php echo base_url('cp/admin/change_contact_status/1/'. $contact['id']); ?>" class="btn btn-success btn-sm"> Contacted</a>
                                <?php endif; ?>
                            </td> -->
                            <td><?php echo date('d M Y', strtotime($data['created_at'])); ?> </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php } else { ?> 
                            <tr>
                               <td colspan="5" class="text-center"> No Record Found</td>
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

                <br></br>
            </div>
        </div>
    </div>
</div>

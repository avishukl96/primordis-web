<style>
    .table td, .table th {
        /* font-size: 13px; */
    padding: 0.25rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
</style>


<div class="container mt-5">
            <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">   Battery Cycling Data</li>
        </ol>
    </nav>
</div>

<!-- Dashboard Content Section -->
<div class="container  pt-5">

    <!-- Display errors -->
    <?php if($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <!-- Display success -->
    <?php if($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    




    <h2 class="text-center">  Battery Cycling Data</h2> 
   
    <div >
            <a href="fileupload" class="btn btn-primary btn-sm pull-left " > Manage   Battery Cycling Data </a> &nbsp; 
            <a href="<?= site_url('dataprocessor/faq');?>" class="btn btn-primary btn-sm pull-center " > How it Works ? </a> &nbsp; 
            <a href="dataprocessor" class="btn btn-primary btn-sm pull-right" > + Add Battery Cycling Data </a><br><br>
    </div>
    <div class="row">
        
        <div class="col-md-12 pull-right">
            <!-- <div class="">
                <a href="dataprocessor" class="btn btn-info">Add batter Data +</a>
                <br> <br>
                
            </div> -->
            <div class="card shadow-sm">
                <!-- <div class="card-header bg-secondary text-white">
                    <h4 class="card-title">Uploaded Files</h4>
                </div> -->
                <div class="card-body">
                   
                    <!-- Dynamic File Table -->
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                
                                <th>SN</th>
                                <th>Report Name</th>
                                <th>  Battery Cycle  <br>Data File</th>
                                <th>Cell Chemistry</th>
                                <th>Nominal Capacity (Ah)</th>
                                <th>Nominal Voltage (V)</th>
                                <th>Cycling Parameter: Discharge C-Rate (C)</th>
                                <th>EOL Criterion: (% SOH)</th>
                                <th>Current State of Health (SOH)</th>
                               

                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($process_data)): ?>
                                <?php foreach ($process_data as $index => $data): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= htmlspecialchars($data['file_title']); ?></td>
                                        <td><a href="<?= site_url('public/'.$data['file_path']); ?>" download><?= htmlspecialchars(str_replace("uploads/","",$data['file_path'])); ?></a></td>
                                        <!-- <td><?= htmlspecialchars($data['file_path']); ?></td> -->
                                        <td><?= htmlspecialchars($data['cell_chemistry']); ?></td>
                                        <td><?= htmlspecialchars($data['nominal_capacity']); ?></td>
                                        <td><?= htmlspecialchars($data['nominal_voltage']); ?></td>
                                        <td><?= htmlspecialchars($data['cycling_parameters']); ?></td>
                                        <td><?= htmlspecialchars($data['end_of_life_criterion']); ?></td>
                                        <td><?= htmlspecialchars($data['current_state_of_health']); ?></td>
                                       
                                        <td > 
                                            <!-- <a href="<?= base_url('public/' . $data['file_path']); ?>" class="btn btn-info btn-sm mb-2 " download title="download"><i class="fa fa-download"></i></a> -->
                                            <!-- Uncomment to add delete functionality -->
                                            <!-- <a href="<?= site_url('fileupload/delete/' . $data['file_id']); ?>" class="btn btn-danger btn-sm" title="Delete Data"><i class="fa fa-trash"></i></a> -->

                                            <a href="<?= site_url('dataprocessor/generate_report_plots/' . $data['process_data_id']); ?>" class="btn btn-info btn-sm" title="Process Data">Generate Report  </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No files found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

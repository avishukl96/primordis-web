<div class="container mt-5">
            <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Battery Cycling Data</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('dataprocessor'); ?>">Add Battery Cycling Data</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Manage Battery Data Files</li>
        </ol>
    </nav>
</div>

<!-- Dashboard Content Section -->
<div class="container mt-2 pt-5">

     <!-- Display errors -->
 <?php if($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <!-- Display success -->
    <?php if($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>


    <h2 class="text-center"> Manage Battery Data Files </h2>
    <div >
            <a href="dataprocessor" class="btn btn-primary btn-sm pull-right" > Back to Battery Cycling Data</a><br><br>
    </div>
    <div class="row">
        <!-- File Upload Form Section -->
        <div class="col-md-5">
        <!-- <div class="col-md-5 animate__animated animate__fadeInLeft"> -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Upload Your File</h4>
                </div>
                <div class="card-body">
               
                      <!-- Display Validation Errors -->
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger">
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php endif; ?>

                     
                    <form action="<?php echo site_url('fileupload/upload'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fileTitle">Report Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fileTitle" name="file_title"  value="<?= set_value('file_title'); ?>" placeholder="Enter Report title" required>
                        </div>
                        <div class="form-group">
                            <label for="fileDesc"> Report Description</label>
                            <textarea class="form-control" id="fileDesc" name="file_desc" rows="3" placeholder="Enter file description"  value="<?= set_value('file_desc'); ?>" required></textarea>
                        </div>
                        <div class="form-group">
                        <a href="public/uploads/battery_sample_data/battery_data_sample.xlsx" class="pull-right" download> Download Sample Format </a>
                            <label for="fileUpload">Upload Data File </label>
                            <input type="file" class="form-control-file" id="fileUpload" name="file_upload" accept=".xlsx, .xls, .csv, .mat" required>
                            <p style="font-size: 14px; ">Accept only: .xlsx | .xls | .csv | .mat</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- File List and Details Section -->
        <div class="col-md-7">
        <!-- <div class="col-md-7 animate__animated animate__fadeInRight"> -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Uploaded Files</h4>
                </div>
                <div class="card-body">
                    <p>Here are the files you have uploaded. You can click to view details or delete.</p>
                    <!-- Dynamic File List (can be populated with server-side data) -->
                    <ul class="list-group">
                        <?php 
                        
                        //var_dump($files);die;
                        foreach ($files as $file): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            <?php echo shortText($file->file_title.'|'.str_replace('uploads/','',$file->file_path), 50); ?>
                            <div>

                                <a href="<?php echo base_url('public/' . $file->file_path); ?>" class="btn btn-primary btn-sm" download>Download</a>
                                <a href="<?php echo site_url('fileupload/delete/' .  $file->id); ?>" class="btn btn-danger btn-sm"   onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                                
                            </div>

 
                        </li>
                        <?php endforeach; ?>
                    </ul>
                   
                </div>
                
            </div>
           
            
        </div>
        
</div>
    </div>
    
   

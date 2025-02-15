<style>
    .required{color: red; }
</style>

   

<div class="container mt-5">
            <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">  Battery Cycling Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add   Battery Cycling Data</li>
        </ol>
    </nav>
</div>

<div class="container  pt-5">

 <!-- Display errors -->
 <?php if($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <!-- Display success -->
    <?php if($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    

    <h2 class="text-center mb-4">Add Battery Cycling Data </h2>
    <div class="text-end mb-4">

      <!-- Display Validation Errors -->
      <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
        <!-- <a href="dashboard" class="btn btn-info btn-sm">Go To Process the Data</a> -->
    </div>
    <form id="battary_data_form" class="needs-validation" method="post" action="<?= site_url('dataprocessor/save_data'); ?>" >
        <div class="form-step active" id="step-1">
            <div class="mb-3 row">
                <div class="col-md-10">
                <label for="battery_cycle_file_id" class="form-label">  Battery Cycling Data File <span class="required">*</span></label>
                <select id="battery_cycle_file_id" name="battery_cycle_file_id" class="form-select form-control" required>
                    <option>-- Select a Data File --</option>

                    <?php foreach($files as $key=>$value){   ?> 
                         <option value="<?= $value->id ?>" <?= set_select('battery_cycle_file_id', $value->id); ?> ><?= $value->file_title." | ".$value->file_path ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-md-2">
                    <a href="<?= site_url('fileupload'); ?>" class="btn btn-primary btn-sm mt-4" style="margin-top: 21% !important;"> + Add Data File </a>
                </div>
            </div>
        </div>

        
        <div class="form-step" id="step-2">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="Cell_chemistry" class="form-label">Cell Chemistry (Optional) </label>
                <select id="Cell_chemistry" name="Cell_chemistry" class="form-select form-control" >
                    <option value="">-- Select  --</option>
                    <option value="LFP" <?= set_select('Cell_chemistry', 'LFP'); ?>>LFP</option>
                    <option value="NMC" <?= set_select('Cell_chemistry', 'NMC'); ?>>NMC</option>
                    <option value="NCA" <?= set_select('Cell_chemistry', 'NCA'); ?>>NCA</option>
                </select>
                   
                </div>
                <div class="col-md-12 mb-3">
                    <label for="nominal_capacity" class="form-label">Nominal Capacity (Ampere-hours) <span class="required">*</span></label>
                    <input type="text" id="nominal_capacity" name="nominal_capacity" class="form-control" placeholder="Range (0.5 - 5Ah)" value="<?= set_value('nominal_capacity'); ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="nominal_voltage" class="form-label">Nominal Voltage (V)  <span class="required">*</span></label>
                    <input type="text" id="nominal_voltage" name="nominal_voltage" class="form-control" placeholder="Range (1 - 10V)" value="<?= set_value('nominal_voltage'); ?>" required>
                    <!-- <div class="invalid-feedback">Field 3 is required.</div> -->
                </div>
                <div class="col-md-12 mb-3">
                    <label for="cycling_parameters" class="form-label">Cycling Parameter: Discharge C-Rate (C) </label>
                    <input type="text" id="cycling_parameters" name="cycling_parameters" class="form-control" placeholder="Range (0.5 - 5C)" value="<?= set_value('cycling_parameters'); ?>"  required>
                    <!-- <div class="invalid-feedback">Field 4 is required.</div> -->
                </div>
                <div class="col-md-12 mb-3">
                    <label for="end_of_life_criterion" class="form-label">End of Life Criterion: (% SOH)</label>
                    <input type="text" id="end_of_life_criterion" name="end_of_life_criterion" class="form-control" placeholder="Values between 0-100 (Default: 80%)"  value="<?= set_value('end_of_life_criterion'); ?>"  required>
                    <!-- <div class="invalid-feedback">Field 5 is required.</div> -->
                </div>
                <div class="col-md-12 mb-3">
                    <label for="current_state_of_health" class="form-label">Current State of Health (SOH):</label>
                    <input type="number" id="current_state_of_health" name="current_state_of_health" class="form-control" placeholder="Range: (80-100%)" value="<?= set_value('current_state_of_health'); ?>"  required>
                    <!-- <div class="invalid-feedback">Field 6 is required.</div> -->
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="form-navigation text-center py-5">
            <button type="submit" id="submit-btn" class="btn btn-primary" style="width:150px; ">Submit</button>
            <a href="<?= site_url('dashboard'); ?>" id="Cancel_btn" class="btn btn-secondary" style="width:150px; "; >Cancel</a>
            
            <!-- <button type="submit" id="submit-btn" class="btn btn-warning">Save & Generate Report</button> -->
        </div>
    </form>
</div>
  
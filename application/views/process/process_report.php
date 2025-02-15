
<div class="container mt-5">
            <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Battery Cycling Dataset</a></li>
            <li class="breadcrumb-item active" aria-current="page">Generated Plots and Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Test Name: <?= $process_data['file_title']?></li>
        </ol>
    </nav>
</div>

<div class="container mt-5 text-center">
    <h2 class="">Generated Plots </h2>
    <h5>Test Name: <?= $process_data['file_title']?></h5>

    <!-- Display Plots -->
    <!-- <div class="plot-container">
        
            <div class="plot-item">
                <h4><?= ucfirst($key) ?></h4>
                <img src="<?= $file_url ?>" alt="<?= $key ?>">
            </div>

    </div> -->


    <!-- Display Plots -->
    <div class="row justify-content-center">
        <?php //foreach ($plots as $key => $file_url): ?>
            <div class="col-md-6 col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= ucfirst($key) ?></h5>
                        <img src="<?= $file_url ?>" alt="<?= $key ?>" class="img-fluid rounded zoomable" data-bs-toggle="modal" data-bs-target="#imageModal" data-src="<?= $file_url ?>">
                        <br>
                        <a href="<?= site_url('dashboard') ?>"  class="btn btn-secondary mt-2"><i class="fa fa-arrow-left "> Go back</i> </a>

                        <a href="<?= $file_url ?>" download="<?= basename($file_url) ?>" class="btn btn-primary mt-2"><i class="fa fa-download"> Download</i></a>
                    </div>
                </div>
            </div>
        <?php //endforeach; ?>
    </div>


    <!-- Display Reports -->
    <!-- <div class="report-container">
        <h3>Download Reports</h3>
        <?php foreach ($reports as $key => $report): ?>
            <div class="report-item">
                <a href="<?= base_url($report) ?>" class="btn btn-success btn-download" download="<?= basename($report) ?>">
                    Download <?= ucfirst($key) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div> -->



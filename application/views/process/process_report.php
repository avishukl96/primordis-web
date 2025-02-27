<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Battery Cycling Dataset</a></li>
            <li class="breadcrumb-item active" aria-current="page">Generated Plots and Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Test Name: <?= $process_data['file_title'] ?></li>
        </ol>
    </nav>
</div>

<div class="container mt-5 text-center">
    <h2 class="">Reports & Plots</h2><br>

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="mt-2">Report Name: <?= $process_data['file_title'] ?></h5>
                </div>
            </div>
        </div>

        <!-- Report Download Links -->
        <div class="col-md-12 col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="<?= $response['report_pdf_url'] ?>" class="btn btn-primary" target="_blank" download>
                        <i class="fa fa-download"></i> Report PDF
                    </a>
                    <a href="<?= $response['report_xlsx_url'] ?>" class="btn btn-info"   download>
                        <i class="fa fa-download"></i> Report Excel
                    </a>
                </div>
            </div>
        </div>

        <!-- Image Display Cards -->
        <?php 

        $plots = [
            'Dynamic Predictions' => str_replace(' ', '%20',  $response['dynamic_plot_url']),
            'Forecast EOL' => str_replace(' ', '%20', $response['forecast_plot_url']),
            'RUL Plot' => str_replace(' ', '%20',$response['rul_plot_url']),
            'Uploaded Data' => str_replace(' ', '%20',$response['uploaded_plot_url'])
        ];
        
        foreach ($plots as $title => $url): ?>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <!-- <h5 class="card-title"><?= $title ?></h5> -->

                        <?php 
                        $imageData = base64_encode(file_get_contents($url));
                        $imageSrc = "data:image/png;base64," . $imageData;
                        ?>

                        <img src="<?= $imageSrc ?>" class="img-fluid rounded" alt="<?= $title ?>">
                        <br><br>
                        <a href="<?= $url ?>" download="<?= basename($url) ?>"  class="btn btn-primary mt-2">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

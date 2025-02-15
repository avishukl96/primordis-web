
    <!-- Custom Styles -->
    <style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Hero Section */
    .hero-section {
        height: 100vh;
        background: url('<?= site_url('assets/images/home_banner_1800x674.jpg'); ?>') no-repeat center center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        text-align: center;
        position: relative;
        padding: 20px;
    }

    .hero-section h1 {
        font-size: 4rem;
        font-weight: 700;
        animation: fadeIn 2s ease-out;
    }

    .hero-section p {
        font-size: 1.2rem;
        animation: fadeInUp 2s ease-out;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 10px 30px;
        font-size: 1rem;
        border-radius: 50px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #8e44ad;
    }

    /* Feature Section */
    .feature-section {
        display: flex;
        justify-content: space-around;
        margin: 50px 20px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .feature {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 30%;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .feature:hover {
        transform: translateY(-10px);
    }

    .feature-icon {
        font-size: 3rem;
        color: #3498db;
    }

    /* About and Contact Us */
    .about-us, .contact-us {
        padding: 50px 20px;
    }

    .about-us h2, .contact-us h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .card-deck {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .card {
        border-radius: 10px;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        flex: 1 1 300px;
        max-width: 300px;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    /* Carousel */
    .carousel-item img {
        width: 100%;
        height: 60vh;
        object-fit: cover;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Media Queries */
    @media (max-width: 1200px) {
        .feature {
            width: 45%;
        }
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 3rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .feature {
            width: 100%;
        }

        .carousel-item img {
            height: 40vh;
        }
    }

    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }

        .hero-section p {
            font-size: 0.9rem;
        }

        .btn-primary {
            padding: 8px 20px;
            font-size: 0.9rem;
        }

        .about-us h2, .contact-us h2 {
            font-size: 1.5rem;
        }

        .carousel-item img {
            height: 30vh;
        }
    }
</style>


<div class="">
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Welcome to Primordis</h1>
        <p>Primordis is changing the rechargeable energy landscape with autonomous energy intelligence.</p>
        <!-- <a href="#about" class="btn btn-primary animate__animated animate__fadeIn">Learn More</a> -->
    </div>
</section>

<!-- About Us Section -->
<!-- <section class="about-us container text-center" id="about">
    <h2>About Us</h2>
    <p >Primordis is chaging recharegeable energy landscape with autonomous energy intelligence</p><br>
    <div class="card-deck">
        <div class="card">
            <img src="https://www.aihr.com/wp-content/uploads/employee-empowerment-example-cover.png" class="card-img-top" alt="About Us 1">
            <div class="card-body">
                <h5 class="card-title">Our Mission</h5>
                <p class="card-text">We strive to provide innovative solutions that empower businesses and individuals to excel in the digital era.</p>
            </div>
        </div>
        <div class="card">
            <img src="https://www.pewresearch.org/wp-content/uploads/sites/20/2023/06/PI_2023.06.20_best-worst-digital-2035_featured-jpg.webp?w=1200&h=628&crop=1" class="card-img-top" alt="About Us 2">
            <div class="card-body">
                <h5 class="card-title">Our Vision</h5>
                <p class="card-text">We aim to be a leader in technology, creating products that have a lasting impact on the world.</p>
            </div>
        </div>
        <div class="card">
            <img src="https://www.qandle.com/blog/wp-content/uploads/2023/05/Core-Values.png" class="card-img-top" alt="About Us 3">
            <div class="card-body">
                <h5 class="card-title">Our Values</h5>
                <p class="card-text">Integrity, innovation, and excellence are the core values that guide us in everything we do.</p>
            </div>
        </div>
    </div>
</section> -->


<!-- Services Section -->
<!-- <section class="about-us container" id="services">
    <h2>Services</h2>
    <div class="card-deck">
        <div class="card">
            <img src="https://www.aihr.com/wp-content/uploads/employee-empowerment-example-cover.png" class="card-img-top" alt="About Us 1">
            <div class="card-body">
                <h5 class="card-title">Business Analysis</h5>
                <p class="card-text">We strive to provide innovative solutions that empower businesses and individuals to excel in the digital era.</p>
            </div>
        </div>
        <div class="card">
            <img src="https://www.pewresearch.org/wp-content/uploads/sites/20/2023/06/PI_2023.06.20_best-worst-digital-2035_featured-jpg.webp?w=1200&h=628&crop=1" class="card-img-top" alt="About Us 2">
            <div class="card-body">
                <h5 class="card-title">Visualization</h5>
                <p class="card-text">We aim to be a leader in technology, creating products that have a lasting impact on the world.</p>
            </div>
        </div>
        <div class="card">
            <img src="https://www.qandle.com/blog/wp-content/uploads/2023/05/Core-Values.png" class="card-img-top" alt="About Us 3">
            <div class="card-body">
                <h5 class="card-title">Future Prediction</h5>
                <p class="card-text">Integrity, innovation, and excellence are the core values that guide us in everything we do.</p>
            </div>
        </div>
    </div>
</section> -->

<!-- Carousel Section -->
<!-- <section id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://static.lenovo.com/ww/img/dc/solutions/big-data/lenovo-data-center-solutions-big-data-hero-banner.jpg" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Our Cutting-edge Services</h5>
                <p>Stay ahead with the best tech solutions.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://www.silvertouchtech.co.uk/wp-content/uploads/2020/05/big-data-banner.jpg" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Business Growth</h5>
                <p>Empowering businesses to grow and succeed.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://img.lovepik.com/background/20211021/large/lovepik-data-analysis-background-image_500442691.jpg" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Customer Success</h5>
                <p>We prioritize your success and satisfaction.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section> -->

<!-- Contact Us Section -->
<section class="contact-us container col-md-6" id="contact">
    <h2>Contact Us</h2>

     <!-- Display errors -->
 <?php if($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <!-- Display success -->
    <?php if($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('home/saveContact'); ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email<span style="color:red">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" rows="4" placeholder="Your Message"  name="message" ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>




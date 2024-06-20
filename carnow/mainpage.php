<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Mulish&display=swap"rel="stylesheet">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@40,600,0,0" />
    <link rel="stylesheet" href="styles/homepage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="scripts/header.js" defer></script>
    <script src="scripts/mainpage.js" defer></script>


    <?php
      include("connection.php");

      session_start();
      $username = null;
      if (isset($_SESSION['mySession'])) {
        $sessionID = $_SESSION['mySession'];
        $query = "SELECT username FROM user WHERE user_id = '$sessionID'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
      }       
      
    ?>

</head>
<body>
    <header class="main">
        <div class="navbar">
            <div class="icon">
                <a href="mainpage.php">
                    <img src="logo_image/logo-white.png" alt="Logo" class="logo">
                </a>
            </div>
            <div class="menu">
            <nav class="navigation">
        <ul>
          <?php if ($username): ?>
              <li><a href="mainpage.php">Home</a></li>
              <li><a href="#about-us">About us</a></li>
          
              <li><a href="book_appointment.php" id="serviceButton">Book a Service</a></li>
              <li><a href="my_booking.php">My Bookings</a></li>
              <li>
                  <div class="profile-menu">
                      <button onclick="myFunction()" class="dropbtn"><?php echo htmlspecialchars(explode(' ', $username)[0]); ?>
                          <span class="material-symbols-outlined">account_circle</span>
                          <span class="material-symbols-outlined">keyboard_arrow_down</span>
                      </button>
                      <div id="myDropdown" class="dropdown-content">
                          <a href="my_profile.php">My Profile</a>
                          <a href="logout.php">Logout</a>
                      </div>
                  </div>
              </li>
            <?php else: ?>
                <li><a href="#services">Our Services</a></li>
                <li><a href="#about-us">About us</a></li>
                <li><a href="#FAQ">FAQS</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><button onclick="window.location.href='login.php'" class="login-button">Login</button></li>
            <?php endif; ?>
        </ul>
    </nav>
            </div>
        </div>
    </header>
    <main>
    <article>

      <section class="hero has-bg-image" aria-label="home" >
        <div class="container">

          <div class="hero-content">

            <p class="section-subtitle :dark">We have talented engineers & mechanics</p>

            <h1 class="h1 section-title">Car Maintenance and Monitoring System</h1>

            <p class="section-text">
              Get your vehicle serviced by our expert technicians and keep track of your car's maintenance
            </p>

            <a href="#services" class="btn">
                <span class="span">Our Services</span>

                <span class="material-symbols-rounded">arrow_forward</span>
            </a>

          </div>

          <figure class="hero-banner" style="--width: 1228; --height: 789;">
            <img src="images/protons50.png" alt="Proton S50" style="width: 900px;"
              class="move-anim">
          </figure>

        </div>
      </section>





      <!-- 
        - #SERVICE
      -->

      <section id="services" class="section service has-bg-image" aria-labelledby="service-label" style="background-image: url('images/service-bg.jpg'); ">
                <div class="container" id="container-service">
                    <p class="section-subtitle :light" id="service-label">Our Services</p>
                    <ul class="service-list">
                        <li>
                            <div class="service-card">
                                <figure class="card-icon">
                                    <img src="images/services-1.png" width="90" height="90" loading="lazy" alt="Engine Repair">
                                </figure>
                                <h3 class="h3 card-title">Engine Oil Service</h3>
                                <p class="card-text">
                                    Comprehensive engine oil services to keep your car running smoothly.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="service-card">
                                <figure class="card-icon">
                                    <img src="images/services-2.png" width="90" height="90" loading="lazy" alt="Brake Repair">
                                </figure>
                                <h3 class="h3 card-title">Brake Repair</h3>
                                <p class="card-text">
                                    Expert brake repair services to ensure your safety on the road.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="service-card">
                                <figure class="card-icon">
                                    <img src="images/services-3.png" width="90" height="90" loading="lazy" alt="Tire Repair">
                                </figure>
                                <h3 class="h3 card-title">Tire Repair</h3>
                                <p class="card-text">
                                    Quality tire repair and replacement services to keep you rolling.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="service-card">
                                <figure class="card-icon">
                                    <img src="images/services-4.png" width="90" height="90" loading="lazy" alt="Battery Repair">
                                </figure>
                                <h3 class="h3 card-title">Battery Repair</h3>
                                <p class="card-text">
                                    Reliable battery repair and replacement to keep your car powered up.
                                </p>
                            </div>
                        </li>
                        <li class="service-banner">
                            <img src="images/bezza.png" width="646" height="350" loading="lazy" alt="Bezza" class="move-anim">
                        </li>
                        <li>
                            <div class="service-card">
                                <figure class="card-icon">
                                    <img src="images/services-6.png"width="90" height="90" loading="lazy" alt="Steering Repair">
                                </figure>
                                <h3 class="h3 card-title">Steering Repair</h3>
                                <p class="card-text">
                                    Professional steering repair services for better control and safety.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <?php if ($username): ?>
                      <a href="book_appointment.php" class="btn">
                        <span class="span">Book a Service</span>
                        <span class="material-symbols-rounded">arrow_forward</span>
                      </a>
                    <?php else: ?>
                      <a href="login.php" class="btn">
                        <span class="span">Login to Book a Service</span>
                        <span class="material-symbols-rounded">arrow_forward</span>
                      </a>
                    <?php endif; ?>
                    </a>
                </div>
            </section>

      <!-- 
        - #ABOUT
      -->

      <section id="about-us" class="section about has-before" aria-labelledby="about-label" style="padding-top:50px;padding-bottom:280px">
        <div class="container">

          <div class="about-banner" style="position:relative">
            <img id="supra" src="images/supra.png"  height="100" loading="lazy" alt="Supra" class="move-anim">
            <img src="images/footer-shape-2.png" width="650" height="335" loading="lazy" alt="Shape"
              class="shape shape-2" style="position: absolute; top:40%;left:-20%; z-index:-2" >
          </div>

          <div class="about-content">

            

            <p class="section-subtitle :dark">About Us</p>

            <h2 class="h2 section-title">We're Commited to Meet the quality</h2>

            <p class="section-text">
            At CarNow, we strive to deliver the highest quality service for your vehicle. 
            
            </p>

            <p class="section-text">
            We offer a wide range of services to meet all your automotive needs. 
            Trust us to keep your car in top condition.
            </p>

            <ul class="about-list">

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">1K+</strong> Satisfied Clients
                </p>
              </li>

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">50+</strong> Experts Ready
                </p>
              </li>

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">5+</strong> Years in market
                </p>
              </li>

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">100%</strong> Client Satisfaction Rate
                </p>
              </li>

            </ul>

          </div>

        </div>
          <a href="#FAQ" class="btn" id="faq">
                        <span class="span">Have Questions ? </span>
                        <span class="material-symbols-rounded">arrow_forward</span>
                    </a>

      </section>


      <!-- 
        - #WORK
      -->

      <section id="FAQ" class="section_work" aria-labelledby="work-label" style="background-image: url('images/service-bg.jpg');" >

      <h1 class="h1 section-title">Frequently Asked Questions (FAQ)</h1>

      <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
      How do I schedule a maintenance appointment for my car?
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Go to the "Book an Service" section on our website. Enter your car's details, including the car plate number.
                Select your preferred appointment date and time from the available slots. Choose the type of service you need and provide a brief description if necessary.
                Click "Start" to proceed with the booking. Review your appointment details on the confirmation page and click "Submit" to finalize your booking.
            </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
      What types of car maintenance services do you offer?
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">We offer a wide range of car maintenance services to keep your vehicle in top condition,
                including routine periodical services such as oil changes, filter replacements, and brake inspections,
                as well as specialized services like engine diagnostics, transmission repair, and tire replacement.
                For a complete list of services and detailed descriptions, please visit the "Services" section on our website.
            </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      How can I check the status of my car's maintenance?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">You can check the status of your car's maintenance through our online tracking system by logging into your account on our website,
                navigating to the "My Appointments" section, and selecting the appointment you wish to track.
                Here, you will find real-time updates on the status of your car's maintenance, including details
                on the progress of the service and any additional recommendations from our technicians.
                If you have any further questions or need assistance, please contact our customer support team.
            </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
      When do I need to make the payment for my car maintenance?
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Payment for your car maintenance is required after the service has been completed.
                Once the maintenance is finished, you will receive an invoice detailing the services
                provided and the total amount due. You can review the invoice and make your payment
                using any of the accepted payment methods. This ensures that you only pay for the services
                once you are fully satisfied with the work performed.
            </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
      What payment methods do you accept?
      </button>
    </h2>
    <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">We currently accept payments via Touch n' Go and Paypal.
            </div>
    </div>
  </div>
</div>


<div class="review-slider">
  <div class="reviews" style="--width:400px; --height:300px; --quantity:4">
    <div class="review-card" style="--position:1">
      <div class="review-header">
        <img src="images/profile-icon.png" width="50" height="50" loading="lazy" alt="User 1" class="review-avatar">
        <div class="review-info">
          <h3 class="review-name">John Doe</h3>
          <p class="review-date">July 15, 2021</p>
        </div>
      </div>
      <p class="review-text">"Great service! The technicians were very professional and knowledgeable. My car is running smoothly after the maintenance. Highly recommended!"</p>
    </div>
    <div class="review-card" style="--position:2">
      <div class="review-header">
        <img src="images/profile-icon.png" width="50" height="50" loading="lazy" alt="User 2" class="review-avatar">
        <div class="review-info">
          <h3 class="review-name">Jane Smith</h3>
          <p class="review-date">August 5, 2022</p>
        </div>
      </div>
      <p class="review-text">"I had a great experience with CarNow. The staff was friendly and the service was top-notch. I will definitely be coming back for future maintenance!"</p>
    </div>
    <div class="review-card" style="--position:3">
      <div class="review-header">
        <img src="images/profile-icon.png" width="50" height="50" loading="lazy" alt="User 3" class="review-avatar">
        <div class="review-info">
          <h3 class="review-name">David Johnson</h3>
          <p class="review-date">September 20, 2023</p>
        </div>
      </div>
      <p class="review-text">"I was impressed by the level of service provided by CarNow. The technicians were thorough and efficient, and my car is running better than ever. Thank you!"</p>
    </div>

    <div class="review-card" style="--position:4">
      <div class="review-header">
        <img src="images/profile-icon.png" width="50" height="50" loading="lazy" alt="User 4" class="review-avatar">
        <div class="review-info">
          <h3 class="review-name">Sarah Williams</h3>
          <p class="review-date">October 10, 2024</p>
        </div>
      </div>
      <p class="review-text">"CarNow provides excellent service at an affordable price. I am very satisfied with the maintenance work done on my car. Highly recommended!"</p>
    </div>

    
  </div>
</div>

      </section>

    </article>
  </main>
  <footer class="footer" id="contact">

<div class="footer-top section">
  <div class="container">

    <div class="footer-brand">

      <a href="#" class="logo" width="100%" height="100%">
        <img src="logo_image/logo-white.png" width="100%" height="100%" alt="carnow home">
      </a>


      

    </div>

    <ul class="footer-list">

      <li>
        <p class="h3">Opening Hours</p>
      </li>

      <li>
        <p class="p">Monday – Saturday</p>

        <span class="span">12.00 – 14.45</span>
      </li>

      <li>
        <p class="p">Sunday – Thursday</p>

        <span class="span">17.30 – 00.00</span>
      </li>

      <li>
        <p class="p">Friday – Saturday</p>

        <span class="span">12.00 – 14.45</span>
      </li>

    </ul>

    <ul class="footer-list">

      <li>
        <p class="h3">Contact Info</p>
      </li>

      <li>
        <a href="tel:+0390114698" class="footer-link">
          <span class="material-symbols-rounded">call</span>

          <span class="span">+03 9011 4698</span>
        </a>
      </li>

      <li>
        <a href="mailto:support@carnow.com" class="footer-link">
          <span class="material-symbols-rounded">mail</span>

          <span class="span">support@carnow.com</span>
        </a>
      </li>

      <li>
        <address class="footer-link address">
          <span class="material-symbols-rounded">location_on</span>

          <span class="span">Bukit Jalil, Selangor, Malaysia</span>
        </address>
      </li>

    </ul>

  </div>

  <img src="images/footer-shape-3.png" width="637" height="173" loading="lazy" alt="Shape"
    class="shape shape-3 move-anim">

</div>

<div class="footer-bottom">
  <div class="container">

    <p class="copyright">Car Monitoring And Service (Car Now), Inc. is a 501(c)(3) organisation registered in Malaysia. (Tax ID #06-0726487)</p>

    <img src="images/footer-shape-2.png" width="778" height="335" loading="lazy" alt="Shape"
      class="shape shape-2">

    <img src="images/x50.png" style="width:650px; height:500px; margin-bottom:130px" loading="lazy" alt="X50"
      class="shape shape-1 move-anim">

  </div>
</div>

</footer>
</body>
</html>

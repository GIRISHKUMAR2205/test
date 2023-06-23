<?php
include_once("./config.php");
session_start();
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
 $cname= trim($_POST['cname']);
 $cemail=trim($_POST["cemail"]);
 $csubject=trim($_POST['csubject']);
 $cmessage=trim($_POST['cmessage']);
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO contact (name,email,subject,message) VALUES( ?,?, ?,?);");
               $insertQuery->bind_param("ssss",$cname,$cemail,$csubject,$cmessage);
               $result=$insertQuery->execute();
               if($result){
                $success='
                <script>if($result)
                {   
 $(document).ready(function(){
     $("#myModal").modal("show");
 });}</script>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Successfully Submitted.
                      </div>
                    </div>
                  </div>
                </div>';
                echo "$success";
               }else{
                   $error='<pclass="error">Something went wrong!</p>';
                   echo "$error";
               }
            }
            $insertQuery->close();
        }
            ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>24*7 Book Flight</title>
    <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
  <script>
    $(document).ready(function(){
        $("#myModal").modal("show");
    });</script>
    <link rel="stylesheet" href="./assets/css/home.css" />
  </head>

  <body>
    
    <div class="wrapper">
      <nav>
        <a href="./home.php" class="logo"><img src="data:image/png;base64,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" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <input type="checkbox" name="" id="toggle">
        <label for="toggle"><i class="material-icons">menu</i></label>
        <div class="menu" >
          <ul>
            <li><a href="./newusers/user_login.php">User Login</a></li>
            <li><a href="./admin/admin_login.php">Admin Login</a></li>
            <li><a href="#contact" style="padding-right: 25px;">Help</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="acontainer">
      <img src="https://c1.peakpx.com/wallpaper/84/976/959/plane-flight-air-travel-airplane-wallpaper-preview.jpg" alt="Ambulance" style="width:100%;padding-top: 65px;">
      <div class="bottom-right" id="Ambulance Services"><b>Efficient and Prompt </b><br>
      Flight Services</div>
    </div>
    <div class="scontainer" style="padding-bottom: 50px;font-size: 30px;">Services</div>
    <div class="card-group">
      <div class="card" style="padding-left: 25px;">
        <img class="card-img-top" src="./assets/images/temple.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Chennai</h5>
          <p class="card-text">Best place to visit.Most Traveled places.</p><br>
          <div style="display: grid; place-items: center;">
            <a class="btn btn-primary" href="./newusers/search_flight.php" role="button">BOOK NOW</a><br>
          </div>
        </div>
      </div>
      <div class="card" style="padding-left: 25px;">
        <img class="card-img-top" src="./assets/images/Mumbai.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Mumbai</h5>
          <p class="card-text">Best place to visit.Most Traveled places.</p><br>
          <div style="display: grid; place-items: center;">
            <a class="btn btn-primary" href="./newusers/search_flight.php" role="button">BOOK NOW</a><br>
          </div>
        </div>
      </div>
      <div class="card" style="padding-left: 25px;">
        <img class="card-img-top" src="./assets/images/kashmir.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Kashmir</h5>
          <p class="card-text">Best place to visit.Most Traveled places.</p><br>
          <div style="display: grid; place-items: center;">
            <a class="btn btn-primary" href="./newusers/search_flight.php" role="button">BOOK NOW</a><br>
          </div>
        </div>
        
    </div>
    <div class="card" style="padding-left: 25px; padding-right: 25px;">
      <img class="card-img-top" src="./assets/images/kerala.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Kerala</h5>
        <p class="card-text">Best place to visit.Most Traveled places.</p><br>
        <div style="display: grid; place-items: center;">
          <a class="btn btn-primary" href="./newusers/search_flight.php" role="button">BOOK NOW</a><br>
        </div>
      </div>
    </div>
    </div>
    <div id="about" style="font-weight: bolder; font-size: 35px; text-align: center;padding-top: 60px; padding-bottom: 50px;">About Us</div>



      <div class="container">
        <div class="row" style="padding-bottom: 100px;">
          <div class="col" style="padding-top: 65px;">
            We, AMB, situated at Gandhinagar Society, Kanchipuram, Tamil Nadu is a reputed and committed ambulance provider. We are committed to provide excellent & critical care service in emergencies. We are recognized for our passionate care, we take to improve standard in critical care transport as well as safe and careful assistant in non emergency situations. We feel honored and privileged that our pre-existing clients have positive feedback towards us.
          </div>
          <div class="col-md-auto">
            <img src="./assets/images/airbg.jpg" alt="" style="border-radius: 10px;width:600px;margin-left:15px;align-items: center;">
          </div>
        </div>
      </div>
    </div>

<div class="container" id="testimonals">
		<div class="col-md-auto">
			<h2 style="display:flex; justify-content:center;" >Testimonials</h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel -->
				<div class="carousel-inner" style="width: 100%; font-weight:bolder;font-size:larger;">
					<div class="item carousel-item active">
						<p class="overview">Dauglas McNun</p>
						<p class="testimonial">Service was good.</p>
					</div>
					<div class="item carousel-item">
						<p class="overview">Jennifer Smith</p>
						<p class="testimonial">Helped me a lot.</p>
					</div>
					<div class="item carousel-item">
						<p class="overview">Hellen Wright</p>
						<p class="testimonial">"AMB services provided quick and immediate response. Getting an flght ticket within 10 mnutes of booking was something I have never experienced. Really happy with their turnaround time.
Thank you AMB. "</p>
					</div>
				</div>
				<!-- Carousel Controls -->
				<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
	</div>
  </div>
    <section id="contact" class="contact">
      <div class="container">
        <div class="section-title">
          <h2 style="text-align: center;">Contact us</h2><br>
        </div>

      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i68!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com<br>contact@example.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="cname" class="form-control" id="name" placeholder="Your Name" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="cemail" id="email" placeholder="Your Email" required="">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="csubject" id="subject" placeholder="Subject" required="">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="cmessage" rows="7" placeholder="Message" required=""></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><input type="submit" value="Send Message" name='submit' style="background:#3fbbc0;color:white;"></div>
            </form>
          </div>

        </div>

      </div>
    </section>

    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
  
            <div class="col-lg-3 col-md-6">
              <div class="footer-info">
                <h3>AMB</h3>
                <p>
                  A108 Adam Street <br>
                  NY 535022, USA<br><br>
                  <strong>Phone:</strong> +1 5589 55488 55<br>
                  <strong>Email:</strong> info@example.com<br>
                </p>
                <div class="social-links mt-3">
                  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                  <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                  <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
              </div>
            </div>
  
            <div class="col-lg-2 col-md-6 footer-links">
              <h4>Useful Links</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#Ambulance Services">Services</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#testimonals">Testimonals</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li>
              </ul>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Services</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#Ambulance Services">Hassle free transaction</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#Ambulance Services">Secure</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#Ambulance Services">Easy refunds</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#Ambulance Services">User privacy</a></li>
              </ul>
            </div>
  
            <div class="col-lg-4 col-md-6 footer-newsletter">
              <h4>Our Newsletter</h4>
              <p>Subscribe to our newsletter to receive emails about ambulance news</p>
              <form action="" method="post">
                <input type="email" name="email"><input type="submit" value="Subscribe">
              </form>
  
            </div>
  
          </div>
        </div>
      </div>
  
      <div class="container">
        <div class="copyright">
           Copyright &copy; 2023 <strong><span>AMB</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/AMB-free-bootstrap-theme/ -->
        </div>
      </div>
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>
  </body>
</html>

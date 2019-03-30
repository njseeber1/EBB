<?php
$root = 'admin/';
include_once($root.'bll/testimonials.php');
$testimonial = new Testimonials();
$testimonial->setCompanyId(1);
$dtTestimonials = $testimonial->GetTestimonials();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Eagle Business Brokers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css2/bootstrap.min.css">
    <link rel="stylesheet" href="css2/magnific-popup.css">
    <link rel="stylesheet" href="css2/jquery-ui.css">
    <link rel="stylesheet" href="css2/owl.carousel.min.css">
    <link rel="stylesheet" href="css2/owl.theme.default.min.css">
    <link rel="stylesheet" href="css2/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css2/mediaelementplayer.css">
    <link rel="stylesheet" href="css2/animate.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css2/fl-bigmug-line.css">
    
  
    <link rel="stylesheet" href="css2/aos.css">

    <link rel="stylesheet" href="css2/style.css">
    
  </head>
  <body>
  
  <div class="site-loader"></div>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    <div class="border-bottom bg-white top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-6">
            <p class="mb-0">
              <a href="#" class="mr-3"><span class="text-black fl-bigmug-line-phone351"></span> <span class="d-none d-md-inline-block ml-2">+2 102 3923 3922</span></a>
              <a href="#"><span class="text-black fl-bigmug-line-email64"></span> <span class="d-none d-md-inline-block ml-2">info@domain.com</span></a>
            </p>  
          </div>
          <div class="col-6 col-md-6 text-right">
            <a href="#" class="mr-3"><span class="text-black icon-facebook"></span></a>
            <a href="#" class="mr-3"><span class="text-black icon-twitter"></span></a>
            <a href="#" class="mr-0"><span class="text-black icon-linkedin"></span></a>
          </div>
        </div>
      </div>
      
    </div>
    <div class="site-navbar">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
              <h1 class=""><a href="index.php" class="h5 text-uppercase text-black">Eagle Business Brokers</strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
              <nav class="site-navigation text-right text-md-right" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li>
                    <a href="index.php">Home</a>
                  </li>
                  <li>
                    <a href="listings.php">Properties</a>
                    <!-- <ul class="dropdown">
                      <li><a href="#">Buy</a></li>
                      <li><a href="#">Rent</a></li>
                      <li><a href="#">Lease</a></li>
                      <li class="has-children">
                        <a href="#">Menu</a>
                        <ul class="dropdown">
                          <li><a href="#">Menu One</a></li>
                          <li><a href="#">Menu Two</a></li>
                          <li><a href="#">Menu Three</a></li>
                        </ul>
                      </li>
                    </ul> -->
                  </li>
                  <li><a href="blog.php">Blog</a></li>
                  <li class="active"><a href="about.html">About</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </nav>
            </div>
           

          </div>
        </div>
      </div>
    </div>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images2/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">About Us</h1>
            <!-- <div><a href="index.php">Home</a> <span class="mx-2 text-white">&bullet;</span> <strong class="text-white">About</strong></div> -->
          </div>
        </div>
      </div>
    </div>

    <div class="site-section border-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <img src="images2/about.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-5 ml-auto"  data-aos="fade-up" data-aos-delay="200">
            <div class="site-section-title mb-3">
              <h2>Our Company</h2>
            </div>
            <h1>Why Work With Us?</h1>
                <p>Eagle Business Brokers specializes in commercial real estate transactions and has built a niche in the buying and selling of business opportunities. We make it easy for our clients to acquire a new business or sell an existing business. In addition we can help in all the endeavors of starting a new business, strategizing for expansion, improving profitability, mergers and dispositions.</p>
                <p>Most business owners are committed to being successful, and know the ins and outs of their business. However when it comes to acquisition or transition, it demands a different set of experience, which most are not accustomed to. That is where Eagle Business Brokers delivers real value. We will walk you through step-by-step to achieve your goal. </p>
                <p>Call for a free <a href="services_evaluation.html">Business Evaluation</a> today at 303-743-7303</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-md-2" data-aos="fade-up" data-aos-delay="100">
            <img src="images2/hero_bg_4.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-5 mr-auto order-md-1"  data-aos="fade-up" data-aos-delay="200">
            <div class="site-section-title mb-3">
              <h2>Our Team</h2>
            </div>
            <h1>We are here to help</h1>
                        <p>We are seasoned brokers ready to serve you in many diverse areas of real estate and business brokerage, putting our more than 45 years of combined experience to work for your business success.</p>
      <p>We can assist you in English, Spanish or Russian, and indeed, if you click the upper right area of our website, you can choose to read our site in one of those languages.</p>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section border-top bg-light">
    <div class="container">
      <div class="row mb-5 justify-content-center"  data-aos="fade-up" >
        <div class="col-md-7">
          <div class="site-section-title text-center">
            <h2>Leadership</h2>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5"  data-aos="fade-up" data-aos-delay="200">
            <div class="team-member p-4">

              <img src="images/mathew_abraham.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Mathew Abraham</h2>
                <span class="d-block mb-3 text-white-opacity-05">Owner/Founder</span>
                <p>Mathew is the owner and founder of the company, which has been in operation since 1980. Over the last 25 years, Matthew has brokered hundreds of commercial real estate and business opportunity transactions.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5"  data-aos="fade-up" data-aos-delay="300">
            <div class="team-member p-4">

              <img src="images/samuel_abraham.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Samuel Abraham</h2>
                <span class="d-block mb-3 text-white-opacity-05">Founder</span>
                <p>Samuel has been with the firm since 2010 and specializes in both residential and commercial aspects of the business. He currently manages an office in the state of Florida.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5"  data-aos="fade-up" data-aos-delay="400">
            <div class="team-member p-4">

              <img src="images/ludmila_blagonya.jpg" alt="Image" class="img-fluid rounded mb-4">

              <div class="text">

                <h2 class="mb-2 font-weight-light text-black h4">Ludmila Blagonya</h2>
                <span class="d-block mb-3 text-white-opacity-05">Real Estate Agent</span>
                <p>Ludmila has been active in both residential and commercial field for eight years and she brings a very special international background. Fluent in Russian and Ukrainian she serves the Slavic community.</p>
                <p>
                  <a href="#" class="text-black p-2"><span class="icon-facebook"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="text-black p-2"><span class="icon-linkedin"></span></a>
                </p>
              </div>

            </div>
          </div>
        </div>
    </div>
    </div>

    
    <div class="site-section">
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-md-7">
          <div class="site-section-title text-center">
            <h2>Testimonies</h2>
          </div>
        </div>
      </div>
      <div class="row block-13">

        <div class="nonloop-block-13 owl-carousel">
        <?php
                        for($cnt = 0; $cnt < count($dtTestimonials); $cnt ++){
                            echo '

                            <div class="slide-item">
                            <div class="team-member text-center">
                              <div class="text p-3">
                                <h2 class="mb-2 font-weight-light text-black h4">'.$dtTestimonials[$cnt]->author.'</h2>
                                <span class="d-block mb-3 text-white-opacity-05">'.$dtTestimonials[$cnt]->author.'</span>
                                <p class="mb-5">&ldquo;'.$dtTestimonials[$cnt]->testimonial.' &rdquo;</p>
                                
                              </div>
                            </div>
                          </div>
                            ';
                        }
                    ?>
         
          </div>

          </div>

        </div>

        </div>
      </div>
    </div>


    

    <div class="site-section site-section-sm bg-primary">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h2 class="text-white">Wide Range of Properties Just For You</h2>
            <!-- <p class="lead text-white-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
          </div>
          <div class="col-md-4 text-center">
            <a href="listings.php" class="btn btn-outline-primary btn-block py-3 btn-lg">See Properties</a>
          </div>
        </div>
      </div>
    </div>
    

 <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-5">
              <h3 class="footer-heading mb-4">About Eagle Business Brokers</h3>
              <p>To buy or sell a franchise and a business opportunity in Colorado, along the Front Range or anywhere in the Metro Denver area from Colorado Springs to Boulder and from Aurora to Lakewood, Northglenn to Fort Collins to Greeley as well, call Eagle Business Brokers today - 303-743-7303. Put our expertise to work for you.</p>
            </div>

            
            
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="blog.php">Blog</a></li>
                  <!-- <li><a href="#">Rent</a></li> -->
                  <li><a href="listings.php">Properties</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="about.php">About Us</a></li>
                  <!-- <li><a href="#">Privacy Policy</a></li> -->
                  <li><a href="contact.php">Contact Us</a></li>
                  <!-- <li><a href="#">Terms</a></li> -->
                </ul>
              </div>
            </div>


          </div>

          <div class="col-lg-4 mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Follow Us</h3>

                <div>
                  <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </div>

            

          </div>
          
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;</script><script>document.write(new Date().getFullYear());</script> All rights reserved 
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>
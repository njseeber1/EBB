<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EagleBusiness Brokers &mdash;</title>
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
    
  
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style 2.css">
    <style>
        .ImageStyle{
            min-height:350px;
            min-width:350px;
            max-height:350px;
            display:cover;
        }
        </style>

  </head>
  <body>
  
  <div class="site-loader"></div>
  
  <div class="site-wrap" ng-app="App" ng-controller="ListingsCtrl as list" ng-init="list.init('current')">

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
              <h1 class=""><a href="index.html" class="h5 text-uppercase text-black"><strong>Eagle Business Brokers</strong></a></h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
              <nav class="site-navigation text-right text-md-right" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li>
                    <a href="index.php">Home</a>
                  </li>
                  <li class="active">
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
                  <li><a href="about.php">About</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </nav>
            </div>
           

          </div>
        </div>
      </div>
   

    <div class="slide-one-item home-slider owl-carousel">

      <div  class="site-blocks-cover" style="background-image: url(uploads/listings/listing_{{list.show[0].listingId}}.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">

        <div class="text">
          <h2>{{list.show[0].location}}</h2>
          <p class="location"><span class="property-icon icon-room"></span>{{list.show[0].city}}</p>
          <p class="mb-2"><strong>${{list.show[0].listPrice}}</strong></p>
          
          
          <p class="mb-0"><a href="property-details.html" class="text-uppercase small letter-spacing-1 font-weight-bold">More Details</a></p>
          
        </div>
      </div>  

      <div  class="site-blocks-cover" style="background-image: url(uploads/listings/listing_{{list.show[1].listingId}}.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">

        <div class="text">
          <h2>{{list.show[1].location}}</h2>
          <p class="location"><span class="property-icon icon-room"></span>{{list.show[1].city}}</p>
          <p class="mb-2"><strong>${{list.show[1].listPrice}}</strong></p>
          
          
          <p class="mb-0"><a href="property-details.html" class="text-uppercase small letter-spacing-1 font-weight-bold">More Details</a></p>
          
        </div>
      </div> 

    </div>

    <div class="pt-5">
      <div class="container">
        <form class="row">
          
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select  name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="Property Type">Property Type</option>
                <option id="1" type="checkbox" ng-click="list.pushCriteria(1)">Business Opportunity</option>
                <option id="2" type="checkbox" ng-click="list.pushCriteria(2)">Commercial Real Estate</option>
                <option id="3" type="checkbox" ng-click="list.pushCriteria(3)" >Residential Real Estate</option>
                <option id="other" type="checkbox" ng-click="list.pushCriteria('other')" >Other</option>
                <option id="liquor" type="checkbox" ng-click="list.pushCriteria('liquor')" >Liquor</option>
                <option id="barrestaurant" type="checkbox" ng-click="list.pushCriteria('barrestaurant')">Bars / Restaurants</option>
                <option id="land" type="checkbox" ng-click="list.pushCriteria('land')" >Land</option>
                <option id="church" type="checkbox" ng-click="list.pushCriteria('church')">Church</option>
                <option id="residential" type="checkbox" ng-click="list.pushCriteria('residential')">Residential</option>
                <option id="store" type="checkbox" ng-click="list.pushCriteria('store')">Store</option>
              </select>
            </div>
          </div>
          
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="">Property Status</option>
                <option value="For Sale">For Sale</option>
                <option value="For Rent">For Rent</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="">Location</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Canada">Canada</option>
                <option value="Belgium">Belgium</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="">Lot Area</option>
                <option value="1000">1000</option>
                <option value="800">800</option>
                <option value="600">600</option>
                <option value="400">400</option>
                <option value="200">200</option>
                <option value="100">100</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="">Bedrooms</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5+">5+</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="select-wrap">
              <span class="icon icon-arrow_drop_down"></span>
              <select name="offer-types" id="offer-types" class="form-control d-block rounded-0">
                <option value="">Bathrooms</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5+">5+</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="mb-4">
              <div id="slider-range" class="border-primary"></div>
              <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <input type="submit" ng-click="list.pushCriteria($('#offer-types > option:selected').attr('id'))" class="btn btn-primary btn-block form-control-same-height rounded-0" value="Search">
          </div>
          
        </form>

        
      </div>
    </div>
    <div class="site-section site-section-sm bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <div class="site-section-title">
              <h2>New Properties for You</h2>
            </div>
          </div>
        </div>
        <div class="row mb-5">
                <div ng-if="list.show.length == 0" class="col-md-6 col-lg-4 mb-4"> 
                        <span>{{list.none}}</span>
                    </div>
          <div ng-repeat="l in list.show" ng-if="list.meetsCriteria(l)"class="col-md-6 col-lg-4 mb-4">
            <a href="property-details.html" class="prop-entry d-block">
              <figure>
                <img class="ImageStyle" src="uploads/listings/listing_{{l.listingId}}.jpg " alt="Image" class="img-fluid">
              </figure>
              <div class="prop-text">
                <div class="inner">
                  <span class="price rounded">${{l.listPrice}}</span>
                  <h3 class="title">{{l.location}}</h3>
                  <p class="location">{{ l.city}}</p>
                </div>
                <div class="prop-more-info">
                  <div class="inner d-flex">
                    <div class="col">
                      <span>Area:</span>
                      <strong>{{l.area}}<sup>2</sup></strong>
                    </div>
                    <div class="col">
                      <span>Beds:</span>
                      <strong>2</strong>
                    </div>
                    <div class="col">
                      <span>Baths:</span>
                      <strong>2</strong>
                    </div>
                    <div class="col">
                      <span>Garages:</span>
                      <strong>1</strong>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          

        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="site-pagination">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#">5</a>
              <span>...</span>
              <a href="#">10</a>
            </div>
          </div>  
        </div>
        
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center mb-5">
            <div class="site-section-title">
              <h2>Our Services</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-house"></span>
              <h2 class="service-heading">Research Subburbs</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-sold"></span>
              <h2 class="service-heading">Sold Houses</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-camera"></span>
              <h2 class="service-heading">Security Priority</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-house"></span>
              <h2 class="service-heading">Research Subburbs</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-sold"></span>
              <h2 class="service-heading">Sold Houses</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <a href="#" class="service text-center border rounded">
              <span class="icon flaticon-camera"></span>
              <h2 class="service-heading">Security Priority</h2>
              <p><span class="read-more">Learn More</span></p>
            </a>
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
  <script src="/js/angular.min.js"></script>
<script src="/js/angular-sanitize.min.js"></script>
  <script src="/js/my-ng.js"></script>
    
  </body>
</html>
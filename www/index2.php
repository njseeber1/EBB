<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root.'/admin/bll/listings.php');
$listing = new Listings();
$listing->setCompanyId(1);
$dtTopListings = $listing->GetTopListings();
$dtTopSoldListings = $listing->GetTopSoldListings();
include_once($root.'/admin/bll/blogs.php');
$blog = new Blogs();
$blog->setCompanyId(1);
$dtBlog = $blog->GetLastBlog();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Eagle Business Brokers</title>
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/css/taylor.css" rel="stylesheet" type="text/css" />
    <link href="/css/contact.css" rel="stylesheet" type="text/css" />
    <style>
    a:hover{
      cursor: pointer;
    }
    </style>
</head>
<body>
<div class="wrap">
  <div class="container">
      <div class="main">
          <div class="header">
              <div class="hdltcol">
                  Brittany Real Estate LLC DBA<br/>
              <span class="bold4x"><a href="index.php">Eagle Business Brokers LLC</a></span></div>
                <div class="hdrtcol">
                <a href="https://www.facebook.com/pages/Eagle-Business-Brokers/729725907153091" target="_blank"><img src="images/facebook-32.png" alt="Facebook" /></a> <a href="https://twitter.com/eaglescorner1" target="_blank"><img src="images/twitter-32.png" /></a> Language <a href="index.php">EN</a> <a href="russian.html">RUS</a> <a href="spanish.html">ESP</a> <br/>
                    <span class="bold2x">Call 303-743-7303</span>
              </div>
          </div>
        
          <div class="nav">
              <ul>
              <li><a href="index.php">HOME</a></li>
              <li><a href="about.html">ABOUT US</a>
                    <ul>
                    <li><a href="about_history.html">History</a></li>
                    <li><a href="about_business.html">How we do Business</a></li>
                    <li><a href="testimonials.php">Testimonials</a></li>
                    <li><a href="about_team.html">Team Members</a></li>
                    <li><a href="about_join_team.php">Join Our Team</a></li>
                    <li><a href="about_other.html">Other</a></li>
                </ul>
              </li>
              <li><a href="listings_current.php">LISTINGS</a>
                <ul>
                    <li><a href="listings_current.php">Our Listings</a></li>
                    <li><a href="listings_sold.php">Sold Listings</a></li>
                </ul>
              </li>
              <li><a href="services.html">SERVICES</a>
                    <ul>
                    <li><a href="services_buy.html">Buy a Business</a></li>
                    <li><a href="services_sell.html">Sell a Business</a></li>
                    <li><a href="services_evaluation.html">Business Evaluation</a></li>
                    <li><a href="services_commercial.html">Commercial Real Estate</a></li>
                    <li><a href="services_residential.html">Residential</a></li>
                    <li><a href="services_other.html">Other</a></li>
                </ul>
              </li>
              <li><a href="resources.php">RESOURCES</a>
                    <ul>
                    <li><a href="local_links.html">Local Links</a></li>
                    <li><a href="loans.php">Loans</a></li>
                    <li><a href="news.php">News & Laws</a></li>
                    <li><a href="resources_other.html">Other Resources</a></li>
                    </ul>
              </li>
              <li><a href="faq.html">FAQ</a>
                    <ul>
                    <li><a href="faq_realtor.html">Realtor</a></li>
                    <li><a href="faq_buyer.html">Buyer</a></li>
                    <li><a href="faq_seller.html">Seller</a></li>
                    <li><a href="faq_other.html">Other</a></li>
                </ul>
              </li>
              
              <li><a href="blog.php">BLOG</a></li>
              <li><a href="contact_us.php">CONTACT US</a></li>
              </ul>
          </div>
            
          <div class="bannercont">
            <div class="banner">
              <ul class="rslides">
                <li><img src="images/banner.jpg" alt="" /></li>
                <li><img src="images/banner1.jpg" alt="" /></li>
                <li><img src="images/banner2.jpg" alt="" /></li>
                <li><img src="images/banner3.jpg" alt="" /></li>
              </ul>
            </div>     
          </div>
          <div class="mid">
            <ul class="types">
              <li><a href="listings_current.php"><button class="buttonblue">All Listings</button></a></li>
              <li><a href="listings_current.php?type=1"><button class="buttonblue">Business Opportunities</button></a></li>
              <li><a href="listings_current.php?type=3"><button class="buttonblue">Residential Real Estate</button></a></li>
              <li><a href="listings_current.php?type=2"><button class="buttonblue">Commercial Real Estate</button></a></li>
            </ul>
          <div style="clear: both;"></div>
          </div>

            <div class="bodymain">
              <div class="bodyltcol">
                  <div class="bodysmcol"><h2 id="special"><a href="listings_current.php">Click here to see our Colorado Commercial and Business Opportunity Listings</a></h2>
                    <p>Eagle Business Brokers lists <em>businesses for sale</em> as well as business real estate for sale or lease in Denver, Colorado, and along the Front Range. For a complete inventory, please visit <a href="#">Our Listings</a> page, or call us for assistance - 303-743-7303</p>
                  </div>          
                  <div class="bodysmcol"><h3><a href="listings_current.php">Our Listings</a></h3></div>
          <?php
          for($cnt = 0; $cnt < count($dtTopListings); $cnt ++){
            $imgPath = 'images/no-image-available.jpg';
            if (file_exists('uploads/listings/listing_'. $dtTopListings[$cnt]->listingId.'.jpg')) $imgPath = 'uploads/listings/listing_'. $dtTopListings[$cnt]->listingId.'.jpg';
            $description = strip_tags($dtTopListings[$cnt]->description);
            if(strlen($description) > 150) $description = substr($description, 0, 145).' ...';
            echo '
            <div class="bodysmcol">
              <img src="'.$imgPath.'" />
              <h5>'.$dtTopListings[$cnt]->title.'</h5>
              <p>'.$description.'</p>
              <a href="listings_current.php?id='.$dtTopListings[$cnt]->listingId.'" class="buttonblue">Know More</a>
            </div>
            <div class="divider"></div>
            ';
          }
          ?>
                  <div class="bodysmcol" style='margin-bottom:0px;'>
                  <h4 id='view_all_listings'><a href="listings_current.php">View All Listings</a></h4> 
                  </div>
                    
                </div>
                <div class="bodycntrcol">
                  <div class="bodysmcol"><h2><a href="services.html">Business Brokerage and Commercial Real Estate Services</a></h2>
                    <p>Eagle Business Brokers is a <em>full-service business opportunity broker</em> providing comprehensive services for buying, selling, or valuing business opportunities and commercial real estate in metro Denver, along the Front Range or anywhere in Colorado. Please click on any link below, or simply call us for assistance with your Colorado business opportunity or business real estate needs. Call 303-743-7303</p>
                    <h3><a href="services_buy.html">Buy a Business</a></h3>
                    <p>If you are looking to buy a business or sell a business in Colorado, Eagle Business Brokers will expertly guide you through every step of the process. </p>
                    <h3><a href="services_sell.html">Sell A Business</a></h3>
                    <p>If you are considering selling a business in Colorado, we can help you in every step of the way. </p>
                    <h3><a href="services_evaluation.html">Business Evaluations</a></h3>
                    <p>Perhaps you are not ready to sell the business, however, you like to determine the worth of it. Determining the value of a business requires a high level of knowledge and expertise. We have more than 30 years of experience evaluating Colorado businesses for sale or purchase. </p>
                    <h3><a href="services_commercial.html">Commercial Real Estate</a></h3>
                    <p>Whether you are in the market to buy, sell or lease retail, office or warehouse space for your business, we can help. </p>
                    <h3><a href="services_residential.html">Residential Real Estate</a></h3>
                    <p>Our full service team includes a residential real estate broker who can help you buy or sell your home. </p>
                    </div>
                    <div class="divider"></div>
                    <div class="bodysmcol"><h2><a href="blog.php">Eagle's Corner</a></h2>
            <?php
              if(count($dtBlog) > 0){
                $imgPath = 'images/no-image-available.jpg';
                if (file_exists('uploads/blogs/blog_'.$dtBlog[0]->blogId.'.jpg')) $imgPath = 'uploads/blogs/blog_'.$dtBlog[0]->blogId.'.jpg';
                $content = strip_tags($dtBlog[0]->content);
                if(strlen($content) > 150) $content = substr($content, 0, 145).' ...';
                echo '
                <img src="'.$imgPath.'" />
                <h4>'.$dtBlog[0]->heading.'</h4>
                <p>'.$content.'</p> 
                ';
              }
            ?>
            <a href="blog.php">Read more...</a>
          </div>
                    <div class="divider"></div>
                    <div class="bodysmcol">
                      <h2><a href="testimonials.php">Testimonials</a></h2>
                      <img src="images/small.jpg" />
                    <p>Our excellent reputation is built on our clients' experiences. Read what our customers have to say, about our services.</p> 
                    <a href="testimonials.php">View Testimonials</a></div>

                </div>
                
                <div class="bodyrtcol">
                  <div class="bodysmcol"><h2><a href="listings_sold.php">Sold Listings – Colorado Business Opportunities and Commercial Real Estate Sales</a> </h2>
                    <p>We have a track record of more than 30 years of successful sales and purchases of Colorado business opportunities and commercial real estate. Below are some of our recent transactions. To see a more complete listing, click here. Please also visit our <a href="#">Testimonials</a> page</p>
                  </div>
                    <div class="bodysmcol">
                  <h3><a href="listings_sold.php">Sold Listings</a></h3>
          </div>
          <?php
          for($cnt = 0; $cnt < count($dtTopSoldListings); $cnt ++){
            $imgPath = 'images/no-image-available.jpg';
            if (file_exists('uploads/listings/listing_'. $dtTopSoldListings[$cnt]->listingId.'.jpg')) $imgPath = 'uploads/listings/listing_'. $dtTopSoldListings[$cnt]->listingId.'.jpg';
            $description = strip_tags($dtTopSoldListings[$cnt]->description);
            if(strlen($description) > 150) $description = substr($description, 0, 145).' ...';
            echo '
            <div class="bodysmcol">
              <img src="'.$imgPath.'"  />
              <h5>'.$dtTopSoldListings[$cnt]->title.'</h5>
              <p>'.$description.'</p>
              <a href="listings_sold.php?id='.$dtTopSoldListings[$cnt]->listingId.'" class="buttonblue">Know More</a>
            </div>
            <div class="divider"></div>
            ';
          }
          ?>
                  <div class="bodysmcol">
                  <h4><a href="listings_sold.php">View Sold Listings</a></h4> 
                  </div>
                </div>
            </div>
            
            <div class="bodytxt"><img src="images/Denver.jpg" />
              <h1>Eagle Business Brokers</h1>
                
                <p>Eagle Business Brokers helps clients find <em>business opportunities</em> to purchase or assists clients in selling their existing business. Buying and selling businesses and/or the real estate that goes with them can be a complicated and complex process. With more than <em>30 years of experience</em> buying and selling business opportunities and commercial real estate in Colorado, we can help you navigate the process to a successful outcome. From restaurants to liquor stores to gas stations to daycare centers or convenience stores, we have the expertise to find the right business for you to buy, or can negotiate a successful sale of your current business. If you already have a business and need help finding a location, we can help with your commercial real estate needs throughout Colorado.</p>

<p>To buy or sell a franchise and a <em>business opportunity</em> in <em>Colorado</em>, along the <em>Front Range</em> or anywhere in the <em>Metro Denver</em> area from Colorado Springs to Boulder and from Aurora to Lakewood, Northglenn to Fort Collins to Greeley as well, call Eagle Business Brokers today - 303-743-7303. Put our expertise to work for you.
<p>
            </div>
            <div class="grouplogo"><img src="images/logo_clba.png" /><img src="images/logo_dmcab.jpg" /><img src="images/logo_dora.jpg" /><img src="images/logo_realtor.png" /><img src="images/logo_Xceligent.png" />
            </div>

            
            <!-- START FOOTER --> 
<div class="sub-overlay hide"></div>
<div class="overlay hide" >
    <div id="alert"></div>
    <form id="enquiry" name="enquiry" method="post" action="">
        <div class="box">
        <h3>Contact Form</h3>
        <p><span class="small">All fields are necessary</span></p>
        <label>
            <span>Full name </span>
            <input type="text" class="input_text" name="name" id="name">
        </label>
        <label>
            <span>Phone </span>
            <input type="text" class="input_text" name="phone" id="phone">
        </label>
        <label>
            <span>Email </span>
            <input type="text" class="input_text" name="email" id="email">
        </label>
        <label>
            <span>Subject </span>
            <input type="text" class="input_text" name="subject" id="subject">
        </label>
        <label>
            <span>Message </span>
            <textarea class="message" name="message" id="message"></textarea>
        </label>
        <label>
            <input type="submit" class="button" value="Send Message">
            <span id="sending" class="hide">Sending Query...</span>
        </label>
        <input name="mode" value="blank" type="hidden">
    </div>
</form>
</div>
<div class="topreturn"><a href="#">&#710; Back to Top</a></div>
<div class="footer">
    <div class="footercol">
    <ul>
    <li><a href="index.php">Home</a></li> 
    <li><a href="about.html">About Us</a></li>
    <li><a href="contact_us.php">Contact Us</a> </li>
    <li><a href="sitemap.php">Site Map  </a></li>   
    </ul>
    </div>
    <div class="footercol">
    <ul>
    <li><a href="about_business.html">How we do Business</a></li>
    <li><a href="testimonials.php">Testimonials</a></li>
    <li><a href="about_team.html">Team Members</a></li>
    <li><a href="about_join_team.php">Join Our Team</a></li>
    </ul>
    </div>
    <div class="footercol">
    <ul>
    <li><a href="listings_current.php">Our Listings</a> </li> 
    <li><a href="listings_sold.php">Sold Listings</a> </li>
    <li><a href="services_buy.html">Buy a Business</a> </li>
    <li><a href="services_sell.html">Sell a Business    </a></li>
    <li><a href="services_evaluation.html">Business Evaluation</a> </li>
    <li><a href="services_commercial.html">Commercial Real Estate</a> </li>
    <li><a href="services_residential.html">Residential Real Estate</a> </li>
    </ul>
    </div>
    <div class="footercol">
    <ul>
    <li><a href="local_links.html">Local Links</a> </li> 
    <li><a href="loans.php">Loans</a> </li>
    <li><a href="news.php">News and Laws</a> </li>
    <li><a href="resources_other.html">Other Resources</a> </li>
    <li><a href="faq.html">FAQ</a> </li>
    <li><a href="blog.php">Our Blog </a></li>
    </ul>
    </div>
  <div class="footercolend"><em>Eagle Business Brokers</em><br/>3650 S Yosemite St. Suite 204<br/>
Denver, Colorado 80237<br/>303-743-7303<br/><a href="#" id="contactFoot"><button class="buttonblue">Click Here to Contact Us</button></a></div>
</div>
<script src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://eaglebusinessbrokers.com/js/quickform.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        var url = window.location.origin;
        $("#contactFoot").on("click touch", function(e){
            e.preventDefault();
            $(".overlay, .sub-overlay").removeClass("hide");
        });
        $(".sub-overlay").on("click touch", function(e){
            e.preventDefault();
            $(".sub-overlay, .overlay").addClass("hide");
            $("#enquiry").find("input[type=text], textarea").val("");
        });
        $("#enquiry").submit(function(e){
            e.preventDefault();
            $("#sending").removeClass("hide");
                if(checkform()){
                    $.post(url+"/ajax/submit-query.php", $(this).serialize(), function(resp){
                        if(typeof resp == 'string')
                            resp = JSON.parse(resp)
                        if(resp.status == 0){
                            message = "We value the interest you have taken in our services. We will attend to your query at the earliest and get back to you soon.  Thank you!";
                            $("#alert").prepend('<div id="myAlert" class="alert alert-over">'+message+'</div><div class="center"><button id="closeOverlay" class="buttonblue">Close Window</button></div>');
                        }
                        else{
                            $("#alert").prepend('<div id="myAlert" class="alert alert-danger">'+resp.message+'</div>');
                        }
                        $("#myAlert").css({
                            "font-size": "1.5em",
                            "line-height": "1.5"
                        });
                        $("#closeOverlay").on("click touch", function(e){
                            e.preventDefault();
                            $(".sub-overlay, .overlay").addClass("hide");
                            $("#enquiry").find("input[type=text], textarea").val("");
                        });
                        $("#myAlert").hide();
                        $("#myAlert").fadeIn();
                        $("#enquiry, #sending").addClass("hide");
                    });
                }
            });
    });

</script>
<!-- END FOOTER -->

      </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>
</body>
</html>

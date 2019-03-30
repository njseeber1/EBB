<?php
$root = 'admin/';
include_once($root.'bll/resources.php');
$resource = new Resources();
$resource->setCompanyId(1);
$dtResources = $resource->GetResources();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                <a href="https://www.facebook.com/pages/Eagle-Business-Brokers/163683636983395" target="_blank"><img src="images/facebook-32.png" alt="Facebook" /></a> <a href="https://twitter.com/eaglescorner1" target="_blank"><img src="images/twitter-32.png" /></a> Language <a href="index.html">EN</a> <a href="russian.html">RUS</a> <a href="spanish.html">ESP</a> <br/>
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
            <div class="innerhead">Resources</div>
            <div class="bodytxt">
                <div class="bodytxtlt">
                    <ul>
                    <li><a href="resources.php">Resources</a></li>
                    <li><a href="local_links.html">Local links</a></li>
                    <li><a href="loans.php">Loans</a></li>
                    <li><a href="news.php">News & Laws</a></li>
                    <li><a href="resources_other.html">Other Resources</a></li>
                    </ul>
                </div>
                <div class="bodytxtrt">
                    <div class="bodytxtbox">
                        <h1>Buyer &amp; Seller Resources</h1>
                        <p>We have put together a list of documents that cover different aspects of sale/lease of business or property, loans, financing, local regulations, cheklists etc.</p>
                    </div>
                    <?php
                        for($cnt = 0; $cnt < count($dtResources); $cnt++){
                            echo '
                            <div class="bodytxtbox">
                              <h2>'.$dtResources[$cnt]->documentName.'</h2>
                                <p>'.$dtResources[$cnt]->description.'</p>
                                <p><a href="uploads/resources/'.$dtResources[$cnt]->documentName.'.'.$dtResources[$cnt]->contentType.'" target="_blank">Click Here</a> to download the form.</p>
                            </div>
                            ';
                        }
                    ?>
                    <div class="bodytxtbox">
                      <h2>First Document</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                        <p><a href="#">Click Here</a> to download the form.</p>
                    </div>
                    </div>
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
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Eagle Business Brokers</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="css/main.css" rel="stylesheet" type="text/css" />
  <link href="css/listing.css" rel="stylesheet" type="text/css" />
  <link href="css/taylor.css" rel="stylesheet" type="text/css" />
  <link href="css/contact.css" rel="stylesheet" type="text/css" />
  <style>
    a:hover{
      cursor: pointer;
    }
  </style>
</head>

<body>
<div class="wrap" ng-app="App" ng-controller="ListingsCtrl as list" ng-init="list.init('sold')">
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
        <!--    <div class="innerhead">Our Listings</div> -->
            
            <div class="bodylistings">
              <div class="listingbox">
                <h1>Our Sold Listings</h1>
              </div>
          </div>
       <div class="sortcolsub">
          <h2> Filters <span class="tiny">(check all you want to see)</span> </h2>
              <ul class="filters">
                <li><input id="1" type="checkbox" ng-click="list.pushCriteria(1)" />Business Opportunity</li> 
                <li><input id="2" type="checkbox" ng-click="list.pushCriteria(2)" />Commercial Real Estate</li> 
                <li><input id="3" type="checkbox" ng-click="list.pushCriteria(3)" />Residential Real Estate</li> 
                <li><input id="other" type="checkbox" ng-click="list.pushCriteria('other')" />Other Properties</li>
                <li><input id="liquor" type="checkbox" ng-click="list.pushCriteria('liquor')" />Liquor Stores</li>
                <li><input id="barrestaurant" type="checkbox" ng-click="list.pushCriteria('barrestaurant')" />Bars / Restaurants</li>
                <li><input id="land" type="checkbox" ng-click="list.pushCriteria('land')" />Land</li>
                <li><input id="church" type="checkbox" ng-click="list.pushCriteria('church')" />Churches</li>
                <li><input id="residential" type="checkbox" ng-click="list.pushCriteria('residential')" />Residential</li> 
                <li><input id="store" type="checkbox" ng-click="list.pushCriteria('store')" />Gas Station / Convenience Store</li> 
                </ul>
            </div>
            <div ng-show="list.loading" class="center"><i class="fa fa-refresh fa-spin fa-3x"></i></div>
      <div class="bodylistings">
        <div style="margin-top: 20px;" ng-show="list.none" class="alert alert-warning">
          {{ list.none }}
        </div>
        <div class="listingbox" ng-repeat="l in list.show" ng-if="list.meetsCriteria(l)">
          <h2>Sold: {{ l.title }} </h2>
          <div class="listingboxcol">
            <div class="bodylistingslt">
              <img ng-src="uploads/listings/listing_{{l.listingId}}.jpg " />
              <div class="hide"></div>
              <div class="listnav">
                <ul>
                <li><a map loc="{{l.location}}" city="{{l.city}}" class="location">View Location</a></li>
                <li><a ng-href="uploads/downloads/brochure_{{l.listingId}}.pdf" >Download Brochure</a></li>
                <li><a ng-click="list.setCurrent(l)">Send Query</a><span class="hide"> {{ l.title }} </span></li>
                </ul>
              </div>
            </div>
            <div class="bodylistingsrt">
              <div class="listinghead">
                <span class="small">Listing Broker</span><br/> 
                {{ l.brokerName }}
              </div>
              <div class="listingcol">
                <table width="260" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                  <td width="130" height="35" class="listinghl">Location:</td>
                  <td width="140" height="35"> {{ l.location }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">City/State:</td>
                  <td width="140" height="35"> {{ l.city }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Square Feet:</td>
                  <td width="140" height="35"> {{ l.area }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Rent:</td>
                  <td width="140" height="35"> {{ l.rent == 00 ? "-" : l.rent }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">List Price:</td>
                  <td width="140" height="35"> {{ l.listPrice == 00 ? "-" : l.listPrice }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Annual Sales:</td>
                  <td width="140" height="35"> {{ l.annualSales == 00 ? "-" : l.annualSales }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Inventory:</td>
                  <td width="140" height="35"> {{ l.inventory == 00 ? "-" : l.inventory }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Gross Income.:</td>
                  <td width="140" height="35"> {{ l.grossIncome == 00 ? "-" : l.grossIncome }} </td>
                  </tr>
                  <tr>
                  <td width="130" height="35" class="listinghl">Year Established:</td>
                  <td width="140" height="35"> {{ l.yearEstablished }} </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>                            
            
          <div class="listingtxt">
            <p ng-bind-html="l.description | unsafe" ></p>
          </div>
        </div>
            </div>
         <!-- START FOOTER --> 
<div class="sub-overlay hide"></div>
<div class="overlay hide" >
    <div id="alert"></div>
    <form id="enquiry" name="enquiry" method="post" action="">
        <div class="box">
        <h3 id="formTitle">Contact Form: {{ list.current_listing.title }}</h3>
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
        <input name="title" value="{{list.current_listing.title}}" type="hidden">
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
    <li><a href="services_sell.html">Sell a Business  </a></li>
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
<script src="/js/angular.min.js"></script>
<script src="/js/angular-sanitize.min.js"></script>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/my-ng.js"></script>
<script type="text/javascript" src="http://eaglebusinessbrokers.com/js/quickform.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        var url = window.location.origin;
        $("#contactFoot").on("click touch", function(e){
            e.preventDefault();
            $("#formTitle").text("Contact Form");
            $(".overlay, .sub-overlay").removeClass("hide");
        });
        $(".sub-overlay").on("click touch", function(e){
            e.preventDefault();
            $(".sub-overlay, .overlay").addClass("hide");
            $("#enquiry").find("input[type=text], textarea").val("");
            $("#alert").empty();
            $("#enquiry").removeClass("hide");
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
                            $("#alert").empty();
                            $("#enquiry").removeClass("hide");
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

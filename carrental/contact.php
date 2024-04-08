<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Biluthyrningsportal</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Libraries CSS Files -->
 
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <style>

    #form_status span {
      color: #fff;
      font-size: 14px;
      font-weight: normal;
      background: #E74C3C;
      width: 100%;
      text-align: center;
      display: inline-block;
      padding: 10px 0px;
      border-radius: 3px;
      margin-bottom: 18px;
    }

    #form_status span.loading {
      color: #333;
      background: #eee;
      border-radius: 3px;
      padding: 18px 0px;
    }

    #form_status span.notice {
      color: yellow;
    }

    #form_status .success {
      color: #fff;
      text-align: center;
      background: #2ecc71;
      border-radius: 3px;
      padding: 30px 0px;
    }

    #form_status .success i {
      color: #fff;
      font-size: 45px;
      margin-bottom: 14px;
    }

    #form_status .success h3 {
      color: #fff;
      margin-bottom: 10px;
    }
  </style> 
</head>

<body id="body"> 
 <?php include('includes/header.php');?>
 <section id="innerBanner"> 
  <div class="inner-content">
    <h2><span>Kontakt</span><br>Vi förenklar din resa!</h2>
    <div> 
    </div>
  </div> 
</section><!-- #Page Banner -->

<main id="main">


    <!--==========================
      Contact Section
      ============================-->
      <section id="contact" class="wow fadeInUp">
        <div class="container">
          <div class="section-header"> 
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt fugiat culpa esse aute nulla. malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
          </div>

          <div class="row contact-info">
           <div class="col-lg-5"> 
            <div class="contact-address" >
              <i class="ion-ios-location-outline " style="float: left;"></i>
              <h3 style="float: left;">Adress</h3>
              <address >svärdsliljegatan 13a </address>
            </div> 
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"style="float: left;" ></i>
              <h3 style="float: left;">Telefonnummer</h3>
              <p><a href="tel:+155895548855">021 982208</a></p>
            </div> 
            <div class="contact-email">
              <i class="ion-ios-email-outline" style="float: left;"></i>
              <h3 style="float: left;">E-post</h3>
              <p><a href="mailto:info@example.com">Paketplus8@gmail.com</a></p>
            </div> 
          </div>
          <div class="col-lg-7">
            <div class="container">
              <div id="form_status"></div>
              <div class=" contact-form"> 
                <!-- Form itself -->
                <form  method="post" class="" id="fruitkha-contact" onSubmit="return valid_datas( this );"> 
                  <div class="row">
                    <div class="col-md-6 control-group">
                      <div class="form-group">
                        <input type="text" class="form-control" 
                        placeholder="Name" name="name" id="name" />
                        <p class="help-block"></p>
                      </div>
                    </div>  
                    <div class="col-md-6 form-group">
                      <div class="controls">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                      </div>
                    </div> 
                  </div>
                  <div class="row">
                    <div class=" col-md-6 control-group">
                      <div class="form-group">
                        <input type="tel" class="form-control" 
                        placeholder="Phone" name="phone" id="phone" />
                        <p class="help-block"></p>
                      </div>
                    </div>  
                    <div class="col-md-6 control-group">
                      <div class="form-group">
                        <input type="text" class="form-control" 
                        placeholder="Subject" name="subject" id="subject"/>
                        <p class="help-block"></p>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                   <div class="controls">
                     <textarea rows="10" cols="100" class="form-control" 
                     placeholder="Message" id="message" name="message"  style="resize:none"></textarea>
                   </div>
                 </div> 
                 <input type="hidden" name="token" value="FsWga4&@f6aw" />
                 <button type="submit" class="btn btn-primary pull-right">Skicka</button><br />
               </form>
             </div>

           </div>
         </div>
       </div>
     </div>
   </section><!-- #contact -->

 </main>
 <?php include('includes/footer.php');?><!-- #footer -->

 <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

 <!-- JavaScript  -->
 <script src="lib/jquery/jquery.min.js"></script>
 <script src="lib/jquery/jquery-migrate.min.js"></script>
 <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="lib/easing/easing.min.js"></script>
 <script src="lib/superfish/hoverIntent.js"></script>
 <script src="lib/superfish/superfish.min.js"></script>
 <script src="lib/wow/wow.min.js"></script>
 <script src="lib/owlcarousel/owl.carousel.min.js"></script>
 <script src="lib/magnific-popup/magnific-popup.min.js"></script>
 <script src="lib/sticky/sticky.js"></script> 
 <script src="contact/jqBootstrapValidation.js"></script>
 <script src="contact/contact_me.js"></script>
 <script src="js/main.js"></script>
 <script src="assets/js/form-validate.js"></script>

</body>
</html>

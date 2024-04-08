<?php
session_start();
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{

  if(isset($_POST['updateprofile']))
  {
    $name=$_POST['fullname'];
    $mobileno=$_POST['mobilenumber'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $adress=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $email=$_SESSION['login'];
    $sql="update tblusers set FullName=:name,ContactNo=:mobileno,dob=:dob,Address=:adress,City=:city,Country=:country where EmailId=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
    $query->bindParam(':dob',$dob,PDO::PARAM_STR);
    $query->bindParam(':adress',$adress,PDO::PARAM_STR);
    $query->bindParam(':city',$city,PDO::PARAM_STR);
    $query->bindParam(':country',$country,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $msg="Profile Updated Successfully";
  }
  if(isset($_POST['submit']))
  {
    $useremail=$_SESSION['email'];
    $bookingno=mt_rand(100000000, 999999999);
    $bookingdate=date('Y/m/d');
    $status=0;
    $vhid=intval($_GET['carid']);
    $sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,Status,BookingNumber) VALUES(:useremail,:vhid,:fromdate,:status,:bookingno)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
    $query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
    $query->bindParam(':fromdate',$bookingdate,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {

      // Load Composer's autoloader
      require 'vendor/autoload.php';
      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      $name = $_SESSION['name'];
      $from = $_SESSION['email'];
      $phone = $_SESSION['phone'];
      $carname=$_SESSION['carname'];
      $price=$_SESSION['price'];
      $subject = stripslashes( nl2br( 'New Transaction from car sales system' ) );
      //$message = stripslashes( nl2br( '' ) );

      try {

        //Server settings
        $mail->SMTPDebug = 0;  // 0 - Disable Debugging, 2 - Responses received from the server
        $mail->isSMTP();    // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;     // Enable SMTP authentication
        $mail->Username   = 'geraldarinaitwe123@gmail.com'; // SMTP username
        $mail->Password   = 'cometome'; // SMTP password
        $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465; // TCP port to connect to

        //Recipients
        $mail->setFrom($from, 'Car Sales website');
        
        $mail->addAddress('compscie95@gmail.com', 'Car sale Admin');     // Add a recipient

        // Attachement 
        // $mail->addAttachment('upload/file.pdf');
        //$mail->addAttachment('assets/img/products/product-img-1.jpg', 'fruit');    // Optional name

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        ob_start();
        ?>
        Hej General Manager!<br /><br />
        <?php echo ucfirst( $name ); ?>  har köpt bil via din hemsida!
        <br /><br />

        Name: <?php echo ucfirst( $name ); ?><br />
        Email: <?php echo $from; ?><br />
        Phone: <?php echo $phone; ?><br />
        Subject: <?php echo $subject; ?><br />
        Message: <br /><br />
        <?php echo $name; ?> köpt <?php echo $carname; ?> at SEK <?php echo $price; ?> och är fullt betald. 
        <br />
        <br />
        ============================================================
        <?php
        $body = ob_get_contents();
        ob_end_clean();
        $mail->Body = $body;
        $mail->AltBody = $body; // Plain text for non-HTML mail clients

        $s = $mail->send();
        // if( $s == 1 ){
        //   echo '<div class="success" ><i class="fa fa-check-circle"></i><h3>Thank You!</h3>Your message has been sent successfully.</div>';
        // }else{
        //   echo '<div>Your message sending failed!</div>';
        // }
      } catch (Exception $e) {
      } 
      echo "<script>alert('betald framgångsrikt är ditt, fakturanummer $bookingno, vi ringer dig inom kort.');</script>"; 

      echo "<script type='text/javascript'> document.location = 'my_booking.php'; </script>";
    }
    else 
    {
      echo "<script>alert('Något gick fel. Var god försök igen');</script>";
      echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
    }
  }

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
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet"> 
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
    </style>

  </head>

  <body id="body"> 
   <?php include('includes/header.php');?>
   <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>Köp med bästa pris</span><br>Köp din drömbil!</h2>
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
            <div class="col-lg-6">
              <h3>Produktinformation</h3>
              <table border="1" class="table table-striped table-bordered first" >
                <tr>
                  <th>No.</th>
                  <th>varumärke</th>
                  <th>Bil Namn</th>
                  <th>Pris </th>
                </tr>
                <tr>
                 <?php 
                 $carid=intval($_GET['carid']);
                 $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:carid";
                 $query = $dbh -> prepare($sql);
                 $query->bindParam(':carid',$carid, PDO::PARAM_STR);
                 $query->execute();
                 $results=$query->fetchAll(PDO::FETCH_OBJ);
                 $cnt=1;
                 if($query->rowCount() > 0)
                 {
                  foreach($results as $result)
                  {  
                    $_SESSION['brndid']=$result->bid;
                    $_SESSION['carname']=$result->VehiclesTitle;
                    $_SESSION['price']=$result->PricePerDay;
                    ?>
                    <td>1</td>
                    <td><?php echo htmlentities($result->BrandName);?></td>
                    <td><?php echo htmlentities($result->VehiclesTitle);?></td>
                    <td><span>SEK</span><?php echo htmlentities($result->PricePerDay);?></td>
                    <?php
                  }
                }?>
              </tr> 
            </table>
            <h3>Fakturaadress</h3>
            <?php 
            $useremail=$_SESSION['login'];
            $sql = "SELECT * from tblusers where EmailId=:useremail";
            $query = $dbh -> prepare($sql);
            $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              { 
                $_SESSION['email']=$result->EmailId;
                $_SESSION['name']=$result->FullName;
                $_SESSION['phone']=$result->ContactNo;
                ?>
                <form  method="post" class="well"  validate> 
                  <?php  
                  if($msg)
                  {
                    ?>
                    <div class="succWrap">
                      <strong>FRAMGÅNG</strong>:<?php echo htmlentities($msg); ?> 
                    </div>
                    <?php
                  }?>
                  <div class="control-group ">
                    <div class="form-group">
                      <input type="text" class="form-control" name="fullname" value="<?php echo htmlentities($result->FullName);?>" id="fullname"required />
                      <p class="help-block"></p>
                    </div>
                  </div>   
                  <div class="control-group ">
                    <div class="form-group">
                      <input type="email" class="form-control" name="emailid"
                      value="<?php echo htmlentities($result->EmailId);?>" id="email" required
                      />
                      <p class="help-block"></p>
                    </div>
                  </div>   
                  <div class="form-group">
                    <div class="controls">
                      <input type="tel" class="form-control" name="mobilenumber" value="<?php echo htmlentities($result->ContactNo);?>" required
                      />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <input type="text" class="form-control" placeholder=" Enter city" id="city" name="city" value="<?php echo htmlentities($result->City);?>"  required
                      />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <input type="text" class="form-control" placeholder="Enter country" id="country" name="country" value="<?php echo htmlentities($result->Country);?>" required
                      />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <textarea rows="5" cols="50" class="form-control" 
                      placeholder="Billing address" name="address" id="message" required
                      data-validation-required-message="Please enter your message" minlength="5" 
                      data-validation-minlength-message="Min 5 characters" 
                      maxlength="999" style="resize:none"><?php echo htmlentities($result->Address);?></textarea>
                    </div>
                  </div>      
                  <div id="success"> </div> <!-- For success/fail messages -->
                  <button type="submit" name="updateprofile" class="btn btn-primary pull-right mb-3">Uppdatering</button><br />
                </form>
                <?php 
              }
            } ?>
          </div>
          <div class="col-lg-6" style="background-color: #E5E4E2;">
            <div class="container" >
              <div class="mt-4" >
                <img src="img/paypal.jpg" alt="image" width="430px;" height="120px;">
              </div>
              <div class="form mt-4"> 
                <!-- Form itself -->
                <form  method="post" class="well"  validate> 
                  <div class="control-group">
                    <div class="form-group">
                      <input type="text" class="form-control" 
                      placeholder="Valid Card Number" id="card" required
                      data-validation-required-message="Please enter your name" /></span>
                      <p class="help-block"></p>
                    </div>
                  </div> 	
                  <div class="form-group">
                    <div class="controls">
                      <input type="tel" class="form-control" placeholder="MM / YY" 
                      id="email" required />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="controls">
                      <input type="tel" class="form-control" placeholder="CVC Code" 
                      id="email" required />
                    </div>
                  </div> 	


                </div> 		 
                <div id="success"> </div> <!-- For success/fail messages -->
                <button type="submit" name="submit" class="btn btn-primary pull-right mb-2">Bekräfta betalning</button><br />
              </form>
              <div class="mt-4 mb-3" >
                <img src="img/buycar6.jpg" alt="image" width="430px;" height="280px;">
              </div>
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

</body>
</html>
<?php 
} ?>
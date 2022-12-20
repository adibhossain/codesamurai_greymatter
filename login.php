<?php

session_start(); 

include "db_conn.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['acc_id']) && isset($_POST['password'])) {

      echo $_POST['acc_id'].'<br>';
      echo $_POST['password'].'<br>';
      function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      $acc_id = validate($_POST['acc_id']);
      $pass = validate($_POST['password']);
      echo $acc_id.'<br>';
      echo $pass.'<br>';

      if(empty($acc_id)) {
          header("Location: login.php?error=User Name is required");
          exit();
      }
      else if(empty($pass)) {
          header("Location: login.php?error=Password is required");
          exit();
      }
      else {
          $sql = "select acc_id,name FROM users WHERE acc_id='$acc_id' AND password='$pass'";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          if ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            $_SESSION['acc_id'] = $row['ACC_ID'];
            $_SESSION['name'] = $row['NAME'];
            header("Location: index.php");
            exit();
          }
          else {
            //header("Location: login.php?error=Incorect User name or password");
            exit();
          }
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />

    <link
    rel="stylesheet"
    href="New folder/style1.css"
    />

    <!-- favicon link css  -->
    <link rel="shortcut icon" type="image/png" href="assets/img/bdgov.png" />
    <link href="assets/css/style.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <title>Login Page</title>
    <style>
        body {
            background: #dfe7e9;
            font-family: 'Roboto', sans-serif;
        }
        .form-control {
            font-size: 16px;
            transition: all 0.4s;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #5cb85c;
        }
        .form-control, .btn {
            border-radius: 50px;
            outline: none !important;
        }
        .signup-form {
            width: 480px;
            margin: 0 auto;
            padding: 30px 0;
        }
        .signup-form form {
            border-radius: 5px;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }
        .signup-form a {
            color: #5cb85c;
        }    
        .signup-form h2 {
            text-align: center;
            font-size: 34px;
            margin: 10px 0 15px;
        }
        .signup-form .hint-text {
            color: #999;
            text-align: center;
            margin-bottom: 20px;
        }
        .signup-form .form-group {
            margin-bottom: 20px;
        }
        .signup-form .btn {        
            font-size: 18px;
            line-height: 26px;
            font-weight: bold;
            text-align: center;
        }
        .signup-btn {
            text-align: center;
            border-color: #5cb85c;
            transition: all 0.4s;
        }
        .signup-btn:hover {
            background: #5cb85c;
            opacity: 0.8;
        }
        .or-seperator {
            margin: 50px 0 15px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .or-seperator b {
            padding: 0 10px;
            width: 40px;
            height: 40px;
            font-size: 16px;
            text-align: center;
            line-height: 40px;
            background: #fff;
            display: inline-block;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            top: -22px;
            z-index: 1;
        }
        .social-btn .btn {
            color: #fff;
            margin: 10px 0 0 15px;
            font-size: 15px;
            border-radius: 50px;
            font-weight: normal;
            border: none;
            transition: all 0.4s;
        }	
        .social-btn .btn:first-child {
            margin-left: 0;
        }
        .social-btn .btn:hover {
            opacity: 0.8;
        }
        .social-btn .btn-primary {
            background: #507cc0;
        }
        .social-btn .btn-info {
            background: #64ccf1;
        }
        .social-btn .btn-danger {
            background: #df4930;
        }
        .social-btn .btn i {
            float: left;
            margin: 3px 10px;
            font-size: 20px;
        }
        </style>

        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  </head>
  <body>
    <!-- navbar starts -->
    <div id="nav-placeholder"></div>
    <script> $(function(){ $("#nav-placeholder").load("navbar.php"); }); </script>
    <!-- navbar ends -->


        <div class="signup-form">
            
                <h2>Log in to your account</h2>
                <p class="hint-text">Enter your email and password bellow:</p>
                <div class="social-btn text-center">
                    <form action="" method="POST">
                      <input type="text" id="acc_id" name="acc_id" placeholder="Enter your email">
                      <input type="password" id="password" name="password" placeholder="Password">
                      <br>
                      <button type="submit" class="btn btn-warning btn-lg">Log In</button>
                    </form>
                    <br>
                    <br>
                    <a type="button" class="btn btn-info" href="signup.php">Don't have an account? Click here to Signup!</a>
                    <br>
                    <a type="button" class="btn btn-info" href="#">Forgot Password?</a>
                </div>
                <br> 
                <br>
        </div>

      <!-- footer -->
      <!-- footer -->

      <div class="container-fluid bg-black py-2 mt-5">
        <div class="row">
          <div class="col-md-4 col-12 pt-3">
            <p class="text-white-50 text-center">
              © 2022 CodeSamurai. All rights reserved
            </p>
            <p></p>
          </div>

          <div class="col-md-4 col-12 pt-3">
            <p class="text-white-50 text-center">
              <i class="bi bi-telephone"></i>+880 176 902 3806
            </p>
          </div>
          <div class="col-md-4 col-12 pt-3">
            <p class="text-white-50 text-center">
              <i class="bi bi-envelope"></i> info@codesamurai.net
            </p>
          </div>
        </div>
      </div>

      <!-- footer -->
    </div>

    <!-- Back to top button -->
    <button type="button" class="btn btn-success btn-floating" id="btn-back-to-top">
      <i class="fas fa-arrow-up"></i>
    </button>

    <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>

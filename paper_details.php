<?php
session_start();

 include 'db_conn.php';
 $researchID=$_GET['id'];
echo $researchID;



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

    <!-- custom css  -->
    <!-- <link rel="stylesheet" href="projectstyle.css" /> -->

    <!-- font awesome css  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
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

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <title>Project Details</title>
  </head>
  <body>
    <!-- navbar starts -->
    <div id="nav-placeholder"></div>
    <script> $(function(){ $("#nav-placeholder").load("navbar.php"); }); </script>
     <!--navbar ends -->

    <!-- middle part starts -->
    <div class="bg-light">
      <!-- firstcontainer starts  
    if( $row['PAPER_TYPE']='Conference' $sql = "select * from Research R , conference_paper C  where R.Research_id = '$researchID' AND C.Research_id=R.Research_id ";)
  -->
  
      <?php
      
   
      $sql = "select * from Research  where Research_id = '$researchID'";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
      
      while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
        {

    echo'

    <div class="container pt-5">
    <div class="bg-white border border-success border-3 p-5 mt-3">
    <h1>Project Title: ' . 'Uttar Khashayir Government Primary School' . '</h1>
    <h5 class="mt-5">Location :
    <h5 class="mt-5">Cost :
    <h5 class="mt-5">Timespan :'; 

    $sql = "select * from Research_Area where Research_id = '$researchID'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $count=1;
    while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
      {
        if($count==1) echo '';
        else echo'  ,
        '. '' .' 
        ';
       $count++;
      
      
      }
    
    echo '
    </h5><br>
          <h5>Goal :</h5>
          <p> 
           ' . 'Extending education facilities to the neighborhood' .'
          </p>
        </div>
      </div>
      <!-- firstcontainer ends -->


      <!-- secondcontainer starts  -->

      <div class="container pt-3">
      <div class="row border bg-white m-0">
        

        <!-- left part starts  -->
        <div class="col-4  p-3 ">
        
        <div class="info-card p-3 border border-2 border-success m-3">
                <h4>Executing Agency</h4>
                <p>' . 'MOEDU' . '</p>
            </div>
  
            <div class="info-card p-2 border border-2 border-success m-3">
              <h4>Start Date</h4>
              <p>' . '1/2/2023' . '</p>
            </div>

            <div class="info-card p-3 border border-2 border-success m-3">
              <h4>Actual Cost To Date</h4>
              <p>' . '0' . '</p>
            </div>

          </div>
  
  
            
  
            
            
            <!-- left parts ends  -->

         


      

          <!-- right parts starts  -->
          <div class=" col-8 p-4 pt-4 main-content">

            <div class="info-detail mt-3 mb-1">
              <h3 class="mb-2">Completion</h3>
              <div class="d-flex align-items-center pt-3">
              <div class="progress" style="width: 800px">
              <div class="progress-bar bg-success" role="progressbar" style="width: '.'50'.'%; " aria-valuenow=" ' . '50' .';" aria-valuemin="0" aria-valuemax=" ' . '100' .'">'. '50' .'  / '. '100' .' </div>
          </div>
                 
              </div>
            </div>




            
            <h3 class="mb-3 mt-5">Component Details</h3>
            <div class="container ps-2 pe-2">
            <div class="row">
            ';
          

            
          


               
          


            
  
  


          


       }
       
      ?>


          
          

      
                
      </div>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br><br><br>
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
    </div>

    <!-- footer ends -->

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

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
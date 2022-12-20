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
    <link rel="shortcut icon" type="image/png" href="img/MIST.png" />
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

    <title>Paper Details</title>
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
    <h1>Paper Title: ' . $row['PAPER_TITLE'] . '</h1>
    <h5 class="mt-5">Paper Area :'; 

    $sql = "select * from Research_Area where Research_id = '$researchID'";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $count=1;
    while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
      {
        if($count==1) echo $row1['RESEARCH_AREA'];
        else echo'  ,
        '.$row1['RESEARCH_AREA'] .' 
        ';
       $count++;
      
      
      }
    
    echo '
    </h5><br>
          <h5>Paper synopsis :</h5>
          <p> 
           ' . $row['PAPER_ABSTRACT'] .'
          </p>
        </div>
      </div>
      <!-- firstcontainer ends -->


      <!-- secondcontainer starts  -->

      <div class="container pt-3">
      <div class="row border bg-white m-0">
        

        <!-- left part starts  -->
        <div class="col-12 col-md-4 side-nav p-3 ">
        
        ';

        if( $row['PAPER_TYPE']='Conference'){
 
          
          $sql = "select * from Research R , conference_paper C  where R.Research_id = '$researchID' AND C.Research_id=R.Research_id ";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
            {
           
              echo '
  
            <div class="info-card p-3 border border-2 border-success m-3">
                <h4>Publishers</h4>
                <p>' .$row1['PUBLISHER']. '</p>
            </div>
  
            <div class="info-card p-3 border border-2 border-success m-3">
              <h4>Conference Name</h4>
              <p>' .$row1['CONFERENCE_NAME']. '</p>
            </div>
  
            <div class="info-card p-2 border border-2 border-success m-3">
              <h4>Type of Paper </h4>
              <p>' .$row1['TYPE_OF_PAPER']. '</p>
            </div>
  
            <div class="info-card p-2 border border-2 border-success m-3">
            <h4>DOI </h4>
            <p>' .$row1['DOI']. '</p>
          </div>
  
  
            
  
            <div class="info-card p-2 m-3">
                <a class="btn btn-success" id="reqfund" type="button" href="request_fund.html">Request Fund</a>
              </div>
  
          
       
          ';
            }
          }
          if( $row['PAPER_TYPE']='Journal'){
            $sql = "select * from Research R , journal_paper C  where R.Research_id = '$researchID' AND C.Research_id=R.Research_id ";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
              {
             
                echo '
    
              <div class="info-card p-3 border border-2 border-success m-3">
                  <h4>Publishers</h4>
                  <p>' .$row1['PUBLISHER']. '</p>
              </div>
    
              <div class="info-card p-3 border border-2 border-success m-3">
              <h4>JOURNAL NAME Name</h4>
              <p>' .$row1['JOURNAL_NAME']. '</p>
            </div>
  
            <div class="info-card p-2 border border-2 border-success m-3">
              <h4>SJR RATING </h4>
              <p>' .$row1['SJR_RATING']. '</p>
            </div>
  
            <div class="info-card p-2 border border-2 border-success m-3">
            <h4>ISSN</h4>
            <p>' .$row1['ISSN']. '</p>
          </div>
    
    
              
    
              <div class="info-card p-2 m-3">
                  <a class="btn btn-success" id="reqfund" type="button" href="request_fund.html">Request Fund</a>
                </div>
    
           
            ';
              }
            }

            echo'
            </div>
            <!-- left parts ends  -->

         


      

          <!-- right parts starts  -->
          <div class="col-md-8 col-12 p-4 pt-4 main-content">

            <div class="info-detail mt-3 mb-1">
              <h3 class="mb-2">Paper Link</h3>
              <div class="d-flex align-items-center pt-3">
                <a href=" '. $row['PAPER_LINK'].' " class="link-button btn btn-dark btn-sm p-3">
                  <i class="fa fa-globe"></i> Paper Link</a>
                 
              </div>
            </div>




            
            <h3 class="mb-3 mt-5">Authors</h3>
            <div class="container ps-2 pe-2">
            <div class="row">
            ';
          

            
          $sql = "select * from Research R , Faculty_Research FR , FACULTY F , USER_INFO_VIEW U  where R.Research_id = '$researchID' AND FR.Research_id=R.Research_id AND F.FACULTY_ID=FR.FACULTY_ID AND U.ACC_ID=F.ACC_ID";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
            {
           
              echo '
         
                <div class="col-md-3 col-6 py-4 border border-success border-2 m-3 ">
                  <img
                     style="width: 60%;" class="mx-auto d-block"
                    src="https://faces-img.xcdn.link/image-lorem-face-6688.jpg"
                    alt=""
                  />
                  <h5 class="mt-3 text-center">'. $row1['NAME'] .'</h5>
                  <p class="m-0 text-center"> '. $row1['DESIGNATION'] .'</p>
                  <p class="m-0 text-center">'. $row1['FACULTY_ID'] .'</p>
                </div>
                
             
              ';

            }


               
          $sql = "select * from Research R , Student_Research SR , STUDENT S , USER_INFO_VIEW U  where R.Research_id = '$researchID' AND SR.Research_id=R.Research_id AND S.STUDENT_ID=SR.STUDENT_ID AND U.ACC_ID=S.ACC_ID";
          $stid = oci_parse($conn, $sql);
          $r = oci_execute($stid);
          while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
            {
           
              echo '
         
                <div class="col-md-3 col-6 py-4 border border-success border-2 m-3 ">
                  <img
                     style="width: 60%;" class="mx-auto d-block"
                    src="https://faces-img.xcdn.link/image-lorem-face-6688.jpg"
                    alt=""
                  />
                  <h5 class="mt-3 text-center">'. $row1['NAME'] .'</h5>
                  <p class="m-0 text-center"> '. $row1['DEPARTMENT'] .'</p>
                  <p class="m-0 text-center">'. $row1['STUDENT_ID'] .'</p>
                </div>
                
             
              ';

            }


            $sql = "select * from Research R , Alumni_Research AR , Alumni A , USER_INFO_VIEW U  where R.Research_id = '$researchID' AND AR.Research_id=R.Research_id AND A.STUDENT_ID=AR.STUDENT_ID AND U.ACC_ID=A.ACC_ID";
            $stid = oci_parse($conn, $sql);
            $r = oci_execute($stid);
            while ($row1 = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
              {
             
                echo '
           
                  <div class="col-md-3 col-6 py-4 border border-success border-2 m-3 ">
                    <img
                       style="width: 60%;" class="mx-auto d-block"
                      src="https://faces-img.xcdn.link/image-lorem-face-6688.jpg"
                      alt=""
                    />
                    <h5 class="mt-3 text-center">'. $row1['NAME'] .'</h5>
                    <p class="m-0 text-center"> '. $row1['BATCH'] .'</p>
                    <p class="m-0 text-center">'. $row1['STUDENT_ID'] .'</p>
                  </div>
                  
               
                ';
  
              }
  
  


          echo

           '
      
           </div>
           </div>
          

            <div class="info-detail mt-3">
                <h3 class="mb-3">References</h3>
                <div
                  class="border d-flex align-items-center p-3 text-black text-wrap border-2 border-success p-2"
                >
                  <p class="m-0">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Accusantium amet error cupiditate? Impedit, incidunt. Quo,
                    dolores dolore assumenda officiis voluptatum molestias
                    corrupti iure odit ullam omnis quaerat quidem tenetur totam
                    soluta saepe a explicabo dicta quisquam, provident, iste
                    deserunt. Minus.
                    <!-- • (7.4 mb) -->
                  </p>
                  <!-- <a href="#" class="ms-auto inline-block btn btn-success"
                    >Download <i class="fa fa-download"></i
                  ></a> -->
                </div>
            </div>

            <div class="info-detail mt-3">
                <h3 class="mb-3">Conferences</h3>
                <div
                  class="border d-flex align-items-center p-3 text-black text-wrap border-2 border-success p-2"
                >
                  <p class="m-0">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Accusantium amet error cupiditate? Impedit, incidunt. Quo,
                    <!-- • (7.4 mb) -->
                  </p>
                  <!-- <a href="#" class="ms-auto inline-block btn btn-success"
                    >Download <i class="fa fa-download"></i
                  ></a> -->
                </div>
            </div>

         </div>
        </div>

          <!-- right parts ends  -->
        </div>
        </div>
      <!-- second container ends  -->


    ';


       }
       
      ?>


          
          

      
                
      

      <!-- footer -->

      <div class="container-fluid bg-black py-2 mt-5">
        <div class="row">
          <div class="col-md-4 col-12 pt-3">
            <p class="text-white-50 text-center">
              © 2022 MIST. All rights reserved
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
              <i class="bi bi-envelope"></i> info@mist.ac.bd
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
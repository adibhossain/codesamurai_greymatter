<?php
session_start();
  include 'db_conn.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    if(isset($_POST['submit'])) {
     
      $name = $_POST['AlumniName'];
      $id = $_POST['AlumniID'];
      $dept = $_POST['Department'];
      $enrolldate = $_POST['EnrollDate'];
      $graddate = $_POST['AdmitDate'];
      $no_of_attended_conferences = $_POST['no_of_attended_conferences'];
      $no_of_researches = "6";
      $cj = $_POST['CurrentJob'];
      $phone = $_POST['PhoneNumber'];
      $email = $_POST['email'];
      $batch = $_POST['batch'];
      $experience = $_POST['exp'];
      $password=$_POST['password'];
      $institution = "Military Institute of Science and Technology";

      $res_int = "";
      $cnt=0;
      if(isset($_POST['resint'])){
        foreach($_POST['resint'] as $selected){
            if($cnt==0) $res_int = $selected;
            else $res_int .= ','.$selected;
            $cnt = $cnt+1;
            };
      };

      $sql = "
      insert into users (ACC_ID,NAME, CONTACT,PASSWORD,DEPARTMENT,RESEARCH_INTEREST,NUMBER_OF_RESEARCHES,ATTENDED_CONFERENCE)
      VALUES ('A_' || per_user_sq.NEXTVAL,'$name',CONTACT('$email','$phone'),'$password','$dept','$res_int','$no_of_researches','$no_of_attended_conferences')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);

      $sql = "
      insert into ALUMNI (STUDENT_ID ,ACC_ID,CURRENT_JOB, ENROLL_YEAR, BATCH, GRAD_YEAR,EXPERIENCES )
      VALUES ('$id','A_' || per_user_sq.CURRVAL,'$cj',TO_DATE('$enrolldate','DD/MM/YYYY'),'$batch',TO_DATE('$graddate','DD/MM/YYYY'),'$experience')";
      $stid = oci_parse($conn, $sql);
      $r = oci_execute($stid);
    }
   }
?>





<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta
  name="viewport"
  content="width=device-width, initial-scale=1, maximum-scale=1"
/>

<title>Signup Form</title>

<!-- BOOTSTRAP CSS -->
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />




    
 <!-- Vendor CSS Files -->
 <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
 <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
 <link href="assets/vendor/aos/aos.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
 <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
 <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
 <link
 rel="stylesheet"
 href="New folder/style1.css"
 />

 <!-- favicon link css  -->
 <link rel="shortcut icon" type="image/png" href="assets/img/bdgov.png" />
 <link href="assets/css/style.css" rel="stylesheet">

 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">



<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body >



<!-- navbar starts -->
<div id="nav-placeholder"></div>
<script> $(function(){ $("#nav-placeholder").load("navbar.php"); }); </script> 
<!-- navbar ends-->

<div class="bg-light" >
  <div class="container" style="padding: 10px 10px 0px 0px;">
    <h2 style="text-align: left"><b>Sign Up Form:</b></h2>
  </div>
  <div class="container mt-5">
  <form class="row g-3 bg-white border p-3 border-1" style="border-radius: 5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" action="" method="POST">      
      
      <div class="col-md-6">
        <label for="AlumniName" class="form-label">
        <h6>Name<font color="ff0000">*</font></h6>
        </label>
        <input type="text" required class="form-control" name="AlumniName" id="AlumniName" />
      </div>
      
      <div class="col-md-6">
        <label for="AlumniID" class="form-label">
        <h6>NID<font color="ff0000">*</font></h6>
        </label>
        <input type="text" required class="form-control" name="AlumniID" id="AlumniID" maxlength="9" minlength="9"/>
      </div>
      <div class="col-md-4">
        <label for="Department" class="form-label">
        <h6>Role<font color="ff0000">*</font></h6>
        </label>
        <br />
        <select class="form-control selectpicker" required name="Department">
          <option selected disabled>Role</option>
          <option value="SYSADMIN">System Admin</option>
          <option value="ECNEC">Executive Committee of the National Economic Council</option>
          <option value="MOP">Ministry of Planning</option>
          <option value="EXEC">Executing Agency User</option>
          <option value="APP">Application User</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="Department" class="form-label">
        <h6>Location<font color="ff0000">*</font></h6>
        </label>
        <br />
        <select class="form-control selectpicker" required name="Department">
          <option selected disabled>Location</option>
          <option value="SYSADMIN">Daudpur</option>
          <option value="ECNEC">Tarabo</option>
          <option value="MOP">Golakandail</option>
          <option value="EXEC">Murapara</option>
          <option value="APP">Bhulta</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="Department" class="form-label">
        <h6>Agency<font color="ff0000">*</font></h6>
        </label>
        <br />
        <select class="form-control selectpicker" name="Department">
          <option selected disabled>Agency</option>
          <option value="SYSADMIN">Local Government Engineering Department</option>
          <option value="ECNEC">Rural Development Academy</option>
          <option value="MOP">Bangladesh Water Development Board</option>
          <option value="MOP2">Bangladesh Power Development Board</option>
          <option value="MOP3">Bangladesh Telecommunication Regulatory Commission</option>
          <option value="MOP1">Bangladesh Rural Electrification Board</option>
          <option value="MOP4">Bangladesh Bridge Authority</option>
          <option value="MOP5">Bangladesh Public Works Department</option>
          <option value="MOP6">Local Government Division</option>
          <option value="EXEC">Ministry of Education</option>
          <option value="EXEC1">Ministry of Planning</option>
          <option value="APP">Executive Committee of the National Economic Council</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="PhoneNumber" class="form-label">
        <h6>Phone Number<font color="ff0000">*</font></h6>
        </label>
        <input type="text" required class="form-control" name="PhoneNumber" id="PhoneNumber" />
      </div>
      <div class="col-md-6">
        <label for="email">
          <h6>Email address<font color="ff0000">*</font></h6>
        </label>
        <input type="email" name="email" placeholder="Email" required  class="form-control input-lg"/>   
      </div>
      <div class="col-md-6">
        <label for="password">
        <h6>Password<font color="ff0000">*</font></h6>
        </label>
        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required />
      </div>
      <div class="col-md-6">
        <label for="confirmpassword">Confirm Password<font color="ff0000">*</font></label>
        <input type="text" style="-webkit-text-security: disc" class="form-control input-lg" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required />
        <div class="form-text confirm-message"></div>
      </div>
      <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

<!-- footer -->

<div class="container-fluid bg-black py-2 mt-5">
  <div class="row">
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> © 2022 CodeSamurai. All rights reserved </p>
      <p></p>
    </div>
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> <i class="bi bi-telephone"></i>+880 176 902 3806 </p>
    </div>
    <div class="col-md-4 pt-3">
      <p class="text-white-50 text-center"> <i class="bi bi-envelope"></i> info@codesamurai.net </p>
    </div>
  </div>
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

</body>
</html>

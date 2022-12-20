<?php
session_start();
include 'db_conn.php';
$sortcomm = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
  if(isset($_GET['search'])) {
    $searcher = $_GET['searcher'];
    $sql = "
    CREATE OR REPLACE VIEW RESEARCH_VIEW
    (\"RESEARCH_ID\",\"APPROVE_STATUS\",\"PAPER_PDF\",\"PAPER_LINK\",\"PUBLISHER\",\"PAPER_TITLE\",\"PUBLISH_STATUS\",\"PAPER_ABSTRACT\",\"PAPER_TYPE\") 
    AS (SELECT * FROM RESEARCH WHERE LOWER(PAPER_TITLE) LIKE LOWER('%$searcher%'))";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    //echo $sql;
  }
  else if(isset($_GET['sortbyname'])) {
    $sortcomm='ORDER BY PAPER_TITLE';
  }
  else if(isset($_GET['sortbyawards'])) {
    $sql = "
    CREATE OR REPLACE VIEW RESEARCH_VIEW
      (\"RESEARCH_ID\",\"APPROVE_STATUS\",\"PAPER_TITLE\",\"PAPER_TYPE\",\"PUBLISHER\",\"PUBLISH_STATUS\",\"NO_OF_AWARDS\") 
      AS (SELECT RESEARCH_ID,APPROVE_STATUS,PAPER_TITLE,PAPER_TYPE,PUBLISHER,PUBLISH_STATUS,(SELECT COUNT(*) FROM AWARDS A WHERE A.RESEARCH_ID=R.RESEARCH_ID) AS \"NO_OF_AWARDS\" FROM RESEARCH R)";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    $sortcomm='ORDER BY NO_OF_AWARDS DESC';
  }
  else {
    $sql = "
    CREATE OR REPLACE VIEW RESEARCH_VIEW
      (\"RESEARCH_ID\",\"APPROVE_STATUS\",\"PAPER_PDF\",\"PAPER_LINK\",\"PUBLISHER\",\"PAPER_TITLE\",\"PUBLISH_STATUS\",\"PAPER_ABSTRACT\",\"PAPER_TYPE\") 
      AS (SELECT * FROM RESEARCH)";
    $stid = oci_parse($conn, $sql);
    $r = oci_execute($stid);
    //echo "bye";
  }
}
else {
  $sql = "
  CREATE OR REPLACE VIEW RESEARCH_VIEW
    (\"RESEARCH_ID\",\"APPROVE_STATUS\",\"PAPER_PDF\",\"PAPER_LINK\",\"PUBLISHER\",\"PAPER_TITLE\",\"PUBLISH_STATUS\",\"PAPER_ABSTRACT\",\"PAPER_TYPE\") 
    AS (SELECT * FROM RESEARCH)";
  $stid = oci_parse($conn, $sql);
  $r = oci_execute($stid);
  //echo "bye";
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

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <title>Project List</title>
  </head>
  <body>
    <!-- navbar starts -->
    <div id="nav-placeholder"></div>
    <script> $(function(){ $("#nav-placeholder").load("navbar.php"); }); </script>
    <!-- navbar ends -->

    <!-- papers -->
    <div class="container-flex">
      <div class="container px-4 pt-5">

        <!-- search bar -->
        <div class="row-gx-5">
          <div class="col-xxl-12 col-12 mb-5">
            <form action="" method="GET" id="search_form">
            <div class="input-group mx-auto" id="search-bar">
              <label class="btn btn-success" style="text-decoration: none;">Project Title</label>
              <input type="text" class="form-control border border-2  border-success" id="searcher" name="searcher" placeholder="Type to search..." aria-label="Type" aria-describedby="addon-wrapping" oninput="" onkeyup="if(event.key == 'Enter');">
              <button type="button" class="btn bg-transparent" style="margin-left: -40px; z-index: 100;" id="del-search" onclick="">
                  <i class="fa fa-times"></i>
              </button>
              <button class="btn btn-success" id="search" name="search" value="search" type="submit" onclick=""><i class="bi bi-search"></i></button>
            </div>
            </form>
          </div>
        </div>
        <!-- search bar ends -->

        <div class="row gx-5">
          <!-- LEFT BAR -->
          <div class="col-xxl-3 col-12 mb-5">

            <!-- sort by -->
            <form action="" method="GET" id="sort_form">
            <div class="p-3 border bg-white border border-3  border-success">
              <div class="dropdown">
                  <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Project Type
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton1"
                  >
                    <li>
                      <a class="dropdown-item" href="proposed_list.php">Proposed</a>
                    </li>
                      <a class="dropdown-item" href="#">Approved</a>
                    </li>
                  </ul>
              </div>
            </div>
            </form>

            <br>

            <!-- filters -->
            <div class="p-3 border bg-white border border-3  border-success">
              <h4 class="ps-2">Filter</h4>

              <div class="p-2 mt-3 border bg-white border border-2  border-success">
                <div class="dropdown" style="min-width: 500;">
                  <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Agency
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton1"
                  >
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Local Government Engineering Department
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Rural Development Academy
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Water Development Board
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Power Development Board
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Telecommunication Regulatory Commission
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Rural Electrification Board
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Bridge Authority
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bangladesh Public Works Department
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Local Government Division
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Ministry of Education
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Ministry of Planning
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Executive Committee of the National Economic Council
                      </label>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="p-2 mt-3 border bg-white border border-2  border-success">
                <div class="dropdown">
                  <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Location
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton1"
                  >
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        Daudpur
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Tarabo
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Golakandail
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Murapara
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                      Bhulta
                      </label>
                    </li>
                    <li class="px-2">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        Near Me
                      </label>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="p-2 mt-3 border bg-white border border-2  border-success">
                <div class="dropdown">
                  <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Sort By
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton1"
                  >
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyname" name="sortbyname" value="sortbyname">Rating</button>
                    </li>
                    <!-- onclick="document.getElementById('filter_form').submit();" -->
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards" name="sortbyawards" value="sortbyawards">No. of feedbacks</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards1" name="sortbyawards" value="sortbyawards1">Start Date</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards2" name="sortbyawards" value="sortbyawards2">End Date</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards3" name="sortbyawards" value="sortbyawards3">Timespan</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards4" name="sortbyawards" value="sortbyawards3">Completion</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards4" name="sortbyawards" value="sortbyawards3">Projected Cost</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="submit" id="sortbyawards4" name="sortbyawards" value="sortbyawards3">Expected Cost</button>
                    </li>
                  </ul>
                </div>
              </div>

              

              

            </div>
          </div>
          <!-- LEFT BAR ends -->
          <!-- Right BAR      <div class= "card-body bg-white" >-->
          <div class="col-xxl-9 col-12">
            <div class="card mb-2 border border-3  border-success">
              <h5 class="card-header text-white bg-success">Search Results</h5>



              <?php
                                $sql = "select * from RESEARCH_VIEW WHERE APPROVE_STATUS='Approved' $sortcomm";
                                $stid = oci_parse($conn, $sql);
                                $r = oci_execute($stid);
                                while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) 
                                {
                                echo '
                                
                              <div class="card-body bg-white">
                                <a
                                  href="paper_details.php?id='.$row['RESEARCH_ID'].'"
                                  class="text-decoration-none text-black"
                                  ><div class="p-3 mt-2 mb-2 border border border-2  border-success">
                                    <h4 class="mb-3"> 
                                      ' . "Project Title" .'
                
                                  </h4>
                                    <p class="m-0 p-2">
                                    <h6 class="inline-block">
                                        ' . "Location" . '
                                        </h6>
                                        <h6 class="d-inline-block">' . "Cost" . '</h6>
                                        <h6 class="inline-block">
                                        ' . "Timespan" . '
                                        </h6>
                                        <h6 class="inline-block">
                                        ' . "Start Date" . '
                                        </h6>
                                    </p>
                                  </div></a
                                >
                              </div>
                               
                                ';
                                }


              ?> 

              
            </div>
          </div>
          <!-- Right BAR ends -->
        </div>
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
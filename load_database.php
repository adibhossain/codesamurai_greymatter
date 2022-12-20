<?php

include 'db_conn.php';
$cnt = 0;
if (($open = fopen("projects.csv", "r")) !== FALSE)
{
    $latitude = []; $longitude = []; $location = [];
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
    {
        $cnt++;
        if($cnt==1) continue;
        $sql = "
        insert into PROJECTS (PROJECT_ID,NAME,COST,TIMESPAN,GOAL,LOCATION_NAME,CODE_A)
        VALUES ('$data[7]','$data[0]','$data[5]','$data[6]','$data[8]','$data[1]','$data[4]','$abst','$type')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        $sql = "
        insert into APPROVED_PROJECTS (ACTUAL_COST,START_DATE,COMPLETION,PROJECT_ID)
        VALUES ('$data[11]','$data[9]','$data[10]','$data[7]')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
        array_push($location,$data[1]);
        $latitude[$data[1]]=$data[2];
        $longitude[$data[1]]=$data[3];
    }
    array_unique($location);
    foreach ($location as $value) {
        $sql = "
        insert into LOCATIONS (LOCATION_NAME,LATITUDE,LONGITUDE)
        VALUES ('$value','$latitude[$value]','$longitude[$value]')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
    } 
    fclose($open);
}

$cnt = 0;
if (($open = fopen("proposals.csv", "r")) !== FALSE)
{
    $latitude = []; $longitude = []; $location = [];
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
    {
        $cnt++;
        if($cnt==1) continue;
        $sql = "
        insert into PROJECTS (PROJECT_ID,NAME,COST,TIMESPAN,GOAL,LOCATION_NAME,CODE_A)
        VALUES ('$data[7]','$data[0]','$data[5]','$data[6]','$data[8]','$data[1]','$data[4]','$abst','$type')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);

        $projected_start_date=0;
        $projected_end_date=0;
        // Algorithm to generate these here

        $sql = "
        insert into PROPOSALS (PROPOSAL_DATE,PROJECTED_START_DATE,PROJECTED_END_DATE)
        VALUES ('$data[9]','$projected_start_date','$projected_end_date')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);

        array_push($location,$data[1]);
        $latitude[$data[1]]=$data[2];
        $longitude[$data[1]]=$data[3];
    }
    array_unique($location);
    foreach ($location as $value) {
        $sql = "
        insert into LOCATIONS (LOCATION_NAME,LATITUDE,LONGITUDE)
        VALUES ('$value','$latitude[$value]','$longitude[$value]')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
    } 
    fclose($open);
}

$cnt = 0;
if (($open = fopen("agencies.csv", "r")) !== FALSE)
{
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
    {
        $cnt++;
        if($cnt==1) continue;
        $sql = "
        insert into AGENCIES (CODE_A,TYPE,DESCRIPTION,NAME)
        VALUES ('$data[0]','$data[2]','$data[3]','$data[1]')
        ";
        $stid = oci_parse($conn, $sql);
        $r = oci_execute($stid);
    }
    fclose($open);
}

?>
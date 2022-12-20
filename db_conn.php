<?php
$conn = oci_connect('id202014003', 'abcd1234', 'localhost/XE')
  or die(oci_error());
if (!$conn) {
  echo "Could Not Connect To The Database";
  die();
}
?>
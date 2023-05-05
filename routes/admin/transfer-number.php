<?php

require "db.php";


// ====================================
// # GET Request
// ====================================

$transfer_number = select("SELECT plat_trans_no FROM platform_transfar_numbers");

//------------------------------------
// # Getting instructors view
require "./views/admin/transfer_number.view.php";
//------------------------------------


// ====================================
// # POST Request
// ====================================

if ( $_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["save"]) ):

  $plat_trans_no = $_POST["transfer_number"];
  
  $transfer_number = select("SELECT plat_trans_no FROM platform_transfar_numbers");

  // checking if there is a platform transfer number on the database
  if ( $transfer_number ) {
    // update value of platform transfer number
    $query = 
    " UPDATE platform_transfar_numbers
      SET plat_trans_no = '$plat_trans_no'
    ";
  } else {
    // insert value of platform transfer number to the database
    $query = 
    " INSERT INTO platform_transfar_numbers (plat_trans_no)
      VALUES ('$plat_trans_no')";
  }  
  // executing query
  $sql->query($query);
  
  echo "<script> createAlertMessage('Platform Transfer Number added successfully.', 'success') </script>";
  echodie("<script> window.location.href = '/admin/transfer-number'</script>");
  
endif;


$sql->close();

?>
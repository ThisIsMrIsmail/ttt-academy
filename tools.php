<?php


// go to route function to handle routes
function goToRoute($route) {
  global $routes;
  if ( array_key_exists($route, $routes) ) {
    require __DIR__ . $routes[$route];
  } else {
    abort();
  }
}


// abort function for page not found
function abort($code=404) {
  http_response_code($code);
  require "views/404.php";
  die();
}


// select function to create select statement and reduce lines of code
function select ($query) {
  $sql = new mysqli(
    $_ENV["HOST"],
    $_ENV["USERNAME"],
    $_ENV["PASSWORD"],
    $_ENV["DATABASE_NAME"],
    $_ENV["PORT"]
  );
  $result = $sql->query($query);
  $output = [];
  for ($i=0; $i < $result->num_rows; $i++) { 
    array_push( $output, $result->fetch_assoc() );
  }
  return $output;
}

// echo and die function
function echodie($var) {
  if ( gettype($var) == "array")
    print_r($var);
  else
    print $var;
  die();
}


// upload file function
function upload_file($file, $file_type, $dirname, $id, $need_date=false) {
  // target saving directory
  $target_dir = "uploads/$dirname/$id/";
  // getting file extension
  $file_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
  // changing file name
  if ($file_type == "video") {
    $extension = "mp4";
  } else {
    $extension = "jpg";
  }
  $file["name"] = $file_type . "_$id." . $extension;

  // createing new date
  $date = date_format(date_create(), "y-m-d_h.m.s");
  if ( $need_date ) {
    $file["name"] = $file_type . "_{$id}_$date." . $extension;
  }

  // getting target file path + name
  $target_file = $target_dir . basename($file["name"]);
  // creating directory if not exists
  if ( ! file_exists($target_dir) ) {
    mkdir($target_dir);
  }
  // checking if the file already exists
  if ( file_exists($target_file) ) {
    unlink($target_file);
  }
  // checking if uploaded file extension is allowed
  if (
    $file_ext != "jpg" && $file_ext != "png" && $file_ext != "jpeg" &&
    $file_ext != "mp4"
  ) {
    echodie("<script>
    createAlertMessage('Sorry, uploaded $file_type file extension is not allowed!', 'failure')
    createAlertMessage('Sorry, your $file_type file was not uploaded!', 'failure')</script>");
  }
  // if everything is ok, try to upload file
  $is_uploaded = move_uploaded_file($file["tmp_name"], $target_file);
  if ( ! $is_uploaded ) {
    echodie("<script> createAlertMessage('Error uploading $file_type file.!', 'failure') </script>");
  }
  echo("<script> createAlertMessage('File Uploaded Successfully.!', 'success') </script>");
}


// delete directory function
function delete_dir($id, $dirname) {
  $del_dir = "uploads/$dirname/$id";
  if ( file_exists($del_dir) ) {
    // getting a list of all of the file names in the dir to delete.
    $files = glob($del_dir . "/*");
    // lopping through the file list.
    foreach($files as $file) {
      unlink($file);
    }
    rmdir($del_dir);
  }
}

?>
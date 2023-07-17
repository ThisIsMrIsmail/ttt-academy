<?php

session_unset();
session_destroy();
session_start();

// clearing localStorage (send and resend vf code)
echo "<script> sessionStorage.clear(); </script>";

exit(header("Location: /"));

?>
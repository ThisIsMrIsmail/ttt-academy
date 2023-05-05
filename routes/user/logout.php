<?php

session_destroy();
session_start();
exit(header("Location: /"));

?>
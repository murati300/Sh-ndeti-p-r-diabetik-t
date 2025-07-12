<?php
session_start();
session_unset();   // Pastron të gjitha variablat e sesionit
session_destroy(); // Shkatërron sesionin
header("Location: index.php"); // Ridrejton te faqja e login
exit();
?>

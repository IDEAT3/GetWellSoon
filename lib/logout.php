<?php
session_start();
session_unset();
if(session_destroy()) // Destroying All Sessions
{
session_write_close();
header("Location: ../index.php"); // Redirecting To Home Page
}
?>

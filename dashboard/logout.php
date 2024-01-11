<?php
 session_start();
 if(!$_SESSION["login"]){
   header("Location: ../index.html");
   die;
 }
 $_SESSION = [];
 session_unset();
 session_destroy();
 header("Location: ../index.html");
?>
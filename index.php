<?php
session_start();
if($_SESSION && $_SESSION["email"]) header("Location: website/blog.php");
header("Location: website/login_form.php")
?>
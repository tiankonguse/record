<?php
session_start();
$_SESSION['record_admin'] = "";
header('Location:index.php');
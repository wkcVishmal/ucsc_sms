<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="admin"){redirect_to("login.php");}
include_layout_template('header.php');
?>
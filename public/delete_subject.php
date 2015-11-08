<?php
    $id=$_GET['id'];
    //echo $id;
    
    require_once("../includes/initialize.php");
    if(!$session->is_logged_in()){redirect_to("login.php");}
    if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
    include_layout_template('header.php');

    $del=Subject::del_subject($id);
    if($del){
				echo '<script language="javascript">';
				echo 'alert("The subject has succesfully deleted !")';
				echo '</script>';
			}else{
					echo '<script language="javascript">';
				echo 'alert("error! The subject could not be deleted !")';
				echo '</script>';
				}
?>

    

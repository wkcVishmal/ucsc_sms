<?php
    $id=$_GET['id'];
    //echo $id;
    
    require_once("../includes/initialize.php");
    if(!$session->is_logged_in()){redirect_to("login.php");}
    if($_SESSION['privilege']!="admin"){redirect_to("login.php");}
    include_layout_template('header.php');

    $del=User::del_user($id);
    if($del){
				echo '<script language="javascript">';
				echo 'alert("The User has succesfully deleted !")';
				echo '</script>';
			}else{
					echo '<script language="javascript">';
				echo 'alert("error! The User could not be deleted !")';
				echo '</script>';
				}

?>

    

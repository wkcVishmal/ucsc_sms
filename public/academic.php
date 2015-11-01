<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
include_layout_template('header.php');
?>

			<table id="structure">
				<tr>
					<td id="navigation">
						<a href="view_students.php">- View students</a><br/><br/>
						<a href="change_pw.php">- Change password</a><br/><br/>
						
						<a href="logout.php">- Logout</a>
						<br/>
					</td>
					<td id="page">
						<h3>Academic and Publication</h3>
					</td>
					<td id="logindetails">
						<img src="user.jpg" style="width:150px;height:150px;">
						<?php
								print_r($_SESSION);
								echo $_SESSION['user_id'];
								echo $_SESSION['privilege'];
                        ?>
					</td>
				</tr>
			</table>
<?php require("layouts/footer.php");?>
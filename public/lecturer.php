<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
include_layout_template('header.php');
?>

			<table id="structure">
				<tr>
					<td id="navigation">
						<a href="view_lec_sub.php">- Enter exam Results</a><br/><br/>
						
						<a href="change_pw.php">- Change password</a><br/><br/>
						<a href="logout.php">- Logout</a>
						
						<br/>
					</td>
					<td id="page">
						<h3>Lecturer</h3>
					</td>
					<td id="logindetails">
						<img src="images/user.jpg" style="width:150px;height:150px;">
						<h4>Login Details</h4>
						<?php
								echo "You have logged in as: ";
								echo $session->privilege." user"."<br/><br/>";
								//print_r(User::find_by_id($session->user_id));
								$arr=User::find_by_id($session->user_id);
								echo "Name: ";
								echo $arr->name."<br/><br/>";
								echo "Staff_id:";
								echo $arr->staff_id."<br/><br/>";
								echo "email:";
								echo $arr->email."<br/>";
								
                        ?>
					</td>
				</tr>
			</table>
<?php require("layouts/footer.php");?>
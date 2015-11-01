<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
//if($_SESSION['privilege']!="admin"){redirect_to("login.php");}
include_layout_template('header.php');
?>


			<table id="structure">
				<tr>
					<td id="navigation">
						<a href = "home.php">Home</a><br/>
						<br/>
					</td>
					<td id="page">
						<h2>Create new user</h2>
						<?php //if(!empty($message)){echo "<p class=\"message\">".$message."</p>";} ?>
						 <?php// if(!empty($errors)){display_errors($errors);} ?>
						 <form id="user_form" action="new_user.php" method="post" >
							<table id="form2" width="100%">
								
								<tr>
									<td>Current Password:</td>
									<td><input id="password" type="password" name="password" maxlength="30"/></td>									
								</tr>
                                <tr>
									<td>New Password:</td>
									<td><input id="password" type="password" name="password" maxlength="30"/></td>									
								</tr>
                                <tr>
									<td>Confirm new Password:</td>
									<td><input id="password" type="password" name="password" maxlength="30"/></td>									
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td colspan="3"><input type="submit" name="submit" value="Change password" />
									</td>
										<!--<p><span id="errorMsg"></span></p>-->
								</tr>
							</table>
						 </form>
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
			<table>
				<tr> <?php require("layouts/footer.php");?> </tr>
			</table>

<!-- <script src="javascripts/script.js"></script> >

<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
//if($_SESSION['privilege']!="admin"){redirect_to("login.php");}
include_layout_template('header.php');
?>
<?php
	if(isset($_POST['submit'])){
		$errors = array();
		
		if(strlen($_POST['new'])<=8){
			$errors['new'] = "* Password shoulcd be at least 8 charactors!";
		}
		if($_POST['new']!=$_POST['renew']){
			$errors['renew'] = "* Password does not matched!";
		}
		
		if(empty($errors)){
		$cpw=trim(mysql_prep($_POST['pw']));	//current password
		$new=trim(mysql_prep($_POST['new']));
		$renew=trim(mysql_prep($_POST['renew']));
		$h_cpw = sha1($cpw);
		$h_new = sha1($new);
		$user_name=$_SESSION['user_name'];
		$staff_id=$_SESSION['staff_id'];
		$found_user = User::authenticate($user_name, $h_cpw);

			if(!empty($found_user)){
				$update_result=User::change_pw($h_new,$staff_id);
				if($update_result){
					echo '<script language="javascript">';
					echo 'alert("The password updated !")';
					echo '</script>';
				}else{
					echo '<script language="javascript">';
					echo 'alert("error! The password could not be updated !")';
					echo '</script>';
					}
			}else{
				echo '<script language="javascript">';
				echo 'alert("Incorrect current password !")';
				echo '</script>';
			}
		}
	}else{
		$cpw="";
		$new="";
	}
	
?>

			<table id="structure">
				<tr>
					<td id="navigation">
						<a href = "home.php">Home</a><br/>
						<br/>
					</td>
					<td id="page">
						<h2>Change password</h2>
						 <form id="change_pw" action="change_pw.php" method="post" >
							<table id="form2" width="100%">
								
								<tr>
									<td>Current Password:</td>
									<td><input id="pw" type="password" name="pw"/></td>									
								</tr>
                                <tr>
									<td>New Password:</td>
									<td><input id="neww" type="password" name="new"/></td>
									<td><h6><?php if(isset($errors['new'])) echo $errors['new']; ?></h6></td>
								</tr>
                                <tr>
									<td>Confirm new Password:</td>
									<td><input id="renew" type="password" name="renew"/></td>
									<td><h6><?php if(isset($errors['renew'])) echo $errors['renew']; ?></h6></td>
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

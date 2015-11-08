<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="admin"){redirect_to("login.php");}
include_layout_template('header.php');
?>
<?php

	if(isset($_POST['submit'])){
		
		require_once("../includes/user_validation.php");
				
		$name=trim(mysql_prep($_POST['nwi']));
		$full_name=trim(mysql_prep($_POST['name']));
		$staff_id=trim(mysql_prep($_POST['staff_id']));
		$email=trim(mysql_prep($_POST['email']));
		$contact_no=trim(mysql_prep($_POST['contact_no']));
		$username=trim(mysql_prep($_POST['username']));
		$privilege=trim(mysql_prep($_POST['privilege']));
		$password=trim(mysql_prep($_POST['password']));
		
		$hashed_password=sha1($password);
		
		//User::create_user($name,$staff_id,$emai,$username,$privilege,$password);
		if(empty($errors)){
			
			$new_user=new User();
			
			$new_user->username=$username;
			$new_user->password=$hashed_password;
			$new_user->name=$name;
			$new_user->full_name=$full_name;
			$new_user->email=$email;
			$new_user->privilege=$privilege;
			$new_user->staff_id=$staff_id;
			
			$result=$new_user->create();
			if($result){
				echo '<script language="javascript">';
				echo 'alert("The user account successfully added!")';
				echo '</script>';
			}else{
				$message="The user could not be created.";
				$message.="<br/>".mysql_error();
			}

			
		}else{
			if(count($errors)==1){
				$message="There was 1 error in the form.";
			}else{
				$message="There were ". count($errors)."errors in the form.";
			}
		}
	
	}else{//form has not been submitted
		$name="";
		$staff_id="";
		$email="";
		$username="";
		$priviledge="";
		$password="";
	}
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
									<td id="fn">Full name:</td>
									<td id="tn"><input type="text" name="name" id="name" maxlength="50" size="50" value="<?php
									//echo htmlentities($full_name); ?>"/></td>
									<td><h6><?php if(isset($errors['name'])) echo $errors['name']; ?></h6></td>
								</tr>
								<tr>
									<td id="name" >Name with initials:</td>
									<td id="text" ><input type="text" name="nwi" id="nwi" maxlength="50" value="<?php
									//echo htmlentities($name); ?>"/></td>
									<td><h6><?php if(isset($errors['nwi'])) echo $errors['nwi']; ?></h6></td>
								</tr>
								<tr>
									<td>NIC:</td>
									<td><input id="nic" type="text" name="nic" maxlength="30" value="<?php
									//echo htmlentities($nic); ?>"/></td>
									<td><h6><?php if(isset($errors['nic'])) echo $errors['nic']; ?></h6></td>
								</tr>
								<tr>
									<td id="fn">Contact No:</td>
									<td id="tn"><input type="text" name="contact_no" id="contact_no"maxlength="50" value="<?php
									//echo htmlentities($contact_no); ?>"/></td>
									<td><h6><?php if(isset($errors['contact_no'])) echo $errors['contact_no']; ?></h6></td>
								</tr>
								<tr>
									<td>Staff id:</td>
									<td><input id="staff_id" type="text" name="staff_id" id="staff_id" maxlength="30" value="<?php
									echo htmlentities($staff_id); ?>"/></td>
									<td><h6><?php if(isset($errors['staff_id'])) echo $errors['staff_id']; ?></h6></td>
								</tr>
								<tr>
									<td>E-mail:</td>
									<td><input id="email" type="text" name="email" id="email" maxlength="50" value="<?php
									echo htmlentities($email); ?>"/></td>
									<td><h6><?php if(isset($errors['email'])) echo $errors['email']; ?></h6></td>
								</tr>
								
								
								<tr>
									<td>Username:</td>
									<td><input id="username" type="text" name="username" id="username" maxlength="30" value="<?php
									echo htmlentities($username); ?>"/></td>
									<td><h6><?php if(isset($errors['username'])) echo $errors['username']; ?></h6></td>
								</tr>
								<tr>
									<td>Priviledge:</td>
									<td>
										<select name="privilege">
										<option value="<?php
														echo htmlentities($privilege='admin'); ?>" name="privilege">Administrator</option>
										<option value="<?php
														echo htmlentities($privilege='lecturer'); ?>" name="privilege">Lecturer</option>
										<option value="<?php
														echo htmlentities($privilege='staff'); ?>" name="privilege">Examination Dept:</option>
										<option value="<?php
														echo htmlentities($privilege='academic'); ?>" name="privilege">Acadamic & Pub: Dept:</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input id="password" type="password" name="password" maxlength="30" value="<?php
									echo htmlentities($password); ?>" /></td>
									<td><h6><?php if(isset($errors['password'])) echo $errors['password']; ?></h6></td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Create user" />
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

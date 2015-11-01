<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
?>
<?php

	include("../includes/validation.php");
	
	if(isset($_POST['submit'])){
		$index_no=trim(mysql_prep($_POST['index']));
		$reg_no=trim(mysql_prep($_POST['reg_no']));
		$nic=trim(mysql_prep($_POST['nic']));
		$name=trim(mysql_prep($_POST['name']));
		$nwi=trim(mysql_prep($_POST['nwi']));
		$batch=trim(mysql_prep($_POST['batch']));
		$course=trim(mysql_prep($_POST['course']));
		$gender=trim(mysql_prep($_POST['r1']));
		$email=trim(mysql_prep($_POST['email']));
		$address=trim(mysql_prep($_POST['address']));
		$contac_no=trim(mysql_prep($_POST['contact_no']));
		$dob=trim(mysql_prep($_POST['dob']));
		
		
		
		//Student::create();
		if(empty($errors)){
			
			$new_student=new Student();
			
			$new_student->index_no=$index_no;
			$new_student->reg_no=$reg_no;
			$new_student->nic=$nic;
			$new_student->full_name=$name;
			$new_student->nwi=$nwi;
			$new_student->batch=$batch;
			$new_student->course=$course;
			$new_student->address=$address;
			$new_student->contact_no=$contac_no;
			$new_student->email=$email;
			$new_student->gender=$gender;
			$new_student->dob=$dob;

			
			$result=$new_student->create();
			echo '<script language="javascript">';
			echo 'alert("The user has succesfully created !")';
			echo '</script>';
			if($result){
				
				$message="Student was succesfully added to the database";
			}else{
				$message="The student could not be created.";
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
		$index_no="";
		$reg_no="";
		$nic="";
		$name="";
		$nwi="";
		$batch="";
		$course="";
		$gender="";
		$email="";
		$address="";
		$contac_no="";
		$dob="";
	}
?>
			<table id="structure">
				
				<tr>
					<td id="navigation">
						<a href="home.php">- Home<br/><br/></a>
						<a href="view_students.php">- View students</a><br/><br/>
						<a href="logout.php">- Logout<br/><br/></a>
						<br/>
					</td>
					<td id="page">
						<div id="studentform">
							<h4><u><b>Student Registration Details</b></u></h4>
							<?php
									$message="masssssssge";
									echo $message;
									
									?>
							<form id="stud_reg" action="st_reg.php" method="post" name="login">
								<table id="form2" width="80%">
									<tr>
										<td id="name" >Name in Full:</td>
										<td id="text" ><input placeholder="eg: Don Seenigama Liyanage Nishantha" id="Name" type="text" name="name" size="80" maxlength="50" value="<?php
										echo htmlentities($name); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['name'])) echo $errors['name']; ?></h6></td>
									</tr>
									<tr>
										<td id="name" >Name with Initials:</td>
										<td id="text" ><input placeholder="eg: D S L Nishantha" id="nwi" type="text" name="nwi" maxlength="50" value="<?php
										echo htmlentities($nwi); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['nwi'])) echo $errors['nwi']; ?></h6></h6>
									</tr>
									<tr>
										<td>NIC:</td>
										<td><input placeholder="eg: 913373642V" id="nic" type="text" name="nic" maxlength="50" value="<?php
										echo htmlentities($nic); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['nic'])) echo $errors['nic']; ?></h6></h6>
									</tr>
									<tr>
										<td>Batch year:</td>
										<td><input placeholder="eg: 2013" id="batch" type="text" name="batch" maxlength="50" value="<?php //echo htmlentities($batch); ?>"/></td>
										<td id="comnt"><h6><?php //if(isset($errors['nic'])) echo $errors['nic']; ?></h6></h6>
									</tr>
									<tr>
										<td>Course Name:</td>
										<td><select name="course"> 
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" selected="selected" value="<?php echo htmlentities($course="CS"); ?>">Computer Science</option>
										</select>
									</tr>
									<tr>
										<td>Registration No:</td>
										<td><input placeholder="eg: 2013CS123" id="reg_no" type="text" name="reg_no" maxlength="50" value="<?php
										echo htmlentities($reg_no); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['reg_no'])) echo $errors['reg_no']; ?></h6></td>
									</tr>
									<tr>
										<td>Index No:</td>
										<td><input placeholder="eg: 13001234" id="index" type="text" name="index" maxlength="50" value="<?php
										echo htmlentities($index_no); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['index'])) echo $errors['index']; ?></h6></h6>
									</tr>
									<tr>
										<td>Address:</td>
										<td><textarea placeholder="eg:&#10;No 45,&#10;Baker Street,&#10;London,&#10;England." id="address" name="address" rows="6" cols="22" value="<?php
										echo htmlentities($address); ?>"></textarea></td>
										<!--<td><input id="add" type="address" wrap="true" name="namefull" maxlength="50" value="<?php
										//echo htmlentities($namefull); ?>"/></td>-->
									</tr>
									<tr height="20"></tr>
									<tr>
										<td id="name" >Contact No:</td>
										<td id="text" ><input placeholder="07XXXXXXXX" id="contact_no" type="postcode" name="contact_no" maxlength="50" value="<?php
										echo htmlentities($contac_no); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['contact_no'])) echo $errors['contact_no']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name" >Email:</td>
										<td id="text" ><input placeholder="eg: abcd@gmail.com" id="email" type="email" name="email" maxlength="50" value="<?php
										echo htmlentities($email); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['email'])) echo $errors['email']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name">Gender:</td>
										<td id="tf">Male<input checked="checked" id="r1" type="radio" name="r1" value ="<?php echo htmlentities($gender="male"); ?>"/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female<input id="r1" type="radio" name="r1"
																			value ="<?php echo htmlentities($gender="female"); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['r1'])) echo $errors['r1']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name" >Date of Birth:</td>
										<td id="text" ><input id="dob" type="date" name="dob" maxlength="50" value="<?php
										echo htmlentities($dob); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['dob'])) echo $errors['dob']; ?></h6></h6>
									</tr>
									
									<tr>
										<td id="name">Photo: </td>
										<td id="text"><input type="file" name="pic" accept="image/*"></td>
									</tr>
									<tr>
										<!--<td id="name" ></td>-->
										<td id="text" colspan="3">
											<div class="left-btn">
												<input type="reset" name = "Reset" value="Reset">
											</div>
											<div class="right-btn">
												<input type="submit" name="submit" value="Submit"/>
											</div>
											<!--p><span id="errorMsg"></span></p--> 
										</td>
										<!--<td>&nbsp;</td>-->
									</tr>
									<!--<tr>
										<td id="name"><input type="reset" name = "Reset" value="Reset"></td>
										<td id="text"></td>
									</tr>-->
								</table>
							</form>
						</div>
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
			
			
<!--script src="javascripts/stud_reg.js"></script-->		

<?php
    $id=$_GET['id'];
	
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
?>
<?php

	$find=Student::find_by_index($id);
	include("../includes/validation.php");
	
	if(isset($_POST['submit'])){
		$index_no=trim(mysql_prep($_POST['index']));
		$reg_no=trim(mysql_prep($_POST['reg_no']));
		$nic=trim(mysql_prep($_POST['nic']));
		$name=trim(mysql_prep($_POST['name']));
		$nwi=trim(mysql_prep($_POST['nwi']));
		$course=trim(mysql_prep($_POST['course']));
		$gender=trim(mysql_prep($_POST['r1']));
		$email=trim(mysql_prep($_POST['email']));
		$address=trim(mysql_prep($_POST['address']));
		$contac_no=trim(mysql_prep($_POST['contact_no']));
		$dob=trim(mysql_prep($_POST['dob']));
		
		$updated_student=new Student();
		
			$updated_student->id=$id;
			$updated_student->index_no=$index_no;
			$updated_student->reg_no=$reg_no;
			$updated_student->nic=$nic;
			$updated_student->full_name=$name;
			$updated_student->nwi=$nwi;
			$updated_student->batch=$batch;
			$updated_student->course=$course;
			$updated_student->address=$address;
			$updated_student->contact_no=$contac_no;
			$updated_student->email=$email;
			$updated_student->gender=$gender;
			$updated_student->dob=$dob;
			
			$update_result=$updated_student->update();
			if($update_result){
				echo '<script language="javascript">';
				echo 'alert("The Student has succesfully updated !")';
				echo '</script>';
			}else{
					echo '<script language="javascript">';
				echo 'alert("error! The student could not be updated !")';
				echo '</script>';
				}
			
	}
	
?>
			<table id="structure">
				
				<tr>
					<td id="navigation">
						<a href="home.php">- Home<br/><br/></a>
						<a href="view_students.php">- View students<br/><br/></a>
						<a href="logout.php">- Logout<br/><br/></a>
						<br/>
					</td>
					<td id="page">
						<div id="studentform">
							<h4><u><b>Student Registration Details</b></u></h4>
							<?php
								echo $message;
							?>
							<form id="stud_reg" action="edit_student.php?id=<?php echo $id; ?>" method="post" name="login">
								<table id="form2" width="80%">
									<tr>
										<td id="name" >Name in Full:</td>
										<td id="text" ><input id="Name" type="text" name="name" size="80" maxlength="50" value="<?php echo $find->full_name; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['name'])) echo $errors['name']; ?></h6></td>
									</tr>
									<tr>
										<td id="name" >Name with Initials:</td>
										<td id="text" ><input id="nwi" type="text" name="nwi" maxlength="50" value="<?php echo $find->nwi; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['nwi'])) echo $errors['nwi']; ?></h6></h6>
									</tr>
									<tr>
										<td>NIC:</td>
										<td><input id="nic" type="text" name="nic" maxlength="50"  value="<?php echo $find->nic; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['nic'])) echo $errors['nic']; ?></h6></h6>
									</tr>
									<tr>
										<td>Batch year:</td>
										<td><input id="batch" type="text" name="batch" maxlength="50" value="<?php echo $find->batch; ?>"/></td>
										<td id="comnt"><h6><?php //if(isset($errors['nic'])) echo $errors['nic']; ?></h6></h6>
									</tr>
									<tr>
										<td>Course Name:</td>
										<td><select name="course">
										<?php
											if($find->course=="CS"){
												$select="selected='selected'";
											}elseif($find->course=="IS"){
												$select="";
											}else{
												$select="";
											}
										?>
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" <?php echo $select?> value="<?php echo htmlentities($course="CS");?>">Computer Science</option>
										</select>
									</tr>
									<tr>
										<td>Registration No:</td>
										<td><input id="reg_no" type="text" name="reg_no" maxlength="50" value="<?php echo $find->reg_no; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['reg_no'])) echo $errors['reg_no']; ?></h6></td>
									</tr>
									<tr>
										<td>Index No:</td>
										<td><input id="index" type="text" name="index" maxlength="50" value="<?php
										 echo $find->index_no; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['index'])) echo $errors['index']; ?></h6></h6>
									</tr>
									<tr>
										<td>Address:</td>
										<td><textarea id="address" name="address" rows="6" cols="22"> <?php
										 echo $find->address; ?></textarea></td>
										<!--<td><input id="add" type="address" wrap="true" name="namefull" maxlength="50" value="<?php
										//echo htmlentities($namefull); ?>"/></td>-->
									</tr>
									<tr height="20"></tr>
									<tr>
										<td id="name" >Contact No:</td>
										<td id="text" ><input id="contact_no" type="postcode" name="contact_no" maxlength="50" value="<?php
										 echo $find->contact_no; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['contact_no'])) echo $errors['contact_no']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name" >Email:</td>
										<td id="text" ><input placeholder="eg: abcd@gmail.com" id="email" type="email" name="email" maxlength="50" value="<?php
										 echo $find->email; ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['email'])) echo $errors['email']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name">Gender:</td>
										<?php
											if($find->gender=="male"){
												$ifmale="checked='checked'";
												$iffemale="";
											}elseif($find->gender=="female"){
												$ifmale="";
												$iffemale="checked='checked'";
											}else{
												$ifmale="";
												$iffemale="";
											}
										?>
										<td id="tf">
										Male
										<input <?php echo $ifmale; ?> id="r1" type="radio" name="r1" value ="<?php echo htmlentities($gender="male"); ?>"/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Female
										<input <?php echo $iffemale; ?> id="r1" type="radio" name="r1" 
																			value ="<?php echo htmlentities($gender="female"); ?>"/></td>
										<td id="comnt"><h6><?php if(isset($errors['r1'])) echo $errors['r1']; ?></h6></h6>
									</tr>
									<tr>
										<td id="name" >Date of Birth:</td>
										<td id="text" ><input id="dob" type="date" name="dob" maxlength="50" value="<?php
										 echo $find->dob; ?>"/></td>
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
				<tr> <?php// require("layouts/footer.php");?> </tr>
			</table>
			
			
<!--script src="javascripts/stud_reg.js"></script-->		

<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
?>

<?php
    if(isset($_POST['submit'])){
		
		if(empty($_POST['s_id'])){
			$errors['s_id'] = "* Subject ID field cannot be empty.";
		}
		
		if(empty($_POST['s_name'])){
			$errors['s_name'] = "* Subject name field cannot be empty.";
		}
		
		if(empty($_POST['credits'])){
			$errors['credits'] = "* Enter number of credits for the subject";
		}
		
		
        $sub_id=trim(mysql_prep($_POST['s_id']));
        $sub_name=trim(mysql_prep($_POST['s_name']));
        $year=trim(mysql_prep($_POST['year']));
		$sem_id=trim(mysql_prep($_POST['sem_id']));
        $course=trim(mysql_prep($_POST['course']));
		$credits=trim(mysql_prep($_POST['credits']));

		if(empty($errors)){
        $new_sub=new Subject();
        
        $new_sub->sub_id=$sub_id;
        $new_sub->sub_name=$sub_name;
        $new_sub->year=$year;
        $new_sub->sem_id=$sem_id;
        $new_sub->course=$course;
		$new_sub->credits=$credits;
        
        $rslt=$new_sub->create();
        
			if($rslt){
				redirect_to("assign_lec.php?sub_id=$sub_id");
			}else{
				echo '<script language="javascript">';
				echo 'alert("error! The subject could not be created !")';
				echo '</script>';
				}
			
		
		}else{
			if(count($errors)==1){
				$message="There was 1 error in the form.";
			}else{
				$message="There were ". count($errors)." errors in the form.<br/>";
			}
		}
			
            
    }

?>


			<table id="structure">
				<tr>
					<td id="navigation">
						<a href = "home.php">Home</a><br/>
						<br/>
					</td>
					<td id="page">
						<h2>Add a new subject</h2>
						<?php //if(!empty($message)){echo "<p class=\"message\">".$message."</p>";} ?>
						 <?php// if(!empty($errors)){display_errors($errors);} ?>
						 <form id="subject_form" action="add_subject.php" method="post" >
							<table id="form2" width="100%">
                                
                                <?php echo $message; ?>
								<tr>
									<td id="s_id">Subject ID:</td>
									<td id="s_id"><input type="text" name="s_id" id="s_id" maxlength="50" size="50" value="<?php
									//echo htmlentities($full_name); ?>"/></td>
									<td><h6><?php if(isset($errors['s_id'])) echo $errors['s_id']; ?></h6></td>
								</tr>
								<tr>
									<td id="s_name" >Subject Name:</td>
									<td id="s_name" ><input type="text" name="s_name" id="s_name" maxlength="50" value="<?php
									//echo htmlentities($name); ?>"/></td>
									<td><h6><?php if(isset($errors['s_name'])) echo $errors['s_name']; ?></h6></td>
								</tr>
                                 <tr>
										<td>Year:</td>
										<td><select name="year"> 
											<option name="year" selected="selected" value="<?php echo htmlentities($year="1st year"); ?>">1st year</option>
											<option name="year" value="<?php echo htmlentities($year="2nd year"); ?>">2nd year</option>
											<option name="year" value="<?php echo htmlentities($year="3rd year"); ?>">3rd year</option>
											<option name="year" value="<?php echo htmlentities($year="4th year"); ?>">4th year</option>

										</select>
								</tr>
								 <tr>
										<td>Semster ID:</td>
										<td id="sem_id" ><input type="text" name="sem_id" id="sem_id" maxlength="50" value="<?php
									//echo htmlentities($name); ?>"/></td>
									<td><h6><?php //if(isset($errors['s_name'])) echo $errors['s_name']; ?></h6></td>
								</tr>
								 
                                 <tr>
										<td>Course Name:</td>
										<td><select name="course"> 
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" selected="selected" value="<?php echo htmlentities($course="CS"); ?>">Computer Science</option>
										</select>
								</tr>
								  <tr>
										<td>Number of Credits:</td>
										<td id="credits" ><input type="text" name="credits" id="credits" maxlength="50"/></td>
									<td><h6><?php //if(isset($errors['credits'])) echo $errors['credits']; ?></h6></td>
								</tr>

								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Add subject" />
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

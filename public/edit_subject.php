<?php
$s_id=$_GET['id'];
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
?>

<?php
    $find_sub=Subject::find_by_id($s_id);
    
    if(isset($_POST['submit'])){
		
		if(empty($_POST['s_name'])){
			$errors['s_name'] = "* Subject name field cannot be empty.";
		}
		
        if(empty($_POST['credits'])){
			$errors['credits'] = "* Enter number of credits for the subject";
		}
		
        $sub_name=trim(mysql_prep($_POST['s_name']));
        $year=trim(mysql_prep($_POST['year']));
		$sem_id=trim(mysql_prep($_POST['sem_id']));
        $course=trim(mysql_prep($_POST['course']));
		$credits=trim(mysql_prep($_POST['credits']));

		if(empty($errors)){
        $updated_sub=new Subject();
        
		$updated_sub->sub_id=$s_id;
        $updated_sub->sub_name=$sub_name;
        $updated_sub->year=$year;
		$updated_sub->sem_id=$sem_id;
        $updated_sub->course=$course;
        $updated_sub->credits=$credits;
		        
        $update_sub_res=$updated_sub->update();
        
			if($update_sub_res){
				echo '<script language="javascript">';
				echo 'alert("The subject has succesfully Updated!")';
				echo '</script>';
			}else{
					echo '<script language="javascript">';
				echo 'alert("error! The subject could not be updated !")';
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
						<a href="select_cs_is.php">- View Subjects</a><br/><br/>
						<a href = "home.php">Home</a><br/>
						<br/>
					</td>
					<td id="page">
						<h2>Edit Subject details</h2>

						 <form id="user_form" action="edit_subject.php?id=<?php echo $s_id;?>" method="post" >
							<table id="form2" width="100%">
                                
                                <?php echo $message; ?>
								
								<tr>
									<td id="s_name" >Subject Name:</td>
									<td id="s_name" ><input type="text" name="s_name" id="s_name" maxlength="50" value="<?php
									echo $find_sub->sub_name; ?>"/></td>
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
									echo $find_sub->sem_id; ?>"/></td>
									<td><h6><?php if(isset($errors['sem_id'])) echo $errors['sem_id']; ?></h6></td>
								</tr>
                                 <tr>
										<td>Course Name:</td>
										<td><select name="course">
										<?php
											if($find_sub->course=="CS"){
												$select="selected='selected'";
											}elseif($find_sub->course=="IS"){
												$select="";
											}else{
												$select="";
											}
										?>
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" <?php echo $select?> value="<?php echo htmlentities($course="CS");?>">Computer Science</option>
										</select>
								</tr>
								
		
								</tr>
								
								 <tr>
										<td>Number of Credits:</td>
										<td id="credits" ><input type="text" name="credits" id="credits" maxlength="50" value="<?php
									echo $find_sub->credits; ?>"/></td>
									<td><h6><?php if(isset($errors['credits'])) echo $errors['credits']; ?></h6></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Update subject" />
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

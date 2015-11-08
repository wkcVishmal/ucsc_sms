<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
?>

<?php

    if(isset($_POST['submit'])){
		
		if(empty($_POST['batch'])){
			$errors['batch'] = "* Please enter a valied batch ID !";
		}elseif(!preg_match("/^[0-9]{4}$/",$_POST['batch'])){
			$errors['batch'] = "* Invalied  batch ID.";
		}
		if(strlen($_POST['batch'])!=4){
			$errors['batch'] = "* Invalied  batch ID !";
		}
		
		if(empty($_POST['sem_id'])){
			$errors['sem_id'] = "* Please enter a valied semester ID !";
		}
		
        $batch=trim(mysql_prep($_POST['batch']));
        $sem_id=trim(mysql_prep($_POST['sem_id']));
		$course=trim(mysql_prep($_POST['course']));
		$id=$batch.$course.$sem_id;
		if(empty($errors)){

			
			$new_sem=new Semster();
			$new_sem->batch=$batch;
			$new_sem->sem_id=$sem_id;
			$new_sem->course=$course;
			$new_sem->id=$id;
			$rslt="";
			global $database;
			$result = mysql_query("SHOW TABLES LIKE '$id'");
			$tableExist = mysql_num_rows($result) > 0;
			if($tableExist){
				echo '<script language="javascript">';
				echo 'alert("error! The semester already created !")';
				echo '</script>';
				
			}else{
				$rslt=$new_sem->create();
			}
			
			//$rslt1=$new_sem->insert();
			if($rslt){
				echo '<script language="javascript">';
				echo 'alert("The semester has succesfully added !")';
				echo '</script>';
			}else{
				echo '<script language="javascript">';
				echo 'alert("error! The semester could not be created !")';
				echo '</script>';
				}
			
		
		}else{
			if(count($errors)==1){
				//$message="There was 1 error in the form.";
			}else{
				//$message="There were ". count($errors)." errors in the form.<br/>";
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
						<h2>Start new semester</h2>
						 <form id="user_form" action="start_semster.php" method="post" >
							<table id="form2" width="100%">

								<tr>
									<td id="batch">Batch:</td>
									<td id="batch"><input type="text" name="batch" id="batch" maxlength="50" size="50" placeholder="Ex: 2014"/></td>
									<td><h6><?php if(isset($errors['batch'])) echo $errors['batch']; ?></h6></td>
								</tr>
								
								<tr>
									<td id="sem_id">Semster ID:</td>
									<td id="sem_id"><input type="text" name="sem_id" id="sem_id" maxlength="50" size="50" value="<?php
									//echo htmlentities($full_name); ?>" placeholder="Semester ID"/></td>
									<td><h6><?php if(isset($errors['sem_id'])) echo $errors['sem_id']; ?></h6></td>
								</tr>

                                 <tr>
										<td>Course Name:</td>
										<td><select name="course"> 
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" selected="selected" value="<?php echo htmlentities($course="CS"); ?>">Computer Science</option>
										</select>
									</tr>

								
								<tr>
									<td></td>
								</tr>
                                
                                
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Start semster" />
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

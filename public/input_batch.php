
                                        
<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
//if($_SESSION['privilege']!="lecturer"){redirect_to("login.php");}
include_layout_template('header.php');

?>
<?php
    $staff_id=$_SESSION['staff_id'];
    $sub_id=$_GET['sub_id'];

    
    if(isset($_POST['submit'])){
		
		if(empty($_POST['batch'])){
			$errors['batch'] = "* Please enter the Batch.!";
		}
		
		if(empty($_POST['sem_id'])){
			$errors['sem_id'] = "* Semster ID field cannot be empty.!";
		}
		
<<<<<<< HEAD
        $batch_id=trim(mysql_prep($_POST['batch']));
        $sem_id=trim(mysql_prep($_POST['sem_id']));
        $course=trim(mysql_prep($_POST['course']));
		$table=$batch_id.$course.$sem_id;
		if(empty($errors)){
			global $database;
			$result = mysql_query("SHOW TABLES LIKE '$table'");
			$tableExist = mysql_num_rows($result) > 0;
			if($tableExist){
				redirect_to("view_st_list.php?table=$table&staff_id=$staff_id&sub_id=$sub_id&sem_id=$sem_id&batch=$batch_id&course=$course");
			}else{
				echo '<script language="javascript">';
				echo 'alert("error! You have no access to enter this results!")';
				echo '</script>';
			}
				
		}else{
			if(count($errors)==1){
				//$message="There was 1 error in the form.";
			}else{
				//$message="There were ". count($errors)." errors in the form.<br/>";
=======
		
        $batch_id=trim(mysql_prep($_POST['batch']));
        $sem_id=trim(mysql_prep($_POST['sem_id']));
        $course=trim(mysql_prep($_POST['course']));


		if(empty($errors)){
			$table=$batch_id.$course.$sem_id;
			redirect_to("view_st_list.php?table=$table&staff_id=$staff_id&sub_id=$sub_id&sem_id=$sem_id&batch=$batch_id&course=$course");
						
		
		}else{
			if(count($errors)==1){
				$message="There was 1 error in the form.";
			}else{
				$message="There were ". count($errors)." errors in the form.<br/>";
>>>>>>> 6aceb631899f9d7c7ec0936be4adab3034a70f60
			}
		}
			
            
    }else{
        $batch="";
        $sem_id="";
        $course="";
    }
?>

			<table id="structure">
				<tr>
					<td id="navigation">
						<br/>
                        <a href="home.php">- Home<br/><br/></a>
						<a href="logout.php">- logout<br/><br/></a>
					</td>
					<td id="page">
								
                        <form id="input_batch" action="input_batch.php?sub_id=<?php echo $sub_id;?>" method="post" >
							<table id="form2" width="100%">
<<<<<<< HEAD

								<tr>
									<td id="batch">Enter Batch:</td>
									<td id="batch"><input type="text" name="batch" id="batch"/></td>
=======
                                
                                <?php echo $message; ?>
								<tr>
									<td id="batch">Enter Batch :</td>
									<td id="batch"><input type="text" name="batch" id="batch" maxlength="50" size="50" value="<?php
									//echo htmlentities($full_name); ?>"/></td>
>>>>>>> 6aceb631899f9d7c7ec0936be4adab3034a70f60
									<td><h6><?php if(isset($errors['batch'])) echo $errors['batch']; ?></h6></td>
								</tr>
								
                                 
								 <tr>
										<td>Semster ID:</td>
<<<<<<< HEAD
										<td id="sem_id" ><input type="text" name="sem_id" id="sem_id"/></td>
									<td><h6><?php if(isset($errors['sem_id'])) echo $errors['sem_id']; ?></h6></td>
=======
										<td id="sem_id" ><input type="text" name="sem_id" id="sem_id" maxlength="50" value="<?php
									//echo htmlentities($name); ?>"/></td>
									<td><h6><?php //if(isset($errors['s_name'])) echo $errors['s_name']; ?></h6></td>
>>>>>>> 6aceb631899f9d7c7ec0936be4adab3034a70f60
								</tr>
								<tr>
                                 <tr>
										<td>Course Name:</td>
										<td>
										<select name="course"> 
											<option name="course" value="<?php echo htmlentities($course="IS"); ?>">Information Systems</option>
											<option name="course" selected="selected" value="<?php echo htmlentities($course="CS"); ?>">Computer Science</option>
										</select>
									</tr>
								
								<tr>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="View Students" />
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
<?php //require("includes/footer.php");?>
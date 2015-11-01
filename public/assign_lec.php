                                        
<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');
$subject_id=$_GET['sub_id'];
?>

<?php
    if(isset($_POST['submit'])){
		
		
		if(empty($_POST['staff_id'])){
			$errors['staff_id'] = "* Please enter staff id of lecturer.";
		}
		
		
        $staff_id=trim(mysql_prep($_POST['staff_id']));
        
         
		if(empty($errors)){
            $sub_lec=new Subject();
            $sub_lec->staff_id=$staff_id;
            $sub_lec->sub_id=$subject_id;
            $rslt=$sub_lec->allocate_lec();
        
			if($rslt){
				//redirect_to("assign_lec.php?sub_id=$subject_id");
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
			
            
    }else{
        $staff_id="";
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
                        <table>
                            <tr><?php
                                if(isset($_GET['sub_id'])){
                                    echo "<strong>Subject id :". $_GET['sub_id']."<br><br>Allocated Lecturers :</strong><br><br>";
                                }
                                ?>
                            </tr>
                            
                            
                                <?php
                                    if(isset($_GET['sub_id'])){
                                        $subject_id=$_GET['sub_id'];
                                    
                                    $arr=Subject::find_lec_by_sub($_GET['sub_id']);
                                    
									foreach ($arr as $sub){
                                        echo "<tr><td>$sub->staff_id</td><td>";
										echo "<a href='unallocate.php?staff_id=$sub->staff_id&sub_id=$subject_id'>Unallocate lecture</a></td></tr>";
									  
									}
                                    }
								?>
                                
                            
                        
                            
                            
                        </table>
                        <form id="assign_lec" action="assign_lec.php?sub_id=<?php echo $subject_id; ?>" method="post">
						<table>
							<tr>
								<td><h6><?php if(isset($errors['sub_id'])) echo $errors['sub_id']; ?></h6></td>
							</tr>
							<br/>
							<tr>
								<td id="staff_id">Enter Lecture ID:</td>
								<td id="staff_id"><input type="text" name="staff_id" id="staff_id" maxlength="50" size="50" value="<?php
								//echo htmlentities($full_name); ?>"/></td>
								<td><h6><?php if(isset($errors['staff_id'])) echo $errors['staff_id']; ?></h6></td>
								<td colspan="2"><input type="submit" name="submit" value="Assign Lecturer" /></td>
								
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
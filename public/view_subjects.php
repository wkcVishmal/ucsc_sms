// view subjects
                                        
<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="staff"){redirect_to("login.php");}
include_layout_template('header.php');

$course=$_GET['course'];

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
								<?php
								echo "<h4>Subjects: </h4>"."<br/>";
                                
								$arr=Subject::find_by_course($course);
                                
									foreach ($arr as $sub){
										echo "<tr><td>";
										echo $sub->sub_id."&nbsp</td>"."<td>";
										 echo $sub->sub_name."</td><td>";
										echo $sub->year."</td><td>";
										echo $sub->sem_id."</td><td>";
										
										echo "<a href='assign_lec.php?sub_id=$sub->sub_id'>Allocate Lecturer</a></td>&nbsp<td>";
										echo "<a href='edit_subject.php?id=$sub->sub_id'>Edit</a></td><td>";
										echo "<a href='delete_subject.php?id=$sub->sub_id'>Delete</a></td></tr>";
									  
									}
								?>
						</table>
			
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
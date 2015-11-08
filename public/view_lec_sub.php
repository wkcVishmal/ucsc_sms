
                                        
<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
//if($_SESSION['privilege']!="lecturer"){redirect_to("login.php");}
include_layout_template('header.php');

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
								echo "<h4>Allocated Subjects: </h4>"."<br/>";
                                $staff_id=$_SESSION['staff_id'];
								$arr=Subject::find_sub_by_lec($staff_id);
                                
									foreach ($arr as $sub){
										echo "<tr><td><strong>";
										echo $sub->sub_id."</strong>&nbsp</td>"."<td>";
										
										echo "<a href='input_batch.php?sub_id=$sub->sub_id'>Enter Results</a></td></tr>";
									  
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
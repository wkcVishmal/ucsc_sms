<?php
require_once("../includes/initialize.php");
if(!$session->is_logged_in()){redirect_to("login.php");}
if($_SESSION['privilege']!="lecturer"){redirect_to("login.php");}
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
								echo "<td><h4>Index No: </h4></td>"."<br/>";
								$max=1000;
								for($id=0;$id<=$max;$id++){
									
									if($arr=Student::find_by_id($id)){
										echo "<tr><td>";
										echo $arr->index_no."</td>"."<td>";
										echo "</td>";
                                        echo "<td><form id=\"grade\" action=\"add_results.php\" method=\"post\" name=\"grade\"><input id=\"grade\" type=\"text\" name=\"nwi\" maxlength=\"50\"/></form></td>";
										
									}
								}
		
								?>
								<br/>
							<td>
								
											
											<input type="reset" name = "Reset" value="Cansal">
							</td>
											<td>
												<input type="submit" name="submit" value="Submit"/>
											</td>
											<!--p><span id="errorMsg"></span></p--> 
										
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
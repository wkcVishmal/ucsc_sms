<?php
require_once("../includes/initialize.php");
 include_layout_template('header.php');
?>

			<table id="structure">
				<tr>
					<td id="navigation">
						<a href="new_user.php">- Add new user</a><br/><br/>
						<a href="view.php">- View users</a><br/><br/>
						<a href="logout.php">- Logout</a>
						<br/>
					</td>
					<td id="page">
						<h3>Admin user</h3>
					</td>
					<td id="logindetails">
						<img src="user.jpg" style="width:150px;height:150px;">
						<?php
                        ?>
					</td>
				</tr>
			</table>
<?php require("layouts/footer.php");?>
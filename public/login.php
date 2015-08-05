<?php
require_once("../includes/initialize.php");
$message = "";

if($session->is_logged_in()) {
  redirect_to("admin.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $h_password = sha1($password);
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $h_password);
	
  if ($found_user) {
    $session->login($found_user);
    redirect_to("admin.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<?php include_layout_template('header.php'); ?>

		<h2></h2>
		

		<form action="login.php" method="post">
		  <table id="structure">
				<tr>
					<td id="navigation"></td>
					<td id="page">
						
						
						 
					</td>
					<td id="logindetails">
						 <div id="form">
                         <form action="login.php" method="post" name="login">
							<table id="t1" >
                            	<td id="lognhead" ><h3>Login</h3></td>

								<tr id="tr1">
                                	<td id="username">Username:</td>
									<td><input type="text" name="username" maxlength="30" value="<?php
									echo htmlentities($username); ?>"/></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="password" maxlength="30" value="<?php
									echo htmlentities($password); ?>" /></td>
								</tr>
								<div>
								  <tr>
									<td>
									<?php if(!empty($message)){echo "<p class=\"message\">".$message."</p>";} ?>
									<?php if(!empty($errors)){display_errors($errors);} ?>
									</td>
								  </tr>
								</div> 
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="     Login   " />
									</td>
								</tr>
							</table>
						 </form>
						 </div>
					</td>
				</tr>
			</table>
<?php include_layout_template('footer.php'); ?>

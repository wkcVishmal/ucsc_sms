<?php
require_once("../includes/initialize.php");
$message = "";

if($session->is_logged_in()) {
  redirect_to("home.php");
}

if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']); //set the typed username to  $username
  $password = trim($_POST['password']); //set the typed password to $password 
  $h_password = sha1($password); // set hashed password to $h_password 
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $h_password); // if pwd & user ok user found ,$found_user = true
	
  if ($found_user) {
    $session->login($found_user); // if user ok go to session object
	redirect_to("home.php");
	
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
		<form action="login.php" method="post">
		  <table id="structure">
				<tr>
					<td id="navigation">
					  <a href="home.php">Home<br><br></a>					 
					 <a href="view_cources.php">Cources<br><br></a>
					 <a href="site_news.php">Site News<br><br></a>
					 <a href="discussion.php">Discussion<br><br></a>
					</td>					 
	  				<td id="page">
						<div id="whtbox">
						<img src="images/login.png" style="width:600px;height:380px;margin:80px;border-radius: 10px 10px 10px 10px;">
						</div>
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
							</table>
							
							<table>
							  <tr>
								<td>
								  <?php if(!empty($message)){echo "<p class=\"message\">".$message."</p>";} ?>
								  <?php if(!empty($errors)){display_errors($errors);} ?>
								</td>
							  </tr>
							</table>
							
							<table>
								<tr>								  
									<td>
									  <input type="checkbox">remember me
									</td>
									<td>
									  <input type="submit" name="submit" value="     Login   " />
									
									</td>								  
								</tr>
								
							</table>
							
						 </form>
						 </div>
					</td>
				</tr>
			</table>
<?php include_layout_template('footer.php'); ?>

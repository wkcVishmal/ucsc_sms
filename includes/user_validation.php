<?php
if(empty($_POST['name'])){
			$errors['name'] = "* Full Name field cannot be empty.";
		}
		if(!preg_match("/^[a-z ]+$/i", $_POST['name'])){
			$errors['name'] = "* Invalied name! Name should only include alphabetic charactors.";
		}
		
		if(empty($_POST['nwi'])){
			$errors['nwi'] = "* Name with initials field cannot be empty.";
		}
		
		if(empty($_POST['nic'])){
			$errors['nic'] = "* NIC field cannot be empty.";
		}elseif(!preg_match("/^[0-9]{9}(v|V|x|X)$/",$_POST['nic'])) {
			$errors['nic'] = "* Invalied NIC number";
		}
		
		if(!preg_match("/^[0-9]{10}$/", $_POST['contact_no'])){
			$errors['contact_no'] = "* Invalied phone number.";
		}
		if(strlen($_POST['contact_no'])!=10){
			$errors['contact_no'] = "* Invalied phone number length.";
		}
		if(empty($_POST['contact_no'])){
			$errors['contact_no'] = "* Contact number field cannot be empty.";
		}
		
		if(empty($_POST['staff_id'])){
			$errors['staff_id'] = "* staff_id field cannot be empty.";
		}
		
		$em=$_POST['email'];
		if(filter_var($em,FILTER_VALIDATE_EMAIL) === false){
			$errors['email'] = "* Invalied e-mail address.";
		}
		
		if(empty($_POST['username'])){
			$errors['username'] = "* UserName field cannot be empty.";
		}
		
		if(strlen($_POST['password'])<=8){
			$errors['password'] = "* Password shoulcd be at least 8 charactors.";
		}

?>
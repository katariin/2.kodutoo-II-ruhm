<?php

require_once("functions.php"); 
 	 
 	//kontrollin, kas kasutaja on sisseloginud 
 	if(isset($_SESSION["id_from_db"])){ 
 		// suunan data lehele 
 		header("Location: data.php"); 
 	} 

  // muuutujad errorite jaoks
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";
	$firstname_error = "";
	$lastname_error = "";
  // muutujad vaartuste jaoks
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";
	$firstname = "";
	$lastname = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){
			
			echo "vajutas log in nuppu!";
			
			if ( empty($_POST["email"]) ) {
				$email_error = "See vali on kohustuslik";
			}else{
        // puhastame muutuja voimalikest uleliigsetest sumbolitest
				$email = cleanInput($_POST["email"]);
			}
			if ( empty($_POST["password"]) ) {
				$password_error = "See vali on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}
      // Kui oleme siia joudnud, voime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password; 
 				 
 				$password_hash = hash("sha512", $password); 
 				 
 				// functions php failis käivitan funktsiooni 
 				loginUser($email, $password_hash); 
 			} 
 
		} // login if end 


    // *********************
    // ** LOO KASUTAJA *****
    // *********************
    if(isset($_POST["create"])){
		
		echo "vajutas create nuppu!";
		
		
		if ( empty($_POST["create_email"]) ) {
			$create_email_error = "See vali on kohustuslik";
		}else{
			$create_email = cleanInput($_POST["create_email"]);
		}
		if ( empty($_POST["create_password"]) ) {
			$create_password_error = "See vali on kohustuslik";
		} else {
			if(strlen($_POST["create_password"]) < 8) {
				$create_password_error = "Peab olema vahemalt 8 tahemarki pikk!";
			}else{
				$create_password = cleanInput($_POST["create_password"]);
			}
					if ( empty($_POST["firstname"]) ) {
			$firstname_error = "See vali on kohustuslik";
		}else{
			$firstname= cleanInput($_POST["firstname"]);
		}
		
		if ( empty($_POST["lastname"]) ) {
			$lastname_error = "See vali on kohustuslik";
		}else{
			$lastname = cleanInput($_POST["lastname"]);
		}
	}
		
		if(	$create_email_error == "" && $create_password_error == "" && $firstname_error == "" && $lastname_error== "" ){
			echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password; 
 				 
 				$password_hash = hash("sha512", $create_password); 
				echo "<br>"; 
 				echo $password_hash; 
				 
 				// functions.php failis käivina funktsiooni 
 				createUser($create_email, $password_hash, $firstname, $lastname); 
 				 

        }
    } // create if end
   }
  // funktsioon, mis eemaldab koikvoimaliku uleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br>
  	<input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Log in">
  </form>

  <h2>Create user</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> * <?php echo $create_email_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Parool" value="<?php echo $create_password; ?>"> * <?php echo $create_password_error; ?><br><br>
	<input name="firstname" type="name" placeholder="First name" value="<?php echo $firstname; ?>"> * <?php echo $firstname_error; ?><br><br>
	<input name="lastname" type="name" placeholder="Last name" value="<?php echo $lastname; ?>"> * <?php echo $lastname_error; ?><br><br>
  	<input type="submit" name="create" value="Create user">
  </form>


<body>
<html>
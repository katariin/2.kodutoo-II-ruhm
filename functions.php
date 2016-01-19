 <?php 
 	//koik AB'iga seonduv 
 	 
 	// uhenduse loomiseks kasuta 
 	require_once("config.php"); 
 	$database = "if15_jekavor"; 
	 
 	// paneme sessiooni kaima, saame kasutada $_SESSION muutujaid 
 	session_start(); 
  
 	 
 	// lisame kasutaja ab'i 
 	function createUser($create_email, $password_hash, $firstname, $lastname){ 
 		// globals on muutuja koigist php failidest mis on uhendatud 
 		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]); 
 		 
		$stmt = $mysqli->prepare("INSERT INTO users_login (email, password, firstname, lastname) VALUES (?, ?, ?, ?)"); 
 		$stmt->bind_param("ssss", $create_email, $password_hash, $firstname, $lastname); 
 		$stmt->execute(); 
 		$stmt->close(); 
 		 
 		$mysqli->close();		 
 	} 
 	 
 	//logime sisse 
	function loginUser($email, $password_hash){ 
 		 
 		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]); 
 		 
 		$stmt = $mysqli->prepare("SELECT id, email FROM users_login WHERE email=? AND password=?"); 
	$stmt->bind_param("ss", $email, $password_hash); 
 		$stmt->bind_result($id_from_db, $email_from_db); 
		$stmt->execute(); 
 		if($stmt->fetch()){ 
 			echo "kasutaja id=".$id_from_db; 
 			 
			$_SESSION["id_from_db"] = $id_from_db; 
 			$_SESSION["user_email"] = $email_from_db; 
 			 
 			//suunan kasutaja data.php lehele 
			header("Location: data.php"); 
 			 
 			 
		}else{ 
 			echo "Wrong password or email!"; 
		} 
 		$stmt->close(); 
 		 
 		$mysqli->close(); 
    } 
	 
 	 

 
 
    	function createFashion($clothes, $brand, $size, $color){
		// globals on muutuja kõigist php failidest mis on ühendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO fashion (clothes, brand, size, color) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("issis", $_SESSION["id_from_db"], $clothes, $brand, $size, $color);
		
		$message = "";
		
		if($stmt->execute()){
			// see on tõene siis kui sisestus ab'i õnnestus
			$message = "Edukalt sisestatud andmebaasi";
			
		}else{
			// execute on false, miski läks katki
			echo $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $message;
		
	}
 	 
 
 
 
?>

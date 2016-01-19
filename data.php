
<?php 

 	require_once("functions.php"); 
 	 
 	//kontrollin, kas kasutaja ei ole sisseloginud 
 	if(!isset($_SESSION["id_from_db"])){ 
 		// suunan login lehele 
 		header("Location: login.php"); 
 	} 
 	 
 	//login valja, aadressireal on ?logout=1 
 //	if(isset($_GET["logout"])){ 
		//kustutab koik sessiooni muutujad 
 	//	session_destroy(); 
		 
 		//header("Location: login.php"); 
 		 
 //	} 
 	 
 $clothes = $brand = $size = $color = $clothes_error = $brand_error = $size_error = $color_error = "";
 	 
 	// et ei ole tuhjad 
 	// clean input 
 	// salvestate 
 
 	if(isset($_POST["create"])){
		
		echo "vajutas create nuppu!";
		
		if ( empty($_POST["clothes"]) ) {
			$clothes_error = "See vali on kohustuslik";
		}else{
			$clothes= cleanInput($_POST["clothes"]);
		}
		
		if ( empty($_POST["brand"]) ) {
			$brand_error = "See vali on kohustuslik";
		}else{
			$brand = cleanInput($_POST["brand"]);
		}
		
		if ( empty($_POST["size"]) ) {
			$size_error = "See vali on kohustuslik";
		}else{
			$size = cleanInput($_POST["size"]);
		}
		
		if ( empty($_POST["color"]) ) {
			$color_error = "See vali on kohustuslik";
		}else{
			$color = cleanInput($_POST["color"]);
		}
  
 		if($clothes_error == "" && $brand_error == "" && $size_error == "" && $color_error == "" ){
 			 
 			// functions.php failis kaivina funktsiooni 
 			// msq on message funktsioonist mis tagasi saadame 
 			$message = createFashion($clothes, $brand, $size, $color);
			
			if($message != ""){
				//salvestamine
				//teen tyhjaks input value's
				$clothes="";
				$brand = "";
				$size= "";
				$color = "";
				
				
				echo $message;
 				 
			} 
			 
 		} 
  
     } // create if end 
 	 
 	function cleanInput($data) { 
 		$data = trim($data); 
 		$data = stripslashes($data); 
 		$data = htmlspecialchars($data); 
 		return $data; 
 	  } 
 	 
 	 
 	 
 ?> 
 
 
 <p> 
 	Tere, <?=$_SESSION["user_email"];?> 
 	<a href="?logout=1"> Logi valja</a> 
 </p> 
 
 
<h2>Lisa riietus</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
   <label for="clothes" >Riietus</label><br>
  <input id="clothes" name="clothes" type="text" value="<?=$clothes; ?>"> <?=$clothes_error; ?><br><br>
    <label>Brand</label><br>
  <input name="brand" type="text" value="<?=$brand; ?>"> <?=$brand_error; ?><br><br>
    <label>Suurus</label><br>
  <input name="size" type="text" value="<?=$size; ?>"> <?=$size_error; ?><br><br>
    <label>Varv</label><br>
  <input name="color" type="text" value="<?=$color; ?>"> <?=$color_error; ?><br><br>
  <input type="submit" name="create" value="save">
  </form>
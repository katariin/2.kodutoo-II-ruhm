<h3>MENU</h3>

<ul>

   <?php if($file_name == "home.php"){ ?>
   
    <li>Kasulik avaleht</li>
	
   <?php } else { ?>
   
	
	<li>
	<a href="home.php">Logi_sisse</a>
	</li>
	
   <?php } ?>
   
   <?php
   
   if($file_name == "vlogin.php") {
	    echo "<li>Logi sisse</li>";
		
   }else{
         echo '<li><a href ="vlogin.php">Logi sisse</li>' ;
   }
   ?>
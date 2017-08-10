<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      
      //$result = mysqli_query($db,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      //$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 
      $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.,"; 
      $validate = true;
      for ($i=0; $i<strlen($mypassword); $i++){ 
         if (strpos($permitidos, substr($mypassword,$i,1))===false){ 
             $validate = false; 
         } 
      } 
    
      if ($validate) {
         
         if (strlen($mypassword) >= 6 && strlen($mypassword) <= 8 && $validate) {
           
           $sql = "INSERT INTO admin (username,passcode) VALUES ( '$myusername','$mypassword')";

           if ($db->query($sql) === TRUE) {
               echo "New record created successfully";
               echo "$myusername";
            } else {
                  echo "Error: " . $sql . "<br>" . $db->error;
            }

            $db->close();
            $_SESSION['login_user'] = $myusername;
           // header("location: welcome.php");
         }
         else{
            $error = "la contraseña debe tener como minimo 6 caracteres y maximo 8";
         }
      }else{
   		$error = "la contraseña debe tener un caracter especial('-_.')";
      }
   }
?>
<html>
   
   <head>
      <title>Sing Up Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Sing up</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>NombreUsuario  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>clave  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
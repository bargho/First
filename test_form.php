<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
<?php




// define variables and set to empty values
$emailErr = $passwordErr = $password2Err = $matchErr = "";
$password = $email = $password2 = "";
$val="";


if (empty($_POST["email"])) {
  $emailErr = "E-mail is required";
   } else {
     $email = test_input($_POST["email"]);
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		$emailErr = "Invalid email format"; 
	}
	}
	
   if (empty($_POST["password"])) {
     $passwordErr = "password is required";
   } 
   
   if (empty($_POST["password2"])) {
     $password2Err = "password is required";
   } 
  if(isset($_POST['submit']))  {
   if (isset($_POST["password"]) && isset($_POST["password2"])){
	if (($_POST["password"] != $_POST["password2"])){
		$matchErr = "Passwords don't match";
		} else {
			$password = test_input($_POST["password"]);
			$password2 = test_input($_POST["password2"]);
			if (($emailErr == "") && ($passwordErr ==  "")){
			// Create connection
$con=mysqli_connect("localhost","root","","mist");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{ echo "connected to SQL";}
$check = "SELECT * FROM name_pass WHERE USERNAME = '$_POST[email]'";
$rs = mysqli_query($con,$check);  
$table_data = mysqli_fetch_array($rs, MYSQLI_NUM); 
if($table_data[0] > 1) {
    echo "User Already in Exists<br/>";
}

else
{
    $newUser="INSERT INTO name_pass(USERNAME,PASSWORD) values('$_POST[email]','$_POST[password]')";
    if (mysqli_query($con,$newUser))
    {
        echo "<br/>You are now registered<br/>";
    }
    else
    {
        echo "<br/>Error adding user in database<br/>";
    }
}
}
}
			}
			
			}
	
		
	
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   
   
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Password:   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
   <input type="password" name="password">
   
   <span class="error">* <?php echo $passwordErr;?></span>
   <br><br>
   Re-enter Password: <input type="password" name="password2">
   <span class="error">* <?php echo $password2Err;?></span>
   <br><br>
   <span class="error"> <?php echo $matchErr;?></span>
   <br><br>
    <input type="submit" name="submit" value="Submit">
	<br><br>
	
	
	
</form>

<?php
//echo "<h2>Your Input:</h2>";
//echo $email;
//echo "<br>";
//echo $password;
//echo "<br>";
//echo $password2;

?>

</body>
</html>
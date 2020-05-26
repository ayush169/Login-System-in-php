<?php

$error = false;
$showError = "";
$showAlert = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_dbconnect.php";
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$username';";
    $result = mysqli_query($conn,$sql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $error = true;
        $showError = "username already exist";
    }
    else{
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `username`, `password`, `date`) VALUES ('$name', '$username', '$hash', current_timestamp());";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
        }
        else{
            $error = true;
            $showError = "password and confirm password do not match! ";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	<link rel="stylesheet" type="text/css" href="css/style.php">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php

    if($error){
		echo "<script type='text/javascript'>alert('$showError');</script>";
    }
    if($showAlert){
        echo "<script type='text/javascript'>alert('account successfully created. you can login now');</script>";
    }

    ?>

	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="signup.php" method = "post">
				<!-- <img src="img/avatar.svg"> -->
                <h2 class="title" style = "white-space: nowrap ;margin-left:-60px">Create an account</h2>
                <div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Name</h5>
           		   		<input type="text" class="input" name = "name" id = "name" spellcheck = "false">
           		   </div>
           		</div>
					<script>
						let name = document.getElementById("name");
						if(name.value = ""){
							name.style.borderColor = "red";
						}
					</script>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name = "username" id = "username" spellcheck = "false">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name = "password" id = "password">
            	   </div>
            	</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Confirm Password</h5>
           		    	<input type="password" class="input" name = "cpassword" id = "cpassword">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
                <button class = "btn" type = "submit">create an account</button>
                <a href="login.php" id = "login" class = "btn">login</a>
            </form>
            
        </div>
    </div>
    <script type="text/javascript" src="js/main.php"></script>
</body>
</html>

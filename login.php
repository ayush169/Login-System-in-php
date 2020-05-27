<?php
$login = false;
$error = false;
$showError = "";
// echo $_SERVER["REQUEST_METHOD"];
if($_SERVER["REQUEST_METHOD"] = "POST"){
	if(isset($_POST['username']) && isset($_POST['password'])){
		include "_dbconnect.php";
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		$sql = "SELECT * FROM `users` WHERE `username` = '$username';";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
		if($num == 1){
			while($row = mysqli_fetch_assoc($result)){
				if(password_verify($password,$row['password'])){
					$login = true;
					session_start();
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['name'] = $row['name'];
					header("location: welcome.php");
				}
				else{
					$showError = "password do not match";
					$error = true;
				}
			}
		}
		else{
			$showError = "invalid username or password";
			$error = true;
		}
	
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="css/style1.php">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php
	if(!$login && $error){
		echo "<script type='text/javascript'>alert('$showError');</script>";
	}
	?>

    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.svg">
        </div>
        <div class="login-content">
            <form id="form" action="login.php" method="post" enctype="multipart/form-data">
                <img src="img/avatar.svg">
                <h2 class="title">login</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" class="input" name="username" id="username">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" id="password" onpaste="return false"
                            onCopy="return false" onCut="return false">
                    </div>
                </div>
                <a>Forgot Password?</a>
                <button class="btn" type="submit">Login</button>
                <a href="signup.php" class="btn" id="signup">Create an account</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.php"></script>
</body>

</html>
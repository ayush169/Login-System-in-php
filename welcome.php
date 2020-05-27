<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.php">
    <title>welcome</title>
</head>

<body>
    <div class="container">
        <header>
            <i class="fa fa-bars" aria-hidden="true"></i>
        </header>
        <main>
            <div class="row">
                <div class="left col-lg-4">
                    <div class="photo-left">
                        <?php

                        include "_dbconnect.php";
                        $name = $_SESSION["name"];
                        $username = $_SESSION["username"];
                        // $sql = "INSERT INTO `image` (`name`, `username`, `pic`, `date`) VALUES ('$name', '$username', 'img/avatar.svg', current_timestamp());";
                        // $result = mysqli_query($conn,$sql);

                        if(isset($_FILES['photo'])){
                            $file = $_FILES['photo'];
                            $filename = $file['name'];
                            $filepath = $file['tmp_name'];
                            $fileerror = $file['error']; 
                            if($fileerror == 0){
                                $destfile = 'upload/' .$filename;
                                move_uploaded_file($filepath,$destfile);
                                $updatequery = "UPDATE `image` SET `pic` = '$destfile' WHERE `image`.`username` = '$username';";
                                $query = mysqli_query($conn,$updatequery);
                            }
                        }
                        $selectquery = "SELECT * FROM `image` WHERE `username` = '$username';";
                        $result = mysqli_query($conn,$selectquery);
                        $num = mysqli_num_rows($result);
                        if($num == 1){
                            $row = mysqli_fetch_array($result);
                            echo '<img id = "image" class="photo" src="'.$row["pic"].'">';
                        }
                        else{
                            echo '<img id = "image" class="photo" src="img/avatar.svg">';
                        }
                        ?>

                        <div class="active">
                        </div>
                    </div>
                    <form action="welcome.php" id="form" method="post" enctype="multipart/form-data">
                        <input type="file" id="photo" name="photo">
                    </form>
                    <h4 class="name"><?php echo $_SESSION["name"]; ?></h4>
                    <p class="info">web developer</p>
                    <p class="info"><?php echo $_SESSION["username"]; ?></p>
                    <div class="stats row">
                        <div class="stat col-xs-4" style="padding-right: 50px;margin-left:40px;">
                            <p class="number-stat">0</p>
                            <p class="desc-stat">Followers</p>
                        </div>
                        <div class="stat col-xs-4" style="margin-right:7px;">
                            <p class="number-stat">42</p>
                            <p class="desc-stat">Following</p>
                        </div>
                        <div class="stat col-xs-4" style="padding-left: 50px;margin-right:56px;">
                            <p class="number-stat">38</p>
                            <p class="desc-stat">Uploads</p>
                        </div>
                    </div>
                    <h3 class="d">Hi ! My name is <?php echo $_SESSION["name"]; ?></h3>
                    <div class="social">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                        <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                        <i class="fa fa-tumblr-square" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="right col-lg-8">
                    <ul class="nav">
                        <li>Gallery</li>
                        <li>Collections</li>
                        <li>Groups</li>
                        <li>About</li>
                    </ul>
                    <span class="follow"><a id="logout" href="logout.php">logout</a></span>
                    <div class="row gallery">
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/1036371/pexels-photo-1036371.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/861034/pexels-photo-861034.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/113338/pexels-photo-113338.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/5049/forest-trees-fog-foggy.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/428431/pexels-photo-428431.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                        <div class="col-md-4">
                            <img
                                src="https://images.pexels.com/photos/50859/pexels-photo-50859.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                        </div>
                    </div>
                </div>
        </main>
    </div>
</body>
<script>
document.getElementById("photo").onchange = function() {
    document.getElementById("form").submit();
};
</script>

</html>
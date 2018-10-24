<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){
    header("index.php");

}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="indexcss.css">
    <title>Account Settings</title>
</head>
<body>
            <!-- Student navbar -->
<div class="sidenav">
        <?php
        require ('navbar.php');
        ?>
            <a href="indexstudent.php">Home</a>
            <a href="market.php">Market</a>
            <a href="portfolio.php">Portfolio</a>
            <a href="Logout.php">Logout</a>
</div>
        <!-- main body -->
<div id="main">
    <?php 
    $name=$_SESSION['id'];
    $q2="select Student_No,fname,initial,lname,sec,password from finmastudents where Student_No='$name'";
    $r2=mysqli_query($conn,$q2);
    $row2=mysqli_num_rows($r2);
    if($row2==1){
    $rows = mysqli_fetch_array($r2);
    ?>
    <h2 class="title">Change Profile information</h2>
    <div class="account">
        <h4>Name</h4>
        <input type="text" name="fname" value="<?php echo $rows['fname']?>" readonly>
        <input type="text" name="fname" value="<?php echo $rows['initial'];?>" readonly>
        <input type="text" name="lname" value="<?php echo $rows['lname'];?>" readonly>
        <input type="text" name="sec" value="<?php echo $rows['sec'];?>" required>
    </div>
    <form action="stupdate.php" method="POST" enctype="multipart/form-data">
        <h4>Change Password</h4>
        </label>
        <input type="password" name="pass" placeholder="Password" required><br>
        <input type="submit" name="upload" value="Update Password" onclick="myFunction()"><br><input type="reset">
    </form>    
    <form action="stupdate.php" method="POST" enctype="multipart/form-data">
        <h4>Profile Picture</h4>
        <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
        <input type="file"  name="pic" >
        </div>
        </div>
        <input type="submit" name="upload" value="Update Picture" onclick="myFunction()">
    </form>  
   <?php
    }
    else{
        $q="select fname,initial,lname,sec,pass from students where Student_No='$name'";
        $r=mysqli_query($conn,$q);
        $row=mysqli_fetch_array($r);
    ?>
        <h2 class="title">Change Profile information</h2>
    <div class="account">
        <h4>Name</h4>
        <input type="text" name="fname" value="<?php echo $row['fname']?>" readonly>
        <input type="text" name="fname" value="<?php echo $row['initial'];?>" readonly>
        <input type="text" name="lname" value="<?php echo $row['lname'];?>" readonly>
        <input type="text" name="sec" value="<?php echo $row['sec'];?>" readonly>
    </div>
    <form action="stupdate.php" method="POST" enctype="multipart/form-data">
        <h4>Change Password</h4>
        </label>
        <input type="password" name="pass" placeholder="Password" required><br>
        <input type="submit" name=upload value="Update Password" onclick="myFunction()"><br><input type="reset">
    </form>    
    <form action="stupdate.php" method="POST" enctype="multipart/form-data">
        <h4>Profile Picture</h4>
        <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
        <input type="file"  name="pic">
        </div>
        </div>
        <input type="submit" name="upload" value="Update Picture">
    </form>  
    <form action="stupdate.php" method="POST" enctype="multipart/form-data">
        <h4>Join Game</h4>
        <input type="text"  name="code" placeholder="Enter Code">
        <input type="submit" name="upload" value="Join Group">
    </form>  
    <?php
    }
   ?>
    </div>   
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
<?php
}
?>
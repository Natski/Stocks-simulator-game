<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="indexstyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Red Stocks|Login</title>
</head>
<body>
<div class="modal-dialog text-center">
    <div class="col-sm-9 main-section">
        <div class="modal-content">
            <div class="col-12 user-img"><img src="user.png" ></div>
    <!-- <div id="name">
    <h1>The Red Stocks</h1>
    </div> -->
    <div class="col-12 form-input">
        <form method="POST" action="login.php">
            <div class="form-group">
            <h4>Username</h4>
            <input type="text" placeholder="UserName" class="form-control" name="id" required>
            </div>
            <div class="form-group">
            <h4>Password</h4>
            <input type="password" placeholder="Password" class="form-control" name="psw" required>
            </div>
            <input type="submit" class="btn btn-success" value="Login">
            <div class="col-12 forgot">
            <a href="regs.html">Create Account</a>
            </div>
            <div class="col-12 forgot">
            <a href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<?php
}
else if(isset($_SESSION['id'])){
   

        $qry="select* from admin where Admin_ID='$_SESSION[id]'";
        $result=mysqli_query($conn,$qry);
        $row=mysqli_num_rows($result);
        $qry1="select * from teacher where Teacher_ID='$_SESSION[id]'";
        $result1=mysqli_query($conn,$qry1);
        $row1=mysqli_num_rows($result1);
        $qry2= "select * from students where Student_No='$_SESSION[id]'";
        $result2=mysqli_query($conn,$qry2);
        $row2=mysqli_num_rows($result2);
        $qry3="select * from finmastudents where Student_No='$_SESSION[id]'";
        $result3=mysqli_query($conn,$qry3);
        $row3=mysqli_num_rows($result3);
        if($row==1){
            header("refresh:0; url=indexadmn.php");
        }
        else if($row1==1)
        {
            header("refresh:0; url=indexteacher.php");
        }
        else if($row2==1)
        {
            header("refresh:0; url=indexstudent.php");
        }
        else if($row3==1)
        {
            header("refresh:0; url=indexstudent.php");
        }
}
?>




<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Red Stocks|Login</title>
</head>
<body>

    <div class="main">

        <!--LEFT COLUMN-->
        <div class="left-col">
            <img src = "img/sbsm.png">
        </div>

        <div class="social1">
            <a href="#"><img src="img/FBLogo.png"></a>
        </div>

        <div class="social2">
            <a href="#"> <img src="img/TwitterLogo.png"></a>
        </div>
                

        <!--RIGHT COLUMN-->
        <div class="right-col">
            <div class="login">
                <p>LOGIN</p>

                <img src="img/icon.png">
                <center>
                <form method="POST" action="login.php">
                    <input type="text" placeholder="UserName" name="id" required>
                    <input type="password" placeholder="Password"  name="psw" required><br>
                    <input type="submit" value="Login">
                </center>
                    <h3 style  = "float:right; padding-right:7%; padding-top:18%"; >
                    Not yet Registered? Create an <a href="regis.php">Account!</a>
                    </h3>
                
                </form>

                 
            </div>
        </div>

    </div>

</body>
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





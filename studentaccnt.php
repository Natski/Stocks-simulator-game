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
  <title>Account Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="student.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">SBSM</a>
            </div>

            <ul class="nav navbar-nav">
            <li class="nav-link"><a href="indexstudent.php">News</a></li>
            <li class="nav-link"><a href="market.php">Market</a></li>
            <li class="nav-link"><a href="portfolio.php">Portfolio</a></li>
            </ul>

            <ul class="nav navbar-nav"><!--SEARCH BAR-->
                <li> 
                <form action="viewstocks.php" method="POST" class="form-inline my-2 my-xs-0" >
                     <input  list="search" class="form-control" name="search" placeholder="Search Stock" style="margin-top: 4% !important;">
                     <datalist id="search" >
                     <?php
                        include 'restapi.php';
                            foreach($metadata as $value){
                                echo '<option  value="' .$value ->{'symbol'}.'">' .$value ->{'name'}.'</option>';
                            }
                    ?> 
                    </datalist>
                </form>
                 </li>
            </ul><!--End search-->

            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="glyphicon glyphicon-user"></span>
                Account <span class="caret"></span></a>

                <ul class="dropdown-menu">
                <?php require ('studentname.php')?>
                <li><a href="studentaccnt.php"><span class="glyphicon glyphicon-user"></span> Account Settings</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </ul>
            </li>
            </ul>

        </div>
    </nav>
    
    <div class="main">
        <div class="modal-content">
        <?php 
    $name=$_SESSION['id'];
    $q2="select Student_No,fname,initial,lname,sec,password from finmastudents where Student_No='$name'";
    $r2=mysqli_query($conn,$q2);
    $row2=mysqli_num_rows($r2);
    if($row2==1){
    $rows = mysqli_fetch_array($r2);
    ?>
            <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Profile Information
                </div>

                <div class="row"><!--Name-->
                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $rows['fname']?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $rows['initial'];?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $rows['lname'];?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" placeholder="Section" value="<?php echo $rows['sec'];?>" required>
                    </div>

                </div>
            </div>

             <form action="stupdate.php" method="POST" enctype="multipart/form-data">
            <div class="row"><!--Password-->
                    <div class="col-sm-2 bg-primary desc">
                        Password
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="password" name="pass" placeholder="Password" required>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" class=" col-sm-1 btn btn-success up" name="upload" value="Update Password" data-toggle="modal">
                            <input type="reset" class=" col-sm-1 btn btn-danger up" value="Reset" data-toggle="modal">
                        </div>     
                    </div>
            </div>
            </form> 


            <div class="row">
            <form action="stupdate.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-2 bg-primary desc">
                        Profile Picture
                    </div>

                    <div class="row">
                        <div class="col-sm-10 bar">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary " role="progressbar"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <input type="file" name="pic" >
                            </div>
                        
                        </div>

                        <div class="col-sm-12">
                                <input type="submit"  class="col-sm-1 btn btn-success up" name="upload" value="Update Picture" onclick="myFunction()">
                        </div>
                    </div>
            </form>         
            </div>
            
            <?php
    }
    else{
        $q="select fname,initial,lname,sec,pass from students where Student_No='$name'";
        $r=mysqli_query($conn,$q);
        $row=mysqli_fetch_array($r);
    ?>

    <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Profile Information
                </div>

                <div class="row"><!--Name-->
                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $row['fname']?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $row['initial'];?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value="<?php echo $row['lname'];?>" readonly>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" placeholder="Section" value="<?php echo $row['sec'];?>" required>
                    </div>

                </div>
            </div>

             <form action="stupdate.php" method="POST" enctype="multipart/form-data">
            <div class="row"><!--Password-->
                    <div class="col-sm-2 bg-primary desc">
                        Password
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="password" name="pass" placeholder="Password" required>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" class=" col-sm-1 btn btn-success up" name=upload value="Update Password" data-toggle="modal">
                            <input type="reset" class=" col-sm-1 btn btn-danger up" value="Reset" data-toggle="modal">
                        </div>     
                    </div>
            </div>
            </form> 


            <div class="row">
            <form action="stupdate.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-2 bg-primary desc">
                        Profile Picture
                    </div>

                    <div class="row">
                        <div class="col-sm-10 bar">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary " role="progressbar"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <input type="file" name="pic" >
                            </div>
                        
                        </div>

                        <div class="col-sm-12">
                                <input type="submit" name="upload" value="Update Picture" class="col-sm-1 btn btn-success up" name="upload" value="Update" onclick="myFunction()">
                        </div>
                    </div>
            </form>         
            </div>
            <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Join Game
                </div>

                <div class="row">
                <form action="stupdate.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-12">
                        <input class="col-sm-3" type="text" name="code" placeholder="Enter Code">
                    </div>
                    
                    <div class="col-sm-12">
                            <input type="submit" name="upload" value="Join Group" class="col-sm-1 btn btn-success up" name="upload" value="Join Group">
                    </div>
                </div>
            </div>
            </form> 
      </div>
      <?php
    }
   ?>
    </div>
</body>
</html>
<?php
}
?>
<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION['id'])){
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
  <link rel="stylesheet" href="teacher.css">
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
            <li class="nav-link"><a href="indexteacher.php">HOME</a></li>
            <li class="nav-link"><a href="afm.php">AFM</a></li>
            <li class="nav-link"><a href="bfm.php">BFM</a></li>
            <li class="nav-link"><a href="cfm.php">CFM</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="glyphicon glyphicon-user"></span>
                Account <span class="caret"></span></a>

                <ul class="dropdown-menu">
                <?php require ('teachername.php')?>
                <li><a href="teacheraccnt.php"><span class="glyphicon glyphicon-user"></span> Account Settings</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </ul>
            </li>
            </ul>

        </div>
    </nav>
    
    <div class="main">
        <div class="modal-content">
       <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Profile Information
                </div>

                <div class="row"><!--Name-->
                <form action="teachchange.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" name="fname" placeholder="First Name" required>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" name="initial" placeholder="Middle Initial" required>
                    </div>

                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" name="lname" placeholder="Last Name" required>
                    </div>
                    <div class="col-sm-12">
                            <input type="submit" name="upload" class=" col-sm-1 btn btn-success up" value="Update teacher Name" data-toggle="modal">
                            <input type="reset" class=" col-sm-1 btn btn-danger up" value="Reset" data-toggle="modal">
            </form>
                    </div>   
                </div>
            </div>
            <form action="teachchange.php" method="POST" enctype="multipart/form-data">
            <div class="row"><!--Teacher ID-->
                <div class="col-sm-2 bg-primary desc">
                    Teacher ID
                </div>

                <div class="row">
                    <div class="col-sm-12">
                            <input class="col-sm-3" type="text" name="ID" class="form-control" placeholder="Teacher ID" required>
                    </div>

                    <div class="col-sm-12">
                            <input type="submit" name="upload" class=" col-sm-1 btn btn-success up" value="Update teacher ID" data-toggle="modal">
                            <input type="reset" class=" col-sm-1 btn btn-danger up" value="Reset" data-toggle="modal">
            </form>
                    </div>   
                </div>
            </div>


            <div class="row"><!--Password-->
            <form action="teachchange.php" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-2 bg-primary desc">
                        Password
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="col-sm-12">
                            <input type="submit" name="upload" value="Update password" class=" col-sm-1 btn btn-success up" value="Update" data-toggle="modal">
                            <input type="reset" class=" col-sm-1 btn btn-danger up" value="Reset" data-toggle="modal">
            </form>
                        </div>     
                    </div>
            </div>

            <div class="row"><!--Generate Code-->
                <div class="col-sm-2 bg-primary desc">
                    Generate Code
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button id="Generate" class="col-sm-2" onclick="code()">
                            Generate
                        </button>
                        <form action="teachchange.php" method="POST" enctype="multipart/form-data">
                        <div id="code">

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <input type="submit" id="sub" style="display:none" name="upload" class=" col-sm-1 btn btn-success up" value="Submit Code" data-toggle="modal">
                    </div>   
                </div>
            </div>


      </div>
    </div>
</body>
<script>
    // button show form group code
    function code(){
        var randomstring = Math.random().toString(36).slice(-8);
        var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("name", "grpcode");
    x.setAttribute("value", randomstring);
    document.getElementById('code').appendChild(x);
    document.getElementById("Generate").disabled = true;
    document.getElementById("sub").disabled = false;
    document.getElementById("sub").style.display = "block";
    }
</script>
</html>
<?php
}
?>
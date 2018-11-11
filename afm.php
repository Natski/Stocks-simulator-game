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
  <title>AFM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="index.css">
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
            <li class="nav-link "><a href="indexteacher.php">Home</a></li>
            <li class="nav-link active "><a href="afm.php">AFM</a></li>
            <li class="nav-link "><a href="bfm.php">BFM</a></li>
            <li class="nav-link "><a href="cfm.php">CFM</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="glyphicon glyphicon-user"></span>
                Account <span class="caret"></span></a>

                <ul class="dropdown-menu">
                <?php require ('teachername.php')?>
                <li><a href="teacheraccnt.php"><span class="glyphicon glyphicon-user"></span> Account Settings</a></li>
                <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </ul>
            </li>
            </ul>

        </div>
    </nav>
    
    <div class="main">
        <div class="modal-content">
            
                <center>
                    <h4 class="fa fa-certificate" style="font-size:36px;color:gold">
                       Top 5 AFM</h4>
                </center>

            <table class="table table-striped table-hover tables">
                    <thead>
                    <tbody>
                    <tr>
                    <th align='center' >Rank</th>
                    <th align='center' >Student Number</th>
                    <th align="center" >Name</th>
                    <th align="center" >Section</th>
                    <th align="center" >Total Cash</th>
                    </tr>
                    </thead>

                    
                    <tr>
                    <?php
                $groupcode=mysqli_query($conn,"select Passcode from teacher where Teacher_ID='$name'") or die ("Failed1". mysqli_error($conn));
                $passcode=mysqli_fetch_array($groupcode);
                $code=$passcode['Passcode'];

                    $display="select finmastudents.Student_No,finmastudents.fname,finmastudents.initial,finmastudents.lname,finmastudents.sec,finmastudents.GroupCode,portfolio.Buying_Power
                    from finmastudents,portfolio where finmastudents.Student_No=portfolio.Student_No 
                    AND finmastudents.sec='3-AFM' AND finmastudents.GroupCode='$code' ORDER BY portfolio.Buying_Power ASC";
                    $try=mysqli_query($conn,$display) or die ("Failed1". mysqli_error($try)) ;
                    $counter=1;
                    while ($records=mysqli_fetch_array($try)){
                        echo '<tr>';
                                echo '<td align="center" >'. $counter. '</td>';
                                echo '<td align="center" >'. $records['Student_No']. '</td>';
                                echo '<td align="center">' . $records['fname'] . ' ' . $records['initial'] . '. ' . 
                                $records['lname'] . '</td>';
                                echo '<td align="center">' . $records['sec'] . '<a> </td>';
                                echo '<td align="center" >' . number_format($records['Buying_Power'],2) . '</td>';
                                echo '<form action="deletestudent.php" method="POST">';
                                echo '<input type="hidden" name="id" value="' .$records['Student_No']. '">';
                                echo '<td><input type="submit" class="btn btn-danger" value="remove" data-toggle="modal" data-target="#exampleModalCenter"></td>';
                                echo '</form>';
                        echo '</tr>';
                    $counter++;
                    if($counter>=6){
                        break;
                    }
                    }
                ?>
                    </tbody>
            </table>


            <!--List of Students-->

            <center><h2>AFM Students</h2></center>

            
            <table class="table table-striped table-hover tables">
                    <thead>
                    <tbody>
                    <tr>
                    <th align='center' >Student Number</th>
                    <th align="center" >Name</th>
                    <th align="center" >Section</th>
                    <th align="center" >Total Cash</th>
                    </tr>
                    </thead>

                    
                    <tr>
                    <?php
                    while ($records=mysqli_fetch_array($try)){
                        echo '<tr>';
                                echo '<td align="center" >'. $records['Student_No']. '</td>';
                                echo '<td align="center">' . $records['fname'] . ' ' . $records['initial'] . '. ' . 
                                $records['lname'] . '</td>';
                                echo '<td align="center">' . $records['sec'] . '<a> </td>';
                                echo '<td align="center" >' . number_format($records['Buying_Power'],2) . '</td>';
                                // form submit to delete
                                echo '<form action="deletestudent.php" method="POST">';
                                echo '<input type="hidden" name="id" value="' .$records['Student_No']. '">';
                                echo '<td><input type="submit" class="btn btn-danger" value="remove" data-toggle="modal" data-target="#exampleModalCenter"></td>';
                                echo '</form>';
                        echo '</tr>';
                    }
                ?>
                    </tbody>
            </table>
      </div>
    </div>
</body>
</html>
<?php
}
?>
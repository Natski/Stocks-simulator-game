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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="indexcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Teacher|Home</title>
</head>
<body>
    <div class="sidenav">
        <?php
            // $query="select *  from students where sec='3-AFM' OR sec='3-BFM' OR sec='3-CFM' ";
            // $result=mysqli_query($conn,$query) or die("Error Occured!". mysqli_error($conn));

            $name=$_SESSION['id'];
            $q="select FName,Mid_initial,LName from teacher where Teacher_ID='$name'";
            $r=mysqli_query($conn,$q);
            $row=mysqli_fetch_array($r);
                echo "<label>Name :";
                echo $row['FName'];
                echo "  ";
                echo $row['Mid_initial'];
                echo ".  ";
                echo $row['LName'];
                echo "</label><br>";
        ?>
         <br><label>Teacher Id :<?=$_SESSION["id"];?></label><br><br>
            <a href="afm.php">AFM</a>
            <a href="BFM.php">BFM</a>
            <a href="CFM.php">CFM</a>
            <!-- <a href="validation.php">Request(<?php 
            // echo mysqli_num_rows($result)?>)</a> -->
            <a href="teacheraccnt.php">Account Settings</a>
            <a href="Logout.php">Logout</a>
    </div>
    <div id="main">
        <center><h2>Over All Highest Profit</h2>
            <h4 class="fa fa-certificate" style="font-size:36px;color:gold">Top 5</h4>
        </center>
        <center>
        <table class="table table-hover table-dark">
            <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Section</th>
                <th>Total Cash</th>
            </tr>    
            
                <?php
                    $display="select finmastudents.Student_No,finmastudents.fname,finmastudents.initial,finmastudents.lname,finmastudents.sec,portfolio.Buying_Power
                    from finmastudents,portfolio where finmastudents.Student_No=portfolio.Student_No  AND 
                    (finmastudents.sec='3-AFM' OR finmastudents.sec='3-BFM' OR finmastudents.sec='3-CFM') ORDER BY portfolio.Buying_Power DESC";
                    $try=mysqli_query($conn,$display) or die ("Failed!". mysqli_error($try)) ;
                    $counter=0;
                    while ($records=mysqli_fetch_array($try)){
                        echo '<tr>';
                                echo '<td align="center" >'. $records['Student_No']. '</td>';
                                echo '<td align="center">' . $records['fname'] . ' ' . $records['initial'] . '. ' . 
                                $records['lname'] . '</td>';
                                echo '<td align="center">' . $records['sec'] . '<a> </td>';
                                echo '<td align="center" >' . number_format($records['Buying_Power'],2) . '</td>';
                                
                        echo '</tr>';
                    $counter++;
                    if($counter>=5){
                        break;
                    }
                    }
                ?>
            
        </table>
                </center>
    </div>
</body>
</html>
<?php
}
?>
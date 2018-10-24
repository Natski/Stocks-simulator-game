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
    <title>Account Settings</title>
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
            <a href="indexteacher.php">Home</a>
            <a href="afm.php">AFM</a>
            <a href="BFM.php">BFM</a>
            <a href="CFM.php">CFM</a>
            <!-- <a href="validation.php">Request(<?php 
            // echo mysqli_num_rows($result)?>)</a> -->
            <a href="Logout.php">Logout</a>
    </div>
    <div id="main">
    <?php 
    $name=$_SESSION['id'];
    $teach="select Fname,Mid_initial,Lname,Password from teacher where Teacher_ID='$name'";
    $teacher=mysqli_query($conn,$teach);
    $row0=mysqli_fetch_array($teacher);
    ?>
    <h2 class="title">Change Profile information</h2>
            <!-- NAME -->
        <div class="account">
        <h4>Name:</h4>
            <input type="text" name="fname" class="form-control" value=<?php echo $row0['Fname']?> readonly>
            <input type="text" name="fname" class="form-control" value="<?php echo $row0['Mid_initial'];?>." readonly>
            <input type="text" name="lname" class="form-control" value=<?php echo $row0['Lname'];?> readonly>
        </div>
        <!-- end Name -->
        <!-- Teacher ID -->
        <h3>Change Information</h3>
    <form action="teachchange.php" method="POST" enctype="multipart/form-data">
    <div class="ID">
    <h4>TeacherID:</h4>
    <input type="text" name="ID" class="form-control" placeholder="Teacher ID" required>
    <input type="submit" name=upload class="form-control" class="btn btn-primary" value="Update teacher ID" onclick="myFunction()"><input class="form-control" class="btn btn-primary" type="reset">
    </div>
    </form>
    <!-- end teacher ID -->
    <!-- change teacher name -->
    <form action="teachchange.php" method="POST" enctype="multipart/form-data">
        <div class="name">
        <h3>Name:</h3>
        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
        <input type="text" name="initial" class="form-control" placeholder="Middle Initial" required>
        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
        <input type="submit" name=upload class="form-control" value="Update teacher Name" onclick="myFunction()"><br><input class="form-control" type="reset">
        </div>
    </form>
    <!-- end teacher name -->
    <!-- change password -->
    <form action="teachchange.php" method="POST" enctype="multipart/form-data">
    <div class="pass">
        <h4>ChangePassword:</h4>
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
        <input type="submit" name=upload class="form-control" value="Update password" onclick="myFunction()"><br><input class="form-control" type="reset">
    </div>
    </form>
    <!-- end password -->
    <!-- generate group code -->
        <h4>Generate new Group Code</h4>
        <button id="Generate" onclick="code()">Generate</button>
            <form action="teachchange.php" method="POST" enctype="multipart/form-data">
                <div id="code">

                </div>
            <input type="submit" id="sub" style="display:none" name="upload" value="Submit Code" disabled>
            </form>
        <!-- end group code -->
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
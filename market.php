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
    <link rel="stylesheet" href="indexcss.css">
    <title>Market</title>
</head>
<body>
        <!-- Nav BAR -->
<div class="sidenav">
        <?php
        require ('navbar.php');?>
            <a href="indexstudent.php">Home</a>
               <a href="portfolio.php">Portfolio</a>
               <a href="studentaccnt.php">Account Settings</a>
               <a href="Logout.php">Logout</a>
    </div>
            <!-- Main Body -->
    <div id="main">
        <?php
            //Select buyin power
        $name=$_SESSION['id'];
        $bp="select Buying_Power from portfolio where Student_No='$name'";
        $qy=mysqli_query($conn,$bp);
        $row=mysqli_fetch_array($qy);
        ?>
        <center>
        <h4>Buying Power</h4>
            <input type="text" placeholder="<?php echo number_format($row['Buying_Power'],2)?>" readonly>
        </center>
            <!-- Search BAr -->
        <form action="order.php" method="POST">
                     <input list="search" name="search">
                     <datalist id="search">
                     <?php
                        include 'restapi.php';
                            foreach($metadata as $value){
                                echo '<option value="' .$value ->{'symbol'}.'">' .$value ->{'name'}.'</option>';
                            }
                    ?> 
                    </datalist>
                <input type="submit" value="search">
        </form>
    </div>
</body>
</html>
<?php
}
?>
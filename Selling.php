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
    <title>ORDER</title>
</head>
<body>
        <!-- Nav BAr -->
<div class="sidenav">
        <?php
        require ('navbar.php');
        // require ('scanapi.php');
        ?>
                <a href="indexstudent.php">Home</a>
               <a href="portfolio.php">Portfolio</a>
               <a href="studentaccnt.php">Account Settings</a>
               <a href="Logout.php">Logout</a>
    </div>
    <!-- end navbar -->
    <!-- main body -->
<div id="main">
    <center>
            <!-- Form sell -->
        <?php
        $label=$_POST['label'];
        $quantity=$_POST['quantity'];
        $date=$_POST['date'];
        // $profit=$_POST['profit'];
        $price=$_POST['price'];
        $gain=$_POST['gain'];
        $symbol=$_POST['sym'];
        ?>
        <form action="sell.php" method="POST">
                Title<input type="text" value=<?php echo $label ?> name="title" readonly>
                Quantity<input type="number" min="1" max="<?php echo $quantity ?>" value="<?php echo $quantity ?>" name="quantity">
                Date Purchased<input type="text" value=<?php echo $date ?> name="date" readonly>
                <input type="hidden" value=<?php echo $price ?> name="price">
                <input type="hidden" value=<?php echo $gain ?> name="gain">
                <input type="hidden" value=<?php echo $symbol ?> name="symbol">
                <input type="submit" value="Sell">
        </form>
     </center>
</div>
<?php
}
?>
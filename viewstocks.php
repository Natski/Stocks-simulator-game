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
  <title>home</title>
</head>
<body>
    <!-- Nav Bar -->
  <div class="sidenav">
        <?php
        require ('navbar.php');?>
            <a href="market.php">Market</a>
            <a href="portfolio.php">Portfolio</a>
            <a href="studentaccnt.php">Account Settings</a>
            <a href="Logout.php">Logout</a>
</div>
    <!-- Main Body -->
<div id="main">
<?php

// require ('scanapi.php');
require ('restapi.php');
$check = true;

while ($check) {
  $input =$_POST['search'];

  for ($counter = 0; $counter < count($metadata); $counter++) {
    $symbol = $metadata[$counter]->{'symbol'};

    if ($input == $symbol) {
      $title = $metadata[$counter]->{'name'};
      $symbol = $metadata[$counter]->{'symbol'};
      $price_currency = $metadata[$counter]->{'price'}->{'currency'};
      $price_amount = $metadata[$counter]->{'price'}->{'amount'};
      $percent_change = $metadata[$counter]->{'percent_change'};
      $volume = $metadata[$counter]->{'volume'};

      $check = false;
      break;
    } else {
      continue;
    }
  }

    if ($counter == count($metadata)) {
    $check = false;
    // $title = 'NONE';
    echo "<script type='text/javascript'>alert('Sorry but the Stock that you searched is not supported here.')</script>";
    header("refresh:0;url=indexstudent.php");
  }
    else{
      ?>   
        <center>
        <!-- Title of the stocks -->
        <h3 class="title">Name: <?php echo $title ?></h3>
        <!-- Price of the stocks -->
        <h3>Price</h3><input type="text" value=
        <?php 
        echo $price_currency;
        echo number_format($price_amount,2);  
        ?> readonly>
            <!-- Percent Change of the stocks -->
        <h3>Percent Change</h3><input type="text" value=<?php echo $percent_change?> readonly>
            <!-- Volume of the stocks -->
        <h3>Volume</h3><input type="text" value=<?php echo number_format($volume,2) ?> readonly>
            <!-- Symbol of the Stocks -->
        <h3>Symbol</h3><input type="text" value=<?php echo $symbol ?> readonly>
        <br>
        <button onclick="goBack()" class="btn btn-outline-secondary">Go Back</button>
        </center>
       <?php 
    }
}
?>
</div>
</body>
<script>
        function goBack() {
      window.history.back();
      }
    </script>  
</html>
<?php
}
?>
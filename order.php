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
        require ('navbar.php');?>
                <a href="indexstudent.php">Home</a>
               <a href="portfolio.php">Portfolio</a>
               <a href="studentaccnt.php">Account Settings</a>
               <a href="Logout.php">Logout</a>
    </div>
            <!-- Main Body -->
    <div id="main">
    <?php
//     require ('scanapi.php');
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
        header("refresh:0;url=market.php");
      }
        else{
    $name=$_SESSION['id'];
    $bp="select Buying_Power from portfolio where Student_No='$name'";
    $qy=mysqli_query($conn,$bp);
    $row=mysqli_fetch_array($qy);
    ?>
    <center>
            <!-- Form Order -->
            <h4>Buying Power</h4>
                <input type="text" placeholder="<?php echo number_format($row['Buying_Power'],2)?>" readonly>
        <form action="procsorder.php" method="POST">
                <input type="text" value=<?php echo $title ?> name="title" readonly>
                <input type="text" value=<?php echo $symbol ?> name="symbol" hidden>
                <h4>Price</h4>
                <input type="text" value=<?php echo number_format($price_amount,2) ?> name="price" readonly>
                <h4>Quantity</h4>
                <input type="number" min="1" name="quantity">
                <input type="submit" value="BUY">
        </form>
     </center>
<?php
        }
}
?>
    </div>
</body>
</html>
<?php
}
?>
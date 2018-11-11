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
  <title>ViewStocks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                <?php require('studentname.php')?>
                <li><a href="studentaccnt.php"><span class="glyphicon glyphicon-user"></span> Account Settings</a></li>
                <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </ul>
            </li>
            </ul>

        </div>
    </nav>
    
    <div class="main">
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
        <div class="modal-content">

                <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Name
                    </div>
        
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=<?php echo $title ?> readonly>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Price
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=
                    <?php 
                        echo $price_currency;
                        echo number_format($price_amount,2);  
                    ?> readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Percent Change
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=<?php echo $percent_change?> readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Volume
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=<?php echo number_format($volume,2) ?> readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Symbol
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=<?php echo $symbol ?> readonly>
                        </div>
                    </div>
                </div>

                <a href="index.php" class="btn btn-danger " style ="margin-left:33px;" >
                <span class="fa fa-download mr-2"></span>
                Back</a>
        </div>
    </div>
    <?php 
    }
}
?>
</body>
</html>
<?php
}
?>
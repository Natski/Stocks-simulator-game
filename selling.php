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
  <title>Order</title>
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
        $label=$_POST['label'];
        $quantity=$_POST['quantity'];
        $date=$_POST['date'];
        // $profit=$_POST['profit'];
        $price=$_POST['price'];
        $gain=$_POST['gain'];
        $symbol=$_POST['sym'];
        ?>
        <form action="Sell.php" method="POST">
            <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Title
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <input class="col-sm-4" type="text" value=<?php echo $label ?> name="title" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Quantity
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="number" min="1" max="<?php echo $quantity ?>" value="<?php echo $quantity ?>" name="quantity">
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Date Purchased
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="col-sm-3" type="text" value=<?php echo $date ?> name="date" readonly>
                        </div>
                        <input type="hidden" value=<?php echo $price ?> name="price">
                        <input type="hidden" value=<?php echo $gain ?> name="gain">
                        <input type="hidden" value=<?php echo $symbol ?> name="symbol">
                        <div class="col-sm-12">
                            <input type="submit" class=" col-sm-3 btn btn-danger up" value="Sell" data-toggle="modal" style="margin-left: 50px;">
                        </div>   
                        
                    </div>
                </form>
            </div>
      </div>
    </div>
</body>
</html>
<?php
}
?>
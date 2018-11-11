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
  <title>Market</title>
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
            <li class="nav-link active"><a href="market.php">Market</a></li>
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
                <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </ul>
            </li>
            </ul>

        </div>
    </nav>
    
    <div class="main">
        <div class="modal-content">
        <?php
            //Select buying power
        $name=$_SESSION['id'];
        $bp="select Buying_Power from portfolio where Student_No='$name'";
        $qy=mysqli_query($conn,$bp);
        $row=mysqli_fetch_array($qy);
        ?>
            <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Buying Power
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="col-sm-4" placeholder="<?php echo number_format($row['Buying_Power'],2)?>">
                    </div>
                </div>
            </div>


          <div class="row">
            <div class="col-sm-2 bg-primary desc">
                    Search Stocks
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
            <form action="order.php" method="POST">
                     <input type="text" list="search" name="search" class="col-sm-3 input1">
                     <datalist id="search">
                     <?php
                        include 'restapi.php';
                            foreach($metadata as $value){
                                echo '<option value="' .$value ->{'symbol'}.'">' .$value ->{'name'}.'</option>';
                            }
                    ?> 
                    </datalist>
                    <input type="submit" class="col-sm-1 btn-success search " name="upload" value="Search">
            </form>
           </div>
          </div>
        
      </div>
    </div>

</body>
</html>
<?php
}
?>
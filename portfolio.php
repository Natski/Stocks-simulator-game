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
  <title>Portfolio</title>
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
            <li class="nav-link "><a href="market.php">Market</a></li>
            <li class="nav-link active"><a href="portfolio.php">Portfolio</a></li>
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
            
            $name=$_SESSION['id'];
            //update total profit
            $up="update portfolio, (select Profit,sum(Profit) as pro from history where Student_No='$name') as p 
            SET portfolio.Total_Profit=p.pro
            where portfolio.Student_No='$name'";
            $update=mysqli_query($conn,$up);
            //select
            $qy="select Buying_Power,Total_Profit from portfolio where Student_No='$name'";
            $res=mysqli_query($conn,$qy);
            $row=mysqli_fetch_array($res);
            if (!$res) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            ?>
            <div class="row">
                <div class="col-sm-2 bg-primary desc">
                    Buying Power
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="col-sm-4" placeholder="<?php echo number_format($row['Buying_Power'],2)?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-2 bg-primary desc">
                        Total Profit
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <input  type="text" class="col-sm-4" placeholder="<?php echo number_format($row['Total_Profit'],2)?>" readonly>
                        </div>
                    </div>
            </div>

            <table class="table table-striped table-hover tables">
                    <thead>
                    <tbody>
                    <tr>
                    <th align='center' >Name</th>
                    <th align="center" >Quantity</th>
                    <th align="center" >Date Purchased</th>
                    <th align="center" >Profit</th>
                    <th align="center" > </th>
                    </tr>
                    </thead>

                    <tr>
                    <?php
         // $rows=mysqli_fetch_array($view);
        $sel="select  Name,Symbol,Quantity,Date_purchase,AmountShares from history where Student_No='$name'";
        $view=mysqli_query($conn,$sel);
        if (!$view) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
            }
        
        while($row1 = mysqli_fetch_array($view)) {
            $get=$row1['Symbol'];

                require ('restapi.php');
                $check = true;
                while ($check) {

                for ($counter = 0; $counter < count($metadata); $counter++) {
                    $symbol = $metadata[$counter]->{'symbol'};

                    if ($get == $symbol) {
                    $price_amount = $metadata[$counter]->{'price'}->{'amount'};
                                $gain=$row1['AmountShares'];
                                $piece=$row1['Quantity'];
                                $gndshares=floor($price_amount*$piece);
                                $sample=$gndshares-$gain;
                                // form submit to sell and display the stack status
                        echo '<form action="selling.php" method="POST">';
                        echo '<tr>';
                                echo '<td align="center" >'.$row1['Name']. ' </td>';
                                echo '<input type="hidden" name="label" value="' .$row1['Name']. '">';
                                echo '<input type="hidden" name="sym" value="' .$symbol. '">';
                                echo '<td align="center">' . $row1['Quantity'] . '</td>';
                                echo '<input type="hidden" name="quantity" value="' .$row1['Quantity']. '">';
                                echo '<td align="center">' . $row1['Date_purchase'] . ' </td>';
                                echo '<input type="hidden" name="date" value="' .$row1['Date_purchase']. '">';
                                echo '<td align="center" >' . number_format($sample ,2) . ' </td>';
                                echo '<input type="hidden" name="price" value="' .$price_amount. '">';
                                echo '<input type="hidden" name="gain" value="' .$gain. '">';
                                echo '<td><input type="submit" class="btn btn-danger" value="Sell" data-toggle="modal" data-target="#exampleModalCenter"></td>';
                            
                        echo '</tr>';
                       echo '</form>';
                        $check = false;
                    break;
                    } else {
                    continue;
                    }
                }
                
                if ($counter == count($metadata)) {
                    $check = false;
                    $title = 'NONE';
                }
                
                }
                }   
                ?>
                        <!-- <td>Jollibee Corp.</td>
                        <td>1</td>
                        <td>November 1, 2018</td>
                        <td>9,999</td>
                        <td><input type="submit" class="btn btn-danger" value="Sell" data-toggle="modal" data-target="#exampleModalCenter"></td>
                    </tr> -->
                
                    </tbody>
            </table>


         
        </div>
    </div>
</body>
</html>
<?php
}
?>
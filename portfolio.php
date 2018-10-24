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
    <title>Portfolio</title>
</head>
<body>
        <!-- Student NAV BAR -->
    <div class="sidenav">
    <?php
        require ('navbar.php');?>
            <a href="indexstudent.php">Home</a>
            <a href="market.php">Market</a>
            <a href="studentaccnt.php">Account Settings</a>
            <a href="Logout.php">Logout</a>
    </div>
            <!-- MAin Body -->
    <div id="main">
    <?php
            
            $name=$_SESSION['id'];
            //update total profit
            $up="update portfolio, (select Profit,sum(Profit) as pro from history where Student_No='$name') as p 
            SET portfolio.Total_Profit=p.pro
            where portfolio.Student_No='$name'";
            $update=mysqli_query($conn,$up);
            //select
            $qy="select Buying_Power,Total_Profit,Cashplustotal from portfolio where Student_No='$name'";
            $res=mysqli_query($conn,$qy);
            $row=mysqli_fetch_array($res);
            if (!$res) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
                        // Buying Power
                echo "<h4>Buying Power</h4>";
                echo "<input type='text' placeholder='". number_format($row['Buying_Power'],2). "' readonly>";
                echo "<br><br> ";
                        // Total Profit
                echo "<h4>Total Profit</h4>";
                echo "<input type='text' placeholder='".number_format($row['Total_Profit'],2)."' readonly>";
                echo "<br><br> ";

            ?>
    </div>
            <!-- Stack status of the students -->
            <!-- table -->
    <div class="portfolio">
        <table class="table table-hover table-dark">
        <tr>
        <th align='center' >Name</th>
        <th align="center" >Quantity</th>
        <th align="center" >Date Purchased</th>
        <th align="center" >Profit</th>

        </tr>
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

                        // $slct="select  Name,Symbol,Quantity,AmountShares from history where Student_No='$name' ";
                        //         $cal=mysqli_query($conn,$slct);    
                        //         //Get amount purchased
                        //         $row0 = mysqli_fetch_array($cal);
                                $gain=$row1['AmountShares'];
                                $piece=$row1['Quantity'];
                                $gndshares=($price_amount*$piece)-$gain;
                                // form submit to sell and display the stack status
                        echo '<form action="Selling.php" method="POST">';
                        echo '<tr>';
                                echo '<td align="center" >'.$row1['Name']. ' </td>';
                                echo '<input type="hidden" name="label" value="' .$row1['Name']. '">';
                                echo '<input type="hidden" name="sym" value="' .$symbol. '">';
                                echo '<td align="center">' . $row1['Quantity'] . '</td>';
                                echo '<input type="hidden" name="quantity" value="' .$row1['Quantity']. '">';
                                echo '<td align="center">' . $row1['Date_purchase'] . ' </td>';
                                echo '<input type="hidden" name="date" value="' .$row1['Date_purchase']. '">';
                                echo '<td align="center" >' . $gndshares . ' </td>';
                                echo '<input type="hidden" name="price" value="' .$price_amount. '">';
                                echo '<input type="hidden" name="gain" value="' .$gain. '">';
                                echo '<td><input type="submit" class="btn btn-outline-danger" value="Sell" data-toggle="modal" data-target="#exampleModalCenter"></td>';
                            
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
                echo '</table>';
        ?>
        </div>
                <!-- end table -->
  </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
<?php
}
?>
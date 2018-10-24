<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){
    header("index.php");
}
else{
$title=$_POST['title'];
$price=$_POST['price'];
$quatity=$_POST['quantity'];
$sym=$_POST['symbol'];


   
    $name=$_SESSION['id'];
    //Get Profit from stock data
    $profit="select amount from stock_data where name='$sym'";
    $que=mysqli_query($conn,$profit);
    $row1=mysqli_fetch_array($que);
    $shrs=$row1['amount'];
    //Buying Power
    $bp="select Buying_Power from portfolio where Student_No='$name'";
    $qy=mysqli_query($conn,$bp);
    $row=mysqli_fetch_array($qy);
    $BP=$row['Buying_Power'];
    //select history table
    $hist="select AmountShares from history where Name='$sym' AND Student_No='$name'";
    $com=mysqli_query($conn,$hist);
    $row2=mysqli_fetch_array($com);
    $pro=$row2['AmountShares'];
    // Get current postion
    $pos="select Quantity from history where Name='$sym' AND Student_No='$name'";
    $upd=mysqli_query($conn,$pos);
    $row3=mysqli_fetch_array($upd);
    $sum=$row3['Quantity'];
    

    //formula
        $amount=$price*$quatity;//new amount
        $uppos=$sum+$amount;//update position
        $total=$BP-$amount;
        $shares=(($price-$shrs)*$quatity);
        $currntshrs=$shares+$pro;

    $query="update portfolio SET Buying_Power='$total' where Student_No='$name'";
    $result=mysqli_query($conn,$query);

    $slc="select Symbol from history where Symbol='$sym' AND Student_No='$name'";
    $res=mysqli_query($conn,$slc);
    $row4=mysqli_fetch_array($res);


        // date_default_timezone_set("");
        $date=new DateTime('now', new DateTimeZone('Asia/Hong_Kong'));
        $DNT=$date->format("d/m/y h:i:A");
        $insrt="insert into history values ('$title','$sym','$quatity','$DNT','$amount','$name')";
        $ans=mysqli_query($conn,$insrt) or die("Insert Failed!". mysqli_error($conn));
        
   
    echo "<script type='text/javascript'>alert('Order Complete!')</script>";
    header("location:market.php");
}
//  if($sym==$row4['Symbol']){
//         $updt="update history SET Position='$uppos', Profit='$currntshrs' where Student_No='$name' AND Symbol='$sym'";
//         $up=mysqli_query($conn,$updt) or die("Insert Failed!". mysqli_error($conn));
//     }
//     else{
?>
 
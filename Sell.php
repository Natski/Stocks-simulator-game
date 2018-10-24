<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){
    header("index.php");

}
else{
    $snum=$_SESSION['id'];
    $price=$_POST['price'];
    $gain=$_POST['gain'];
    $quantity=$_POST['quantity'];
    $symbol=$_POST['symbol'];
    $profit =($price*$quantity)-$gain;

    $name=$_POST['title'];
    $get="select Buying_Power,Total_Profit from portfolio where Student_No='$snum'";
    $res=mysqli_query($conn,$get);
    $update=mysqli_fetch_array($res);
    $buypwr=$update['Buying_Power'];
    $tcsh=$update['Total_Profit'];

    $query=mysqli_query($conn,"select * from history where Symbol='$symbol' AND Student_No='$snum'");
    $get1=mysqli_fetch_array($query);
    $pastquantity=$get1['Quantity'];
    $shrs=$get1['AmountShares'];

    $new=($buypwr+$profit);
    // $total=($gain+$profit);
    $pft=($tcsh+$profit);
                   
                        $sql="update portfolio SET Buying_Power='$new',Total_Profit='$pft' where Student_No='$snum'";
                        $sum=mysqli_query($conn,$sql);

                        if($quantity==$pastquantity){
                        $delete="delete from history where Name='$name'";
                        $push=mysqli_query($conn,$delete);
                        header("Location: portfolio.php");
                        }
                        else{
                            $qunt=$pastquantity-$quantity;
                            $set=$shrs/$pastquantity;
                            $currentshrs=$set*$quantity;
                            $sql1="update history SET Quantity='$qunt',AmountShares='$currentshrs' where Student_No='$snum' AND Symbol='$symbol'";
                            $sum1=mysqli_query($conn,$sql1);
                            header("Location: portfolio.php");
                        }
       
}    
?>
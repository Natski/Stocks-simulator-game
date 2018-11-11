<?php

require ('Connection.php');


$stnum=$conn->escape_string($_POST['student']);
$fname=$conn->escape_string($_POST['sfname']);
$in=$conn->escape_string($_POST['sinitial']);
$lname=$conn->escape_string($_POST['slname']);
$sec=$_POST['sec'];
$pass=$conn->escape_string($_POST['spass']);
$ren=$conn->escape_string($_POST['sren']);

    if($ren==$pass){
        $query="select Student_No from students where Student_No='$stnum'";
        $sequel=mysqli_query($conn,$query);
        $match=mysqli_num_rows($sequel);
        if($match==1){
            echo "<script type='text/javascript'>alert('Sorry but the Student Number that you entered already exists')</script>";
            header("refresh:0;url=regs.html");
        }
        else{
        $qry="insert into students (Student_No,fname,initial,lname,sec,pass)values 
        ('$stnum','$fname','$in','$lname','$sec',PASSWORD('$pass'))";
        $result=mysqli_query($conn,$qry) 
        or die("Failed to Query students" . mysqli_error($conn)) ;

        $q="insert into portfolio (Student_No,Buying_Power) values ('$stnum','1000000')";
        $res=mysqli_query($conn,$q) 
        or die("Failed to Query portfolio" . mysqli_error($conn)) ;
        header("refresh:0;url=index.php");
        }
    }else{
     echo "Password didn't match <br> Please try again";
     header("refresh:2;url=regs.html");
    }    
    mysqli_close($conn);
?>
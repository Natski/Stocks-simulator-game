<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION['id'])){
    header("index.php");
}
else{

    $id=$_POST['id'];

    $query=mysqli_query($conn,"select * from finmastudents where Student_No='$id'");
            $name=mysqli_fetch_array($query);
            $stnum=$name['Student_No'];
            $fname=$name['fname'];
            $in=$name['initial'];
            $lname=$name['lname'];
            $sec=$name['sec'];
            $pass=$name['password'];
            $img=$name['image'];

    $quer0=mysqli_query($conn,"insert into students VALUES('$stnum','$fname','$in','$lname','$sec','$pass','$img')") or die (mysqli_error($conn));

    $query1=mysqli_query($conn,"delete from finmastudents where Student_No='$id'") or die (mysqli_error($conn));

    if($sec=='3-AFM'){
        header('Location: afm.php');
    }
    else if($sec=='3-BFM'){
        header('Location: BFM.php');
    }
    else if($sec=='3-CFM'){
        header('Location: CFM.php');
    }
    else{
        echo 'Error Occured';
    }
}
?>
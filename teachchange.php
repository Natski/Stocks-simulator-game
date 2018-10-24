<?php
 session_start();
require ('Connection.php');
 if(!isset($_SESSION["id"])){
     header("index.php");
 }
 else{
$admin=$_SESSION['id'];

    switch($_POST['upload']){
        case 'Update teacher ID':
            $id=$conn->escape_string($_POST['ID']);

            $query=mysqli_query($conn,"update teacher set Teacher_ID='$id' where Teacher_ID='$admin'") or die (mysqli_error($conn));
            echo "<script type='text/javascript'>alert('ID has been Change Successfully!')</script>";
            header("refresh:0;url=teacheraccnt.php");
            mysqli_close($conn);
        break;

        case 'Update teacher Name':
            $fname=$conn->escape_string($_POST['fname']);
            $initial=$conn->escape_string($_POST['initial']);
            $lname=$conn->escape_string($_POST['lname']);

            $query0=mysqli_query($conn,"update teacher set Fname='$fname',Mid_initial='$initial',Lname='$lname' where Teacher_ID='$admin'") or die (mysqli_error($conn));
            echo "<script type='text/javascript'>alert('Your name has been Change Successfully!')</script>";
            header("refresh:0;url=teacheraccnt.php");
            mysqli_close($conn);
            break;

        case 'Update password':
            $pass=$conn->escape_string($_POST['pass']);

            $queary1=mysqli_query($conn,"update teacher set Password=PASSWORD('$pass') where Teacher_ID='$admin'") or die (mysqli_error($conn));
            echo "<script type='text/javascript'>alert('Your password has been Change Successfully!')</script>";
            header("refresh:0;url=teacheraccnt.php");
            mysqli_close($conn);
            break;
        
        case 'Submit Code':
            $code=$conn->escape_string($_POST['grpcode']);

            $query2=mysqli_query($conn,"update teacher set Passcode='$code' where Teacher_ID='$admin'") or die (mysqli_error($conn));
            echo '<script type="text/javascript">alert("'.$code. '\n You have Successfully generate your Group code! \n Please save this because this will never show again.")</script>';
            header("refresh:0;url=teacheraccnt.php");
            mysqli_close($conn);
        break;
    }


 }
 ?>
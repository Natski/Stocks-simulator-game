<?php
    require ('Connection.php');

    $user=$conn->escape_string($_POST['id']);
    $pasw=$conn->escape_string($_POST['psw']);
        //admin
        $qry="select* from admin where Admin_ID='$user' AND Password=PASSWORD('$pasw')";
        $result=mysqli_query($conn,$qry);
        $adminid=mysqli_fetch_array($result);
        $adid=$adminid['Admin_ID'];
        //teachers
        $query="select * from teacher where Teacher_ID='$user' AND Password=PASSWORD('$pasw')";
        $results=mysqli_query($conn,$query);
        $teachid=mysqli_fetch_array($results);
        $tid=$teachid['Teacher_ID'];
        //3rd yr finma students
        $queryfin="select * from finmastudents where Student_No='$user' AND Password=PASSWORD('$pasw')";
        $reslts=mysqli_query($conn,$queryfin);
        $finma=mysqli_fetch_array($reslts);
        $verify=$finma['Student_No'];

    if($user==$adid){
        
        $row=mysqli_num_rows($result);
        if($row==1){
            session_start();
            $_SESSION['id']=$user;
            header("refresh:0; url=indexadmn.php");
        }else{
            echo "Invalid Admin ID or Password <br> Please try again";
            header("refresh:1; url=index.html");
        }
    }
    else if($user== $tid){
        
        $row=mysqli_num_rows($results);
        if($row==1){
        session_start();
        $_SESSION['id']=$user;
        header("refresh:0; url=indexteacher.php");
        }else{
        echo "Invalid Teacher ID or Password <br> Please try again";
        header("refresh:2; url=index.html");
        }
    }else if($user== $verify){
        $row1=mysqli_num_rows($reslts);
        if($row1==1){
            session_start();
            $_SESSION['id']=$user;
            header("refresh:0; url=indexstudent.php");
        }else{
            echo "pwet";
        }
    }
    else{
        $qry= "select * from students where Student_No='$user' AND pass=PASSWORD('$pasw')";
        $result=mysqli_query($conn,$qry);
        $row=mysqli_num_rows($result);
        
            if($row==1){
                session_start();
                // date_default_timezone_set("Asia/Hong_Kong");
                // $time=date("h:i:sa");
                $date=new DateTime('now', new DateTimeZone('Asia/Hong_Kong'));
                $time=$date->format("h:i:A");
                $insert="insert into Session_Table values('$user','$time')";
                $res=mysqli_query($conn,$insert);
                $_SESSION['id']=$user;
                header("refresh:0; url=indexstudent.php");
            }
            else{
                echo "Invalid Student Number or Password <br> 
                Please try again";
                header("refresh:2; url=index.html");
            } 
    }
    mysqli_close($conn);
?>
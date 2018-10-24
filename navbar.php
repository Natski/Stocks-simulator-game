
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body>
<?php
        //    Navigation Bar of Students
           $name=$_SESSION['id'];
           $q2="select Student_No,fname,initial,lname from finmastudents where Student_No='$name'";
           $r2=mysqli_query($conn,$q2);
            $row2=mysqli_num_rows($r2);

           if($row2==1){
            $qr2="select image from finmastudents where Student_No='$name'";
            $rw2=mysqli_query($conn,$qr2);
            $rows = mysqli_fetch_array($rw2);

                echo "<img src='images/". $rows['image'] . "' style='border-radius:50%;' height='80' width='80'> <br>";

                    $records=mysqli_fetch_array($r2);
                        echo "<label>Name : ";
                        echo $records['fname'];
                        echo " ";
                        echo $records['initial'];
                        echo ". ";
                        echo $records['lname'];
                        echo "</label><br>";
           }else{
           $q="select fname,initial,lname from students where Student_No='$name'";
           $r=mysqli_query($conn,$q);

           $qr="select image from students where Student_No='$name'";
           $rw=mysqli_query($conn,$qr);
           $row1 = mysqli_fetch_array($rw);

            echo "<img src='images/". $row1['image'] . "' style='border-radius:50%;' height='80' width='80'> <br>";

           $row=mysqli_fetch_array($r);
               echo "<label>Name : ";
               echo $row['fname'];
               echo " ";
               echo $row['initial'];
               echo ". ";
               echo $row['lname'];
               echo "</label><br>";
            }
           ?>
           <label>Student Number :<?=$_SESSION['id'];?></label><br><br>
</body>
</html>

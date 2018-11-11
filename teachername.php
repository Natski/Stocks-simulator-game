<?php
            $name=$_SESSION['id'];
            $q="select FName,Mid_initial,LName from teacher where Teacher_ID='$name'";
            $r=mysqli_query($conn,$q);
            $row=mysqli_fetch_array($r);
                echo "<label>";
                echo $row['FName'];
                echo "  ";
                echo $row['Mid_initial'];
                echo ".  ";
                echo $row['LName'];
                echo "</label><br>";
        ?>
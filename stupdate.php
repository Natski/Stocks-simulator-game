 <?php
 session_start();
require ('Connection.php');
 if(!isset($_SESSION["id"])){
     header("index.php");
 }
 else{
        
        $user=$_SESSION['id'];
        switch($_POST['upload']){
        case 'Update Password':
            $pass=$conn->escape_string($_POST['pass']);
            $qry="select Student_No from finmastudents";
            $results=mysqli_query($conn,$qry);
            $scan=mysqli_num_rows($results);
            
                if($scan==$user){
                    $query0=mysqli_query($conn,"update finmastudents set password=PASSWORD('$pass') where Student_No='$user' ") or die (mysqli_error($conn));
                    echo "<script type='text/javascript'>alert('Password has been Change')</script>";
                    header("refresh:0;url=studentaccnt.php");
                    mysqli_close($conn);
                }else{
                    $query=mysqli_query($conn,"update students set pass=PASSWORD('$pass') where Student_No='$user' ") or die (mysqli_error($conn));
                    echo "<script type='text/javascript'>alert('Password has been Change')</script>";
                    header("refresh:0;url=studentaccnt.php");
                    mysqli_close($conn);
                }
        break;

        case 'Update Picture':
        // else if($_POST['uploadpic']){
                $qry0="select Student_No from finmastudents where Student_No='$user'";
                $results0=mysqli_query($conn,$qry0);
                $scan0=mysqli_num_rows($results0);
                    if($scan0==1){     
                                $target="images/".basename($_FILES['pic']['name']);
                                $image=$_FILES['pic']['name'];
                                $query1=mysqli_query($conn,"update finmastudents set image='$image' where Student_No='$user' ") or die (mysqli_error($conn));

                                if(move_uploaded_file($_FILES['pic']['tmp_name'], $target)){
                                        echo "<script type='text/javascript'>alert('Profile Pic Changed')</script>";
                                        header("refresh:0;url=studentaccnt.php");
                                        mysqli_close($conn);
                                }else{
                                    echo "<script type='text/javascript'>alert('File is not supported(This only is supported by .jpg and .png)')</script>";
                                    header("refresh:0;url=studentaccnt.php");
                                }
                        }
                        else{
                                $target="images/".basename($_FILES['pic']['name']);
                                $image=$_FILES['pic']['name'];
                                $query1=mysqli_query($conn,"update students set image='$image' where Student_No='$user' ") or die (mysqli_error($conn));
                                if(move_uploaded_file($_FILES['pic']['tmp_name'], $target)){
                                        echo "<script type='text/javascript'>alert('Profile Pic Changed')</script>";
                                        header("refresh:0;url=studentaccnt.php");
                                        mysqli_close($conn);
                                }else{
                                    echo "<script type='text/javascript'>alert('File is not supported(This  is only supported by .jpg and .png)')</script>";
                                    header("refresh:1; url=studentaccnt.php");
                                }
                                
                        } 
            break;

            case 'Join Group':
            $code=$_POST['code'];
            $query2=mysqli_query($conn,"select Passcode from teacher where Passcode='$code'");
            $codes=mysqli_fetch_array($query2);

            $query3=mysqli_query($conn,"select * from students where Student_No='$user'");
            $name=mysqli_fetch_array($query3);
            $stnum=$name['Student_No'];
            $fname=$name['fname'];
            $in=$name['initial'];
            $lname=$name['lname'];
            $sec=$name['sec'];
            $pass=$name['pass'];
            $img=$name['image'];
                if(isset($codes)){
                    $int="insert into finmastudents Values('$stnum','$fname','$in','$lname','$sec','$code','$pass','$img')";
                    $query=mysqli_query($conn,$int) or die("Error Occured!". mysqli_error($conn)) or die (mysqli_error($conn));

                    $del="delete from students where Student_No='$stnum'";
                    $remove=mysqli_query($conn,$del) or die("Error Occured!". mysqli_error($conn)) or die (mysqli_error($conn));
                    echo "<script type='text/javascript'>alert('Joined Group!')</script>";
                    header('refresh:0;url=studentaccnt.php');
                }
                else{
                    echo "<script type='text/javascript'>alert('Group Code does not exist')</script>";
                    header("refresh:0;url=studentaccnt.php");
                    mysqli_close($conn);
                }
            break;
            }
           
}
?>    
<?php
session_start();
if ($_POST['yesverified']!="verified") {
  header('location:../html_part/mainpage.html');
}

else
{
    $databasename="Student";
    $databasehost="localhost";
    $databasepassword="Getachew";
    $databaseusername="Getachew";
    $connection=new mysqli($databasehost,$databaseusername,$databasepassword,$databasename);
    if (mysqli_connect_error()) {
        echo "Error";
    }

    else
    {
         $department = $_SESSION['department'];
         $selectstatment = "select * from $department";
         $result=$connection->query($selectstatment);
         $newpassword= $_POST['newpassword'];
         $oldpassword=$_SESSION['password'];

        if ($result->num_rows!=0) {
            $innerstatment=$connection->query("update $department set password = '$newpassword' where password = '$oldpassword'");
            if ($innerstatment) {
                echo "updated";
                $_SESSION['password']=$newpassword;
            }
            else
            {
                echo "Error";
            }
        }
        else
        {
            echo "Error";
        }
    }
}
?>

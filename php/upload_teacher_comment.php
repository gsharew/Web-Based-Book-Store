<?php
session_start();
if ($_POST['yesverified2']!="comment") {
  header('location:../html_part/mainpage.html');
}

else
{
    $databasename="Instructor";
    $databasehost="localhost";
    $databasepassword="Getachew";
    $databaseusername="Password";
    $connection=new mysqli($databasehost,$databaseusername,$databasepassword,$databasename);
    if (mysqli_connect_error()) {
        echo "Error";
    }
    else {
        
    	$username=$_SESSION['username1'];
    	$department=$_SESSION['department1'];
    	$comment=$_POST['comment'];
        $commented_date=date('d-m-Y');
        if ($username=="" || $department=="") {
          echo "error";
        }

        else
        {
          $counter=0;
          $result= $connection->query("select * from instructor_comment");
         while ($row=$result->fetch_assoc())
         {
            if ($row['username']==$username) {
                $counter++;
            }
         }

         if ($counter>=3) {
             echo "more_than_trial";
         }
         else {
        $statment = "insert into instructor_comment values('$username','$department','$comment','$commented_date')";
                if ($connection->query($statment)) {
                    echo "commented";
                } else {
                    echo "error";
                } 
           }
        }
    }
}
?>
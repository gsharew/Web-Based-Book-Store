<?php
session_start();
    if ($_POST['deletefile']!="yes") {
       header('location:../html_part/mainpage.html');
    }
    else
    {
         if (isset($_SESSION['course1']) && isset($_SESSION['department1'])) {
              //now is the time for deleting the selected file
              $selectedfile=$_POST['filetodelete'];
             if (unlink("../Books/".$_SESSION['department1']."/".$_SESSION['year1']."/".$_SESSION['semister1']."/".$_SESSION['course1']."/".$selectedfile)) {
                  echo "deleted";
             } 
             else
             {
                 echo "error2";
             }
         }
         else
         {
             echo "error3";
         }
    }
?>
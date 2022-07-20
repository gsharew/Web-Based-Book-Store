<?php
  session_start();
    if(isset($_SESSION['username1'])) {
         $filename=basename($_FILES['imagefile']['name']);
         $fileerror=$_FILES['imagefile']['error'];
         $filetemplocation=$_FILES['imagefile']['tmp_name'];
         $filesize=$_FILES['imagefile']['size'];
         $fileextenston=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
         //echo $fileextenston;
         $allowedimagetype=array("jpeg","png","jpg");
     if (in_array($fileextenston,$allowedimagetype)) 
     {
          if ($fileerror) {
             echo "fileerror";
          }
          else {
                if ($filesize<=8000000) {
             
                $filename=$_SESSION['username1'];
                $targetdir = "../Teacher_image/" . $_SESSION['department1'] . "/" . $_SESSION['year1'] . "/" . $_SESSION['semister1'] . "/" . $filename;
                
                if (move_uploaded_file($filetemplocation, $targetdir)) {
                    echo "changed";
                } else {
                    echo "unchanged";
                }
            }
            else {
                echo "toobig";
            }
          }
     }
     else {
         echo "unsupported";
     }
  }
  else {
    header('location:../html_part/mainpage.html');
  }
?>
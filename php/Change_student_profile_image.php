<?php
    session_start();
    if(isset($_SESSION['username']))
    {
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
                    $filename = $_SESSION['username'];
                $targetdir = "../Student_image/" . $_SESSION['department'] . "/" . $_SESSION['year'] . "/" . $_SESSION['semister'] . "/" . $filename;
               
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
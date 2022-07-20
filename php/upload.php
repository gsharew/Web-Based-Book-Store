<?php
    session_start();
    if (isset($_SESSION['verifyteacher2'])) 
    {
             //echo "successfull";
                        $file = $_FILES["file"];
                        $targetdir= "../Books/".$_SESSION["department2"]."/". $_SESSION["year2"]."/". $_SESSION["semister2"]."/". $_SESSION["course2"]."/";
                        //$filetype = $_FILES['file']['type'];
                        $filename = basename($_FILES["file"]["name"]);
                        for ($i = 0; $i < strlen($filename); $i++) {
                            if (
                                $filename[$i] == '-'  || $filename[$i] == '/' || $filename[$i] == ' '
                                || $filename[$i] == '|' || $filename[$i] == '`' || $filename[$i]=="]" 
                                || $filename[$i] == '}' || $filename[$i] == '{' || $filename[$i]=="["
                                || $filename[$i] == '+' || $filename[$i] == '$' || $filename[$i] == '#' || $filename[$i] == '@' ||
                                $filename[$i] == '!' || $filename[$i] == '%' || $filename[$i] == '^' || $filename[$i] == ','
                                || $filename[$i] == '<' || $filename[$i] == '>' ||  $filename[$i]== '?'
                                || $filename[$i] == '\"' || $filename[$i] == ';' || $filename[$i] == ':'
                            ) 
                            {
                                $filename[$i] = '_';
                            }
                        }

                        $targetfile = $targetdir.$filename;
                        $filesize = $_FILES["file"]["size"];
                        $tempfile = $_FILES["file"]["tmp_name"];
                        $fileerror = $_FILES["file"]["error"];

                        //$spliting filename and its extenstion = explode('.',$filename);
                        $actualextension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                        $allowedfileextensions=array("mp4","txt","rtl","pdf","ppt","pptx","jpg","jpeg","png","pps","odp","doc","zip","docx","7z","deb","rar","rpm","tar.gz","tar,"."svg","ico","gif");

                        if (in_array($actualextension,$allowedfileextensions))
                         {
                            if (file_exists($targetfile))
                             {
                                echo "The file already exist";
                             }
                           
                            else {
                                //chmod($tempfile, 0755);
                                //print_r(is_readable($targetfile));
                               if ($fileerror==0) 
                               {
                                    //$destinationfolder=uniqid('',true).".".$actualextension; //generates a random unique id
                                    if (strlen($filename)>=150) 
                                    {
                                            echo "Your file Name is too Long"; 
                                    }

                                    else {
                                         if ($filesize>205000000)
                                         {
                                             echo "Your file size is too big";
                                         }

                                         else{
                                                if (move_uploaded_file($tempfile, $targetfile))
                                                {
                                                    echo "Upload completed";
                                                } 

                                                else {
                                                    echo "Error uploading your file";
                                                }
                                            }
                                         }
                               }

                               else{
                                echo "we have got an error while uploading your file";
                               }
                            }
                         }

                         else {
                                echo "You can't upload file type of this";
                                // echo "You can\'t upload file type of  \".'. $actualextension.'\" \n you must upload .pdf , .rtf , .ppt , .docs, docx,doc,zip and some others \n and you should upload the file with it\'s extenstion  unless it will not work";
                             }
                    } 
             else {
                //echo '<script>location.href="../html_part/teachers_page.html"</script>';
                header('location:../html_part/mainpage.html');
             }
?>
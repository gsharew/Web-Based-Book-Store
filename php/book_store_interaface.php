   <?php
    session_start();
    if (!isset($_SESSION['verify'])) {
        //echo '<script>location.href="../html_part/Loginform.html"</script>';
        header('location:../html_part/mainpage.html');
    }
    ?>

   <!DOCTYPE html>
   <html>

   <head>
       <meta charset='utf-8'>
       <meta http-equiv='X-UA-Compatible' content='IE=edge'>
       <title>All books.com</title>
       <link rel="icon" type="image/png" href="../images/Adigrat.png">
       <meta name='viewport' content='width=device-width, initial-scale=1'>
       <link rel='stylesheet' href='../w3_themes/theme_teal.css'>
       <link rel="stylesheet" href="../css/book_store.css">
       <link rel="stylesheet" href="../font_awesome/css/all.css">
       <script src="../jquary/jquery.js"></script>
   </head>

   <body onload="onloadfunction();">
       <header>
           <h1>Welcome to your home page Dear. </h1>
           <h2>Enjoy Downloading <span style="font-size:15px !important;" class="fa fa-download"></span> your file. </h2>
           <h3>Download below</h3>
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
               <input name="logout" type="submit" class="w3-right" value="Logout">
           </form>
       </header>
       <center>
           <center style="padding:15px;border:1px solid #578194;width:150px;border-bottom-left-radius:3px;border-bottom-right-radius:3px; border-top:none">
               <b style="margin-top:20px; color:green;font-family:abel;"><?php echo strtoupper(substr($_SESSION['studfirstname'], 0, 1)) . substr($_SESSION['studfirstname'], 1, strlen($_SESSION['studfirstname'])) . ' ' . strtoupper(substr($_SESSION['studlastname'], 0, 1)) . substr($_SESSION['studlastname'], 1, strlen($_SESSION['studlastname'])) ?>.</b>
           </center>
       </center>


       <!--   <h5 class="footer" style="">@CopyRight Adigrat university 2020</h5> -->
       <?php
        $checker = 0;
        if (isset($_POST['logout'])) {
            session_destroy();
            header('location:../html_part/mainpage.html');
        } else {
            //session_start();
            //gaining the previous information of the student
            // $username=$_SESSION['username'];
            // $password=$_SESSION['password'];
            $department = $_SESSION['studdepartment'];
            $year = $_SESSION['studyear'];
            $semister = $_SESSION['studsemister'];
            $usernameprofile = $_SESSION['studusername'];
            $passwordprofile = $_SESSION['studpassword'];
            //setup the connection for the database
            $username = "Getachew";
            $password = "Password";
            $hostname = "localhost";
            $databasename = "Student";
            $connection = new mysqli($hostname, $username, $password, $databasename);

            if (mysqli_connect_error()) {
                echo '<script>alert("An error occured !!");</script>';
                echo '<script>location.href="../html_part/Loginform.html"</script>';
            } else {
                //header('Content-Type: image/jpg');
                //echo file_get_contents("username.jpg");
                //echo $image;
                $statment = "select * from " . $department;
                $result = $connection->query($statment);
                $isfound = false;
                if ($result->num_rows > 0) {
                    while ($userprofile = $result->fetch_assoc()) {
                        if ($userprofile["username"] == $usernameprofile && $userprofile["password"] == $passwordprofile) {
                            $targetdir = "../Student_image/" . $department . "/" . $year . "/" . $semister . "/";
                            if ($profile = opendir($targetdir)) {
                                //echo '<script>alert("Entered !!");</script>';
                                while (false !== ($singleprofile = readdir($profile))) {
                                    $imagename = basename($singleprofile); //this will return the file with it's extension
                                    $singleprofile = basename($singleprofile, ".jpg");  //this will return the file name only
                                    if ($singleprofile == $userprofile["username"]) {
                                        //echo '<script>alert("'.$singleprofile.'");</script>';
                                        $isfound = true;
                                        echo '<center> <img class="profile" width="80" height="100" src=' . $targetdir . $imagename . '></center>';
                                        echo '<center> <span style="margin-top:10px;font-size:20px;color:green;position:absolute;margin-left:-10px;"  id="downarrow" class="fa fa-arrow-down"></span></center>';
                                        break;
                                    }
                                }
                            }

                            if ($isfound) {
                                break;
                            } else {
                                echo '<center><img class="profile"  src="../images/avatar.png"/></center>';
                                echo '<center> <span style="margin-top:10px;font-size:20px;color:green;position:absolute;margin-left:-10px;" id="downarrow" class="fa fa-arrow-down"></span></center>';
                                break;
                            }
                        }
                    }
                }
                // //now it is a time to retrieve all the student courses and books.
                // $targetdir = "../Books/" . $department . "/" . $year . "/" . $semister . "/*";
                // echo '<form class="option" action="Bookstore.php" method="post">';
                // echo '<select class"option" onchange="myFunction()" id="menu1">';
                // $directories = glob($targetdir, GLOB_ONLYDIR);
                // $i = 0;
                // while ($directories[$i]) {
                //     $finalresult = explode('/', $directories[$i]);
                //     if ($i==0) {
                //         echo '<option value=' . end($finalresult) . ' selected >';
                //         echo end($finalresult);
                //     }
                //     else
                //     {
                //         echo '<option value=' . end($finalresult) . '>';
                //         echo end($finalresult);
                //     }
                //     echo '</option>';
                //     $i++;
                // }
                // echo '</select>';
                // echo ' </form>';
                //closedir($dir_contents);
                //or you can use this method 

                $targetdir = "../Books/" . $department . "/" . $year . "/" . $semister . "/";
                if ($handle = opendir($targetdir)) {
                    echo '<center>';
                    echo '<select class="option" onchange="opencourse()" id="menu1" name="course">';
                    echo '<option>';
                    echo "Choose course";
                    echo '</option>';
                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != "..") {
                            echo '<option>';
                            echo $entry;
                            echo '</option>';
                        }
                    }
                    echo '</select>';
                    echo '</center>';
                    closedir($handle);
                }
                $url = explode('?', $_SERVER['REQUEST_URI']);
                //echo '<script>alert("'.$_REQUEST["course"].'");</script>';
                if (count($url) > 1) {
                    $selectedcourse = end($url);
                    //$message = $selectedcourse . "  Files ";

                    //now it is the time to retireve all the book that the teacher upload
                    if (end($url) != null) {
                        // if ($actualextension == "pdf" && !$detection->isMobile()) {
                        //     echo '<table border=1>';
                        //     echo '<tr>';
                        //     echo '<th>';
                        //     echo "Book Name";
                        //     echo '</th>';
                        //     echo '<th>';
                        //     echo "Read";
                        //     echo '</th>';
                        //     echo '<th>';
                        //     echo "Download";
                        //     echo '</th>';
                        //     echo '</tr>';
                        // }
                        // else
                        // {
                        echo '<center>';
                        echo '<div class="table_container">';
                        echo '<table border=1>';

                        echo '<tr>';

                        echo '<th>';
                        echo "No.";
                        echo '</th>';

                        echo '<th>';
                        echo "Book Name";
                        echo '</th>';

                        echo '<th>';
                        echo "Download";
                        echo '</th>';
                        echo '</tr>';
                        // }
                        $targetdir = "../Books/" . $department . "/" . $year . "/" . $semister . "/" . $selectedcourse . "/";
                        include 'Mobile_Detect.php';
                        $detection = new Mobile_Detect();
                        if ($handle = opendir($targetdir)) {
                            while (false !== ($entry = readdir($handle))) {
                                if ($entry != "." && $entry != "..") {
                                    $checker++;
                                    $actualextension = strtolower(pathinfo($targetdir . $entry, PATHINFO_EXTENSION));
                                    // if ($actualextension == "pdf") {
                                    //     echo '<img style="transform:scaleX(0.8);"  height="50%" src="../images/pdf.png"> <br>';
                                    // } elseif ($actualextension == "ppt" || $actualextension == "pptx") {
                                    //     echo '<img style="transform:scaleX(0.8);"   height="50%" src="../images/ppt.png"> <br>';
                                    // } elseif ($actualextension == "rtf" || $actualextension == "docx" || $actualextension == "doc") {
                                    //     echo '<img style="transform:scaleX(1.5);"  height="50%" src="../images/word.png"> <br>';
                                    // } elseif ($actualextension == "txt") {
                                    //     echo '<img style="transform:scale(1.1);transform:scaleY(1);"  height="50%" src="../images/text.png"> <br>';
                                    // } elseif ($actualextension == "rar" || $actualextension == "7z" || $actualextension == "tar.gz" || $actualextension == "tar") {
                                    //     echo '<img  height="50%" src="../images/rar.png"> <br>';
                                    // } elseif ($actualextension == "png" || $actualextension == "jpg" || $actualextension == "jpeg" || $actualextension == "ico" || $actualextension == "gif" || $actualextension == "svg") {
                                    //     echo '<img style="transform:scale(1.8);"  height="50%" src="../images/image.png"> <br>';
                                    // } elseif ($actualextension == "zip") {
                                    //     echo '<img style="transform:scale(1.1);"  height="50%" src="../images/zip1.png"> <br>';
                                    // }

                                    // $actualextension = strtolower(pathinfo($targetdir . $entry, PATHINFO_EXTENSION));
                                    // if ($actualextension == "pdf" && !$detection->isMobile()) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo  $checker;
                                    echo '</td>';

                                    echo '<td>';
                                    echo  $entry;
                                    echo '</td>';

                                    // echo '<td>';
                                    // echo "<a href=" . $targetdir . $entry . '>';
                                    // echo "Read";
                                    // echo "</a>";
                                    // echo '</td>';

                                    echo '<td>';
                                    echo "<a href=" . $targetdir . $entry . ' type="application/octate-stream.pdf" download>';
                                    echo '<span style="color:red" class="fa fa-file-download"></span>';
                                    echo "</a>";
                                    echo '</td>';
                                    echo '</tr>';
                                    // }  else {
                                    //     echo '<tr>';
                                    //     echo '<td>';
                                    //     echo "<a class=\"downloadonly\" href=" . $targetdir . $entry . ' type="application/octate-stream.pdf" download>';
                                    //     echo "Download";
                                    //     echo "</a>";
                                    //     echo '</td>';
                                    //     echo '</tr>';
                                    // }
                                }
                            }
                            echo '</table>';
                            echo '</div>';
                            echo '</center>';
                        }
                    }
                    if ($checker == 0) {
                        echo '<h2 style="color:red;font-family:abel;text-align:center;margin-top:25px;margin-bottom:20px;">There are No Uploaded Files for  ' . $selectedcourse . '</h2>';
                    }
                }
            }
        }
        echo '<center>';
        echo ' <small style="color:black;font-family:ubuntu;font-weight:bold;text-align:center;padding-top:5px;padding-bottom:5px;width:100%;">';
        echo '<span style="color:rgb(0, 0, 0);font-size:smaller;padding-right:5px;" class="fa fa-copyright"></span>CopyRight Adigrat university 2020</small>';
        echo ' </center>';
        ?>
       <script type="text/javascript">
           var course;
           var onchange = 0;

           function opencourse() {
               var temp = document.getElementById("menu1");
               location.href = "book_store_interaface.php?" + temp.options[temp.selectedIndex].text;
               onchange++;
           }

           function onloadfunction() {
               $("#downarrow").animate({
                   "paddingTop": "25px"
               }, "slow");
               $("#downarrow").animate({
                   "paddingTop": "-10px"
               }, "slow");
               setTimeout(onloadfunction, 2000);
           }
       </script>
   </body>

   </html>
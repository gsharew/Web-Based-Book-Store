<?php
session_start();

if (!isset($_SESSION['verifyteacher1'])) {
    //echo '<script>location.href="../html_part/Loginform.html"</script>';
    header('location:../html_part/mainpage.html');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../images/Adigrat.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Teachers_profile.css">
    <link rel="stylesheet" href="../w3_themes/theme_red.css">
    <link rel="stylesheet" href="../font_awesome/css/all.css">
    <title>teacherprofile.com</title>
    <script src="../js/update_teacher_profile.js"></script>
    <script src="../jquary/jquery.js"></script>
    <script src="../w3java/w3java.js"></script>
    <script src="../js/Change_teacher_profile.js"></script>
</head>
<!-- <iframe src="../html_part/book_store_interaface.php" width="100%" height="617em"  style="border: none;"></iframe> -->

<body>
    <!-- <img src="../images/Adigrat.png" style="position:sticky;top:0;" width="100%" height="60" alt=""> -->
    <!-- <span style="position: absolute">BOOK STORE</span> -->

    <div class="header">
        <form action='<?php $_SERVER["php-self"] ?>' method="post">
            <input class="logout stiky" type="submit" value="Logout" name="logout">
        </form>

        <center>
            <h1 class="headertext">Details of your information </h1>
        </center>
    </div>
    <center>
        <h3 style="color:green; font-family:abel;margin-top:15px;text-shadow:0px 1px 0px black;"><?php echo strtoupper(substr($_SESSION['firstname1'], 0, 1)) . substr($_SESSION['firstname1'], 1, strlen($_SESSION['firstname1'])) . ' ' . strtoupper(substr($_SESSION['lastname1'], 0, 1)) . substr($_SESSION['lastname1'], 1, strlen($_SESSION['lastname1'])) ?>.</h3>
    </center>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location:../html_part/mainpage.html');
    } else {
        $department = $_SESSION['department1'];
        $year = $_SESSION['year1'];
        $semister = $_SESSION['semister1'];
        $usernameprofile = $_SESSION['username1'];
        $passwordprofile = $_SESSION['password1'];

        //setup the connection for the database
        $username = "Getachew";
        $password = "Password";
        $hostname = "localhost";
        $databasename = "Instructor";
        $connection = new mysqli($hostname, $username, $password, $databasename);

        if (mysqli_connect_error()) {
            header('location:../html_part/mainpage.html');
        } else {
            //header('Content-Type: image/jpg');
            //echo file_get_contents("username.jpg");
            //echo $image;
            //echo '<span class="w3-text w3-tag w3-round-xlarge">9 million inhabitants</span> ';
            $statment = "select * from " . $department;
            $result = $connection->query($statment);
            $isfound = false;
            if ($result->num_rows > 0) {
                while ($userprofile = $result->fetch_assoc()) {
                    if ($userprofile["username"] == $usernameprofile && $userprofile["password"] == $passwordprofile) {
                        $targetdir = "../Teacher_image/" . $department . "/" . $year . "/" . $semister . "/";
                        if ($profile = opendir($targetdir)) {
                            //echo '<script>alert("Entered !!");</script>';
                            while (false !== ($singleprofile = readdir($profile))) {
                                $imagename = basename($singleprofile); //this will return the file with it's extension
                                $singleprofile = basename($singleprofile, ".jpg");  //this will return the file name only
                                if ($singleprofile == $userprofile["username"]) {
                                    //echo '<script>alert("'.$singleprofile.'");</script>';
                                    $isfound = true;
                                    echo '<center><img id="profileimage" onclick="clickme();" class="profile" width="100" height="100" src=' . $targetdir . $imagename . '></center>';
                                    echo '<center><figcaption id="figcup" style="color:red; font-weight:bold; text-shadow:0px 1px 0px black;font-family:abel;margin-top:10px;font-size:18px;">Dear !! - click this image if you want  to change your profile</figcaption></center>';
                                    echo '<input style="display:none" oninput="changemyprofile()" type="file" id="profilefile">';
                                    break;
                                }
                            }
                        }

                        if ($isfound) {
                            break;
                        } else {
                            echo '<center><img id="profileimage" onclick="clickme();" class="profile" width="100" height="100" src="../images/login.png"/></center>';
                            echo '<center><figcaption id="figcup" style="color:red; font-weight:bold; text-shadow:0px 1px 0px black;font-family:abel;margin-top:10px;font-size:18px;">No image !! - click this image if you want to change your profile</figcaption></center>';
                            echo '<input style="display:none" oninput="changemyprofile()" type="file" id="profilefile">';
                            break;
                        }
                    }
                }
                $statment1 = "select * from " . $department;
                $result1 = $connection->query($statment1);
                if ($result1->num_rows > 0) {
                    while ($userprofile1 = $result1->fetch_assoc()) {
                        if ($userprofile1["username"] == $usernameprofile && $userprofile1["password"] == $passwordprofile) {

                            echo '<center>';
                            echo '<div class="parent">';
                            echo '<div class="info_container">';
                            echo '<center><h2 id="head1" style="box-shadow:0px 0px 5px rgba(0,0,0,0.5); font-family:abel; text-shadow:1px 0px 0px black;">See Your Information Below.</h2></center>';
                            echo '<center>';
                            echo '<table class="table" border="1">';

                            echo '<tr>';
                            echo '<th>';
                            echo "Firstname:";
                            echo '</th>';
                            echo '<td>';
                            echo $userprofile1["firstname"];
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Lastname:";
                            echo '</th>';
                            echo '<td>';
                            echo $userprofile1["lastname"];
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Username:";
                            echo '</th>';
                            echo '<td>';
                            echo $userprofile1["username"];
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th id="greenpassword">';
                            echo "Password:";
                            echo '</th>';
                            echo '<td id="greenpassword1">';
                            echo  $userprofile1["password"];
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Batch Year";
                            echo '</th>';
                            echo '<td>';
                            echo  $userprofile1["year"] . "ear";
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Your Course";
                            echo '</th>';
                            echo '<td>';
                            echo  $userprofile1["course"];
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Department";
                            echo '</th>';
                            echo '<td>';
                            echo  $userprofile1["department"];
                            echo '</td>';
                            echo '</tr>';

                            echo '</table>';
                            echo '</center>';
                            echo '</div>';

                            echo '<div class="info_container">';
                            echo '<center><h2 id="head2" style="box-shadow:0px 0px 5px rgba(0,0,0,0.5);font-family:abel;text-shadow:1px 0px 0px black;">Update your Password.</h2></center>';
                            echo '<center>';
                            echo '<form>';
                            echo '<table class="table">';
                            echo '<tr>';
                            echo '<th>';
                            echo "Firstname:";
                            echo '</th>';
                            echo '<td>';
                            echo '<input type="text" disabled placeholder="Firstname" value="Un updatable">';
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Lastname:";
                            echo '</th>';
                            echo '<td>';
                            echo '<input type="text" disabled placeholder="Lastname" value="Un updatable">';
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Username:";
                            echo '</th>';
                            echo '<td>';
                            echo '<input type="text" disabled placeholder="Username" value="Un updatable">';
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th>';
                            echo "Password:";
                            echo '</th>';
                            echo '<td>';
                            echo '<input  type="password" maxLength="20" onkeyup="changetoeye()" id="password"  placeholder="New Password">';
                            echo '<span class="fa fa-eye" id="eye" onclick="showpassword();" style="font-size:20px;cursor:pointer; position:absolute;float:right;right:25px;z-index:1;bottom:82px;"></span>';
                            echo '</td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<th colspan="2">';
                            echo '<input class="update_button" id="updatebtn" type="button" value="Update" onclick="update_profile();">';
                            echo '</th>';
                            echo '<h4 id="notification" style="margin-top:10px;color:green;display:none;">Updated successfully</h4>';
                            echo '</tr>';

                            echo '</table>';
                            echo '</center>';
                            echo '</form>';
                            echo '</div>';

                            $targetdir = "../Books/" . $userprofile1["department"] . "/" . $userprofile1["year"] . "/" . $userprofile1["semister"] . "/" . $userprofile1["course"] . "/";
                            if ($files1 = opendir($targetdir)) {
                                $filecounter = 0;
                                while (false !== ($singlefile1 = readdir($files1))) {
                                    if (basename($singlefile1) != "." && basename($singlefile1) != "..") {
                                        $filecounter++;
                                        break;
                                    }
                                }

                                if ($filecounter != 0) {
                                    $linenumber = 0;
                                    $files = opendir($targetdir);
                                    echo '<div class="info_container">';
                                    echo '<center><h2 id="deletestatus" style=" font-family:abel; text-shadow:1px 0px 0px black;">See Your Uploaded Files.</h2></center>';
                                    echo '<center>';
                                    echo '<table id="filtertable" style=" box-shadow:0px 0px 0px  black;" class="table"  border="1">';
                                    echo '<tr><th>No.</th><th>Files</th><th>Read</th><th>Delete</th></tr>';
                                    while (false !== ($singlefile = readdir($files))) {
                                        if (basename($singlefile) != "." && basename($singlefile) != "..") {
                                            $linenumber++;
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $linenumber;
                                            echo '</td>';
                                            echo '<td style="width:85%;" id="filename">';
                                            echo basename($singlefile);
                                            echo '</td>';
                                            echo '<td><a style="text-decoration:none;color:black;" href="' . $targetdir . $singlefile . '" target="_blank"><span style="color:green;font-size:20px" class="fa fa-book-open"></span></a></td>';
                                            echo '<td id="filename1"
                                        onclick="filterme(this)"><span id="trashicon" style="padding-left:5px; color:red;border:none;font-size:20px;cursor:pointer;" class="fa fa-trash"></span></td>';
                                            echo '</tr>';
                                        }
                                    }

                                    echo '</table>';
                                    echo '</center>';
                                    echo '</div>';
                                }
                            }


                            echo '<div class="info_container">';
                            echo '<center><h2 id="header" style="box-shadow:0px 0px 5px rgba(0,0,0,0.5);font-family:Abel;text-shadow:1px 0px 0px black;">Give us a comment Here.</h2></center>';
                            echo '<center>';
                            echo '<h4 id="notification2" style="margin-top:10px;color:green;display:none;">Thank you for your comment</h4>';
                            echo '<textarea id="comment" cols="32" maxLength="70"  rows="12" placeholder="if you have any suggession Write some here. and maximum allowed  character is 200">';
                            echo '</textarea>';
                            echo '<br>';

                            echo '<input class="update_button second_button" type="button" value="Submit" onclick="post_comment();">';
                            echo '</center>';
                            echo '</div>';
                            echo '</div>';
                            echo '</center>';
                            echo '<footer><label style="position:static; color: rgb(20, 18, 15);" class="fa fa-copyright"></label>CopyRight 2020 Adigrat University.</footer>';
                            break;
                        }
                    }
                }
            }
        }
    }
    ?>
</body>

</html>
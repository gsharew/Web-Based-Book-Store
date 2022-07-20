<?php
    if ($_POST['page']=="fromteacher" || $_POST['page'] == "fromteacher1") {
    session_start();
    //setup the connection for the database
    $username = "Getachew";
    $password = "Password";
    $hostname = "localhost";
    $databasename = "Instructor";

    //accepting user input
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $Department = $_POST['department'];

         $connection = new mysqli($hostname, $username, $password, $databasename);

            if (mysqli_connect_error()) 
            {
                echo "unknownerror";
                return;
            } 

            else {
                    $statment="select * from ".$Department;
                    $result=$connection->query($statment);
                    $isfound=false;
                    if ($result->num_rows > 0) 
                    {
                      while ($row=$result->fetch_assoc())
                        {
                            if ($row["username"] === $Username && $row["password"] === $Password) 
                            {
                                    $isfound = true;
                                    //session for profile picture
                                    if ($_POST['page']=="fromteacher") 
                                    {
                                            $_SESSION['verifyteacher1']="true";
                                            $_SESSION['username1']=$row["username"];
                                            $_SESSION['password1']=$row["password"];
                                            $_SESSION["department1"]=$row["department"];
                                            $_SESSION["year1"]=$row["year"];
                                            $_SESSION["semister1"]=$row["semister"];
                                            $_SESSION['firstname1']=$row["firstname"];
                                            $_SESSION['lastname1']=$row["lastname"];
                                            $_SESSION["course1"]=$row["course"];
                                    }
                                    
                                    //session for uploading the file to the server
                                    else {
                                            $_SESSION['verifyteacher2'] = "yes";
                                            $_SESSION['username2'] = $row["username"];
                                            $_SESSION['password2'] = $row["password"];
                                            $_SESSION["department2"] = $row["department"];
                                            $_SESSION["year2"] = $row["year"];
                                            $_SESSION["semister2"] = $row["semister"];
                                            $_SESSION["course2"]=$row["course"];
                                         }
                                    break;
                            }
                        }

                        if (!$isfound) 
                        {
                            echo "unauthorized";
                            return; 
                        }
                        else
                        {
                            echo "authorized";
                            return;
                        }
                }
                
                else
                {
                     echo "unauthorized";
                     return;
                }
            }
        }
            else
            {
                //echo '<script>location.href="../html_part/teachers_page.html"</script>';
                header('location:../html_part/mainpage.html');
            }
    ?>
<?php
    if ($_POST['page']=="fromstudent" || $_POST['page']=="fromstudentviewpdf") {
   
    session_start();

    //setup the connection for the database
    $username = "Getachew";
    $password = "Password";
    $hostname = "localhost";
    $databasename = "Student";

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
                    if ($result->num_rows>0) 
                    {
                      while ($row=$result->fetch_assoc())
                        {
                            if ($row["username"] === $Username && $row["password"] === $Password) 
                            {
                                if ($_POST['page']=="fromstudent") {
                               
                                    $isfound=true;
                                    $_SESSION['verify']="yes";
                                    $_SESSION['studfirstname']=$row['firstname'];
                                    $_SESSION['studlastname']=$row['lastname'];
                                    $_SESSION['studusername']=$row["username"];
                                    $_SESSION['studpassword']=$row["password"];
                                    $_SESSION["studdepartment"]=$row["department"];
                                    $_SESSION["studyear"]=$row["year"];
                                    $_SESSION["studsemister"]=$row["semister"];
                                    break;
                      
                                }
                                else
                                {
                                    $isfound = true;
                                    $_SESSION['verify'] = "yes";
                                    $_SESSION['firstname'] = $row['firstname'];
                                    $_SESSION['lastname'] = $row['lastname'];
                                    $_SESSION['username'] = $row["username"];
                                    $_SESSION['password'] = $row["password"];
                                    $_SESSION["department"] = $row["department"];
                                    $_SESSION["year"] = $row["year"];
                                    $_SESSION["semister"] = $row["semister"];
                                    break;
                                }
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
                //echo '<script>location.href="../html_part/Loginform.html"</script>';
                header('location:../html_part/mainpage.html');
            }
    ?>
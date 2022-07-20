  <?php
  
        //accepts user input from the input field
        $Firstname = $_POST['firstname'];
        $Lastname = $_POST['lastname'];
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $Department = $_POST['department'];

        //setup the connection for the database
        $username = "Getachew";
        $password = "Password";
        $hostname = "localhost";
        $databasename = "Student";
           
                $connection = new mysqli($hostname, $username, $password, $databasename);
                if (mysqli_connect_error()) {
                    echo '<script>alert("An error occured !!");</script>';
                    echo '<script>location.href="../html_part/Loginform.html"</script>';
                } 

                $student= "insert into ". $Department. " (firstname,lastname,username,password,department) VALUES(?,?,?,?,?)";
                $statment= $connection->prepare($student);
                $statment->bind_param("sssss",$Firstname, $Lastname, $Username, $Password, $Department);
                $isinserted=$statment->execute();

                if(!$isinserted)
                {
                    echo '<script> alert("You are not registered \n make sure that your password is unique !!");</script>';
                    echo '<script> location.href = "../html_part/Loginform.html"</script>';
                    //header("location:../html_part/Loginform.html");
                }

                else
                {
                        echo '<script>alert("You are registered");</script>';
                        echo '<script>location.href = "../html_part/Loginform.html"</script>';
                        $connection->close();
                        $statment->close();
                }
?>
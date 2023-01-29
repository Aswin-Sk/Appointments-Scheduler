<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();

    function clean_kuttapi($string)
    {
        $string=trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    $id="";
    $username="";
    $password="";
    $p="";
    $err="";
    $err1="";
    $err2="";

    if(isset($_POST['login']))
    {
        if(empty($_POST['username']))
        {
            $err1= "<p>Please enter username.</p>";
        }
        else
        {
            $username = clean_kuttapi($_POST['username']);
            $username = strtoupper($username);
        }

        if(empty($_POST['password']))
        {
            $err2= "<p>Please enter password</p>";
        }
        else
        {
            $password= clean_kuttapi($_POST['password']);
        }
        if(strlen($err1) == 0 && strlen($err2) == 0){
            $q = $conn->prepare("select roll_no, password from student where roll_no = ? and password = ? limit 1");
            $q->bindParam(1, $username);
            $q->bindParam(2, $password);
            $q1=$q->execute();
            $flag=0;
            while($row = $q1->fetchArray()){
                if(strcmp($password,$row[1])==0)
                {
                    $_SESSION["rollno"]=$row[0];
                    // echo $_SESSION["rollno"];
                    $flag=1;
                }
            }
            if($flag==0){
                $err= "Invalid Credentials";
            }
        }
        if(strlen($err) == 0 && strlen($err1) == 0 && strlen($err2) == 0){
            // echo "login successful";
            echo "<script>window.location.href='function.php'</script>";
            // die();
        }

    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href='https://css.gg/log-out.css' rel='stylesheet'>
        <link rel = "stylesheet" href = "login.css">
        <title>Student Login</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
        <div class="header">
          <a href="index.php" class="logo"><span><img src="Nitc_logo.png"> </span><span style="font-size:40px;">NITC Faculty Slot Booking</span></a>
          <nav>
        <div class="logout" name="View" onclick="window.location.href='index.php';" formaction=# value="View" ><img src="logout.png" class="log" aria-hidden="true"></i>
        </div> 
       </nav>
        </div>
        
    <div class="cardcard">
            <div class="card text-center w-49">            
                <div class="card-header ">
                <h3><strong>Student Login</strong></h3>
                </div>
                <div class="card-body">
                    <div class="container">
                    <!-- <h4 class="mar">Enter your Username</h4> -->
                    <input  class="mar inputbox" type="text" name="username" placeholder="Username" />
                    <?php echo '<span style="color:red">'.$err1.'</span>'; ?>
                    <br>
                    <!-- <h4 class="mar">Enter your Password</h4> -->
                    <input class="mar inputbox" type="password" name="password" placeholder="Password"  />
                    <?php echo '<span style="color:red">'.$err2.'</span>'; ?>
                    <?php
                        if(strlen($err)>0)
                            echo '<span style="color:red">'.$err.'</span>';
                    ?>
                    <br>
                    <div class="cntrbtn">
                    <input class="btn btn-primary mar log-button" type="submit" name ="login" value="Log in" />
                    </div>
                    </div>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                </div>
            </div>

            
        </form>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    $rollno = $_SESSION["rollno"];
    $table = "";
    $err = "";

    if(isset($_POST['checktt']))
    {
        if(empty($_POST['prof']))
        {
            $err = "<p>Select a Professor</p>";
        }
        else
        {
            $_SESSION['prof'] = $_POST['prof'];
            header('Location: ' . "slotselect.php");
            die();
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="bg.css">
        <link rel="stylesheet" href="makebooking.css">
        <title>Make Booking</title>
    </head>
    <body>
    <div class="container-fluid">
    <!-- Background animtion-->
        <div class="background">
           
        </div>
    <!-- header -->
       <header>
    <nav>
        <div class="logout" name="View" onclick="window.location.href='function.php';" formaction=# value="View" ><img src="logout.png" class="log" aria-hidden="true"></i>
        </div> 
       </nav>
    <div class="logo"><span><img src="Nitc_logo.png"> </span></div>
    <section class="header-content">
        <?php
            $res = $conn->prepare('SELECT first_name,second_name FROM student where roll_no=?');
            $res->bindparam(1,$rollno);
            $result=$res->execute();
            while ($row = $result->fetchArray()) 
            {
                echo '<h1>Welcome '.$row[0].' '.$row[1].'!</h1>';
            }
        ?>
        </section>
        <div class="glass-panel" >
            <div class="bookingcontainer">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <select class="drpdwn" name="prof">
                <option value="" disbaled selected hidden> -Select Faculty- </option>
                <?php
                    $res = $conn->prepare('SELECT * FROM professor');
                    $result=$res->execute();
                    while ($row = $result->fetchArray()) 
                    {
                        echo '<option value="'.$row[0].'">'.$row[2].' '.$row[3].'</option>';
                    }
                ?>
            </select>
            <?php
                echo $err;
            ?>
            <br>
            <input class="button bookingbtn" id="hovbtn" type="submit" name="checktt" value="Check">
        </form>
        </div>
        </div>
        </header>
</div>
    </body>
</html>
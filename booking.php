<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    // $rollno = $_SESSION["rollno"];
    $rollno = 'B200053CS';
    $_SESSION['rollno'] = $rollno;
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
    </head>
    <body>
        <?php
            $res = $conn->prepare('SELECT first_name,second_name FROM student where roll_no=?');
            $res->bindparam(1,$rollno);
            $result=$res->execute();
            while ($row = $result->fetchArray()) 
            {
                echo "Welcome ".$row[0].' '.$row[1];
            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <select name="prof">
                <option value="" disbaled selected hidden> -Select Faculty- </option>
                <?php
                    $res = $conn->prepare('SELECT* FROM professor');
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
            <input type="submit" name="checktt" value="Check">
        </form>
    </body>
</html>
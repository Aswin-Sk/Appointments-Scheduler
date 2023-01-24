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
            $username = explode(" ",clean_kuttapi($_POST['username']));
            $username[1] = implode(" ",array_slice($username,1));
            $username = array_slice($username,0,2);
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
            $q = $conn->prepare("select prof_id, password from professor where first_name = ? and second_name = ? and password = ? limit 1");
            $q->bindParam(1, $username[0]);
            $q->bindParam(2, $username[1]);
            $q->bindParam(3, $password);
            $q1=$q->execute();
            $flag=0;
            while($row = $q1->fetchArray()){
                if(strcmp($password,$row[1])==0)
                {
                    $_SESSION["pid"]=$row[0];
                    echo $_SESSION["pid"];
                    $flag=1;
                }
            }
            if($flag==0){
                $err= "invalid credentials";
            }
        }
        if(strlen($err) == 0 && strlen($err1) == 0 && strlen($err2) == 0){
            echo "login successful";
            header('Location: ' . "view_booking.php");
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <input type="text" name="username" placeholder="Username" />
            <?php echo $err1; ?>
            <input type="password" name="password" placeholder="Password"  />
            <?php echo $err2; ?>
            <?php
                if(strlen($err)>0)
                    echo $err;
            ?>
            <input type="submit" name ="login" value="Login" />
        </form>
    </body>
</html>

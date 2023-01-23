<?php
    session_start();
    include 'dbconnection.php';
    $conn = OpenCon();
    // $pid = $_SESSION["pid"];
    $prof_id = '1';
    $_SESSION['prof_id'] = $prof_id;
    $table = "";
    $string[][2] = array();

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
        <style>
table, th, td {
  border: 1px solid black;
}
</style>
    </head>
    <body>
        <?php
            $res = $conn->prepare('SELECT first_name,second_name FROM professor where prof_id=?');
            $res->bindparam(1,$prof_id);
            $result=$res->execute();
            while ($row = $result->fetchArray()) 
            {
                echo "Welcome ".$row[0].' '.$row[1];
                echo "<br>";
            }
        ?>
        <?php
        $res = $conn->prepare('SELECT slots.starting_time, slots.ending_time,slots.day from slots,freeslots where freeslots.slot_id=slots.slot_id and prof_id=?');
        $res->bindparam(1,$prof_id);
        $result=$res->execute();
        $day_monday=array();
        $day_tuesday=array();
        $day_wednesday=array();
        $day_thursday=array();
        $day_friday=array();
        while ($row = $result->fetchArray())
        {  
            if($row[2]=="Monday")
            array_push($day_monday,$row[0]."-".$row[1]);
            if($row[2]=="Tuesday")
            array_push($day_tuesday,$row[0]."-".$row[1]);
            if($row[2]=="Wednesday")
            array_push($day_wednesday,$row[0]."-".$row[1]);
            if($row[2]=="Thursday")
            array_push($day_thursday,$row[0]."-".$row[1]);
            if($row[2]=="Friday")
            array_push($day_friday,$row[0]."-".$row[1]);
        }
        // print_r($day_monday);
        // echo "<br>";
        // print_r($day_tuesday);
        // echo "<br>";
        // print_r($day_wednesday);
        // echo "<br>";
        // print_r($day_thursday);
        // echo "<br>";
        // print_r($day_friday);
        // echo "<br>";
        $slot_header=array("8-9","9-10","10.15-11.15","11.15-12.15","13-14","14-15","15-16","16-17");
        echo "<center>";
        echo "<form action='welcome.php' method='POST'>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Day</th>";
        foreach ($slot_header as $value) {
            echo "<th>$value</th>";
          }
        echo "</tr>";
        echo "<tr>";
        echo "<th>Monday</th>";
        foreach ($day_monday as $value) {
            echo "<td><input type='checkbox' value='$value'>$value</td>";
          }
        echo "</tr>";
        echo "<tr>";
        echo "<th>Tuesday</th>";
        foreach ($day_tuesday as $value) {
            echo "<td><input type='checkbox' value='$value'>$value</td>";
          }
        echo "</tr>";
        echo "<tr>";
        echo "<th>Wednesday</th>";
        foreach ($day_wednesday as $value) {
            echo "<td><input type='checkbox' value='$value'>$value</td>";
          }
        echo "</tr>";
        echo "<tr>";
        echo "<th>Thursday</th>";
        foreach ($day_thursday as $value) {
            echo "<td><input type='checkbox' value='$value'>$value</td>";
          }
        echo "</tr>";
        echo "<tr>";
        echo "<th>Friday</th>";
        foreach ($day_friday as $value) {
            echo "<td><input type='checkbox' value='$value'>$value</td>";
          }
        echo "</tr>";
        echo "</table>";
        
        echo "<center><input type='submit'  value='Submit'></form></center>";
        
        ?>
    </body>
</html>
<?php
    function OpenCon()
    {
        $conn = new SQLite3('database.db');
        return $conn;
    }
    function CloseCon($conn)
    {
        $conn -> close();
    }
    
?>
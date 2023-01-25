<?php
    function OpenCon()
    {
        $conn = new SQLite3('database.db');
        return $conn;
    }
    function flush_database()
    {
        exec("python init_db.py");
    }
    function CloseCon($conn)
    {
        $conn -> close();
    }
    
?>
<?php
    // Connect to the SQLite database
    $db = new SQLite3('database.db');
    
    // Read the .sql file
    $query = file_get_contents('schema.sql');
    
    // Execute the SQL commands
    $db->exec($query);
?>

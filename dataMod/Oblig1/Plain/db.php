<?php
/**
* Method for setting up a PDO connection to the MySQL database holding the
* Oblig data.
*
* @return The opened PDO object connecting to the MySQL database.
* @throws PDOException
*/
function openDB() {
    $db = new PDO('mysql:host=localhost;dbname=Oblig1;charset=utf8',
                  'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

?>
<?php
/**
* Method for setting up a PDO connection to the MySQL database holding the
* Oblig2 data.
*
* @return PDO the PDO object connecting to the MySQL database.
* @throws PDOException
*/
function openDB() {
    $db = new PDO('mysql:host=localhost;dbname=oblig1;charset=utf8',
                  'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

?>
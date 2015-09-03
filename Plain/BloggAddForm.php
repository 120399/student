<?php
/**
 * A demo program showing how to create a web form that will enter data
 * into a PDO database. The program checks whether POST or GET data is
 * received from the client and behaviour depends on this:
 *
 * 1. No GET or POST data received: a blank HTML form is generated for
 *    the user to complete
 *
 * 2. POST data is received: the user has submitted a form containing data
 *    to be inserted in the database. The response is redirected to the
 *    CdLibrary script if data is successfully added to the database.
 *    Otherwise, an error message is included as GET data to the script 
 *
 * 3. GET data is received: a previous form submission failed and an error
 *    message is passed as $_GET[ERROR_ATTR_NAME]
 *
 * @todo Reinsert user-values in the form upon failed database operation.
 *
 * @see CdLibrary.php
 *
 * @author  Rune Hjelsvold
 * @version 1.2
 */
require_once('db.php');

if (count($_POST) > 0) {
    // The user has completed the form and here comes the entered data
    // Replace empty strings with null for proper database handling
    $Tittel = formatInput($_POST['tittel']);
    $Innhold = formatInput($_POST['innhold']);
    $ForfatterNavn = formatInput($_POST['forfatterNavn']);
    $ForfatterEpost = formatInput($_POST['forfatterEpost']);

    $db = openDB();
    if (addBlogg($db, $Tittel, $Innhold, $ForfatterNavn, $ForfatterEpost) > 0) {
	    // Information about the new CD was successfully added 
	    // Redirect the response to the page displaying the library
        header('Location: BloggLibrary.php');
    } else {
	    // Updating the database failed
        // Redirect the response to the form including an error message
        header('Location: BloggAddForm.php?err=Oppdateringen%20feilet!%20Husk%20å%20fylle%20ut%20alle%20feltene.');
    }
} else {
    // No data received from the user
    // Returning a blank HTML form for entering CD information
    header('Content-type: text/html; charset=utf-8');
    echo <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>Opprette nytt innlegg</title>
<body>
<h1>Opprette nytt innlegg</h1>
<p> Gå tilbake til bloggen: <a href='BloggLibrary.php'>Klikk her</a>
</p>
HTML;

    // Print the error message if one has been passed to the script
    if (isset($_GET['err'])) {
        echo '<p>' . $_GET['err'] . '</p>';
    }
    
    // Print the form itself
    echo <<<HTML
<form action='BloggAddForm.php' method='post'>
Tittel: <input type='text' name='tittel' size='32'><br>
Innhold: <br><textarea rows='8' cols='50' name='innhold'></textarea><br>
ForfatterNavn: <input type='text' name='forfatterNavn' size='32'><br>
ForfatterEpost: <input type='text' name='forfatterEpost' size='32'><br>
<input type='submit'>
</form>
</body>
</head>
</html>
HTML;
}

/**
 * Adds data about a new CD in the library to the database
 *
 * @param PDO $db A PDO object linked to an open database
 * @param string $title The title of the CD to be added to the library
 * @param string $artist The name of the artist playing/singing on the CD
 * @param string $genre The genre of the music on CD
 * @param string $year The year the CD was published
 * @return integer The auto-generated id of the newly create cd if the database
 *         was successfully updated
 */
function addBlogg($db, $Tittel, $Innhold, $ForfatterNavn, $ForfatterEpost)
{
    $res = 0;	
    try {
        $stmt = $db->prepare("INSERT INTO oblig1 ( Tittel, Innhold, ForfatterNavn, ForfatterEpost)
		VALUES (:tittel ,:innhold,:forfatterNavn ,:forfatterEpost);");	  
		$stmt->bindParam(':tittel', $Tittel);
        $stmt->bindParam(':innhold', $Innhold);
        $stmt->bindParam(':forfatterNavn', $ForfatterNavn);
		$stmt->bindParam(':forfatterEpost', $ForfatterEpost);
        $stmt->execute();	

        $res = $db->lastInsertId();
    } catch (Exception $e) { echo $e->getMessage();
   }
    return $res;
}

/**
 * Performs a minimal formatting of input text by replacing empty strings with
 * null values.
 *
 * @param string $inputText The input text to be formatted.
 * @return integer The input string if it contains characters; null otherwise.
 */
function formatInput($inputText)
{
    $res = null;
    if ($inputText != "") {
        $res = $inputText;
    }
    return $res;
}

?>
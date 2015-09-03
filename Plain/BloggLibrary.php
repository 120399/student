<?php
require_once('db.php');

/**
 *Genererer en HTML dokument ifra data i PDO databasen
 */
$db = openDB();
$bloggList = getBloggList($db);
$statistics = generateStatistics($bloggList);

// Make sure that HTTP shows that the document is in UTF-8
header('Content-type: text/html; charset=utf-8');

?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>Blogg</title>
</head>
<body bgcolor="#F57FDA">
<img src="katter.jpg">
<h1>Publiserte innlegg</h1>
<p>


<!-- Call php script for printing BLOGG statistics -->
<?php
echo $statistics;
?>

</p>
<p>legge innlegg inn i bloggen: <a href='BloggAddForm.php'>Klikk her</a><p>
<!-- Call php script for printing information about individual CDs -->
<?php
foreach($bloggList as $blogg) {
    echo  "<p>\n"
        . "<p><h1>" . htmlspecialchars($blogg['Tittel']) . "</p></h1>"
		. "<p><em>" . htmlspecialchars($blogg['ForfatterNavn']).'(' . htmlspecialchars($blogg['ForfatterEpost']) . ')'
		. "</em></p>"
        . "<p>" . htmlspecialchars($blogg['Innhold']) . "</p>"
        . "<p>" . htmlspecialchars($blogg['puBtime']) . "</p>\n"
        . "</p>\n";

}
?>

</body>
</html>

<?php
/**
 * Fetches an array containing information about all CDs in the library
 *
 * @param PDO $db A PDO object linked to an open database
 * @return string[][] Array of records - one for each CD. Each record is an
 *         associative array where the key is the name of the database column
 *         and the value is the CDs corresponding attribute value.
 */
function getBloggList($db)
{
    $stmt = $db->prepare("SELECT Tittel, Innhold, ForfatterNavn, ForfatterEpost, puBtime FROM oblig1 ORDER BY PuBtime DESC");
	
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Generates a string with statistical information about the library. In this
 * version only the statistics only include the number of CDs in the library.
 *
 * @param string[][] $cdList Array of records - one for each CD. Each record is an
 *         associative array where the key is the name of the database column
 *         and the value is the CDs corresponding attribute value.
 * @return string Description of the CD library statistics.
 */
function generateStatistics($bloggList)
{
    $len = count($bloggList);
    $statistics = null;
    $suffix = '';
    if ($len > 0) {
        if ($len > 1) {
            $suffix .= '-er';
        }
        $statistics = "Databasen inneholder $len Blogg$suffix\n";
    } else {
        $statistics =  "Databasen er tom\n";
    }
    return $statistics;
}
?>
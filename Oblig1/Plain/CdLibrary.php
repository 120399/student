<?php
require_once('db.php');

/**
 * A demo program showing how to generate an HTML document from data stored
 * in a PDO/MySQL database
 *
 * @author  Rune Hjelsvold
 * @version 1.1
 */
$db = openDB();
$cdList = getCdList($db);
$statistics = generateStatistics($cdList);

// Make sure that HTTP shows that the document is in UTF-8
header('Content-type: text/html; charset=utf-8');

?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>CD-oversikt</title>
</head>
<body>
<h1>CD-oversikt</h1>
<p>

<!-- Call php script for printing CD statistics -->
<?php
echo $statistics;
?>

</p>
<table>
<thead>
<tr>
<th>Tittel</th><th>Artist</th><th>Sjanger</th><th>Utgivelsesår</th>
</tr>
</thead>
<tbody>

<!-- Call php script for printing information about individual CDs -->
<?php
foreach($cdList as $cd) {
    echo "<tr>\n"
        . "<td>" . htmlspecialchars($cd['title']) . "</td>"
        . "<td>" . htmlspecialchars($cd['artist']) . "</td>"
        . "<td>" . htmlspecialchars($cd['genre']) . "</td>"
        . "<td>" . htmlspecialchars($cd['creationYear']) . "</td>\n"
        . "</tr>\n";
}
?>

</tbody>
</table>
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
function getCdList($db)
{
    $stmt = $db->prepare("SELECT title, artist, genre, creationYear FROM cd");
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
function generateStatistics($cdList)
{
    $len = count($cdList);
    $statistics = null;
    $suffix = '';
    if ($len > 0) {
        if ($len > 1) {
            $suffix .= '-er';
        }
        $statistics = "Databasen inneholder $len CD$suffix\n";
    } else {
        $statistics =  "Databasen er tom\n";
    }
    return $statistics;
}
?>
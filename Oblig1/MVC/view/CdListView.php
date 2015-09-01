<?php

/**
 * This view list the CDs in the sample database in a tabular form.
 *
 * @author  Rune Hjelsvold
 * @version 1.0
 */
class CdListView
{
    /**
     * Generates the HTML code for the CD list page and writes it to the output stream
     *
     * @param Cd[] $cdList The array of CD records
     */
    public function generateDocument($cdList)
    {
        $res = "<html>\n"
             . $this->generateHead('CD-oversikt')
             . $this->generateBody('CD-oversikt', $cdList)
             . '</html>';
        echo $res;
    }

    /**
     * Generates the HTML header information
     *
     * @param string $title The title of the HTML document
     * @return The HTML code defining the document header
     */
    protected function generateHead($title)
    {
        $res = "<head>\n"
             . "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n"
             . '<title>' . $title . "</title>\n"
             . "</head>\n";
        return $res;
    }

    /**
     * Generates the HTML body information, which mainly consists of a table showing
     * information about all CDs in the database.
     *
     * @param string $title The title of the HTML document
     * @param Cd[] $cdList The array of CD records
     * @return The HTML code defining the document body
     */
    protected function generateBody($title, $cdList)
    {
        $len = count($cdList);
        $res = "<body>\n"
             . '<h1>' . $title . "</h1>\n"
             . "<p>Registrerte cd-er: $len</p>\n"
             . $this->generateCdList($cdList);
        return $res . "</body>\n";
    }

    /**
     * Generates an HTML block displaying information about each CD in the
     * database. The information is displayed in the form of a plain table
     * in this version of the application.
     *
     * @param Cd[] $cdList The array of CD records
     * @return The HTML code defining the CD list
     */
    protected function generateCdList($cdList)
    {
        $res = "<table>\n"
             . "<thead>\n"
             . "<tr>\n"
             . "<th>Tittel</th><th>Artist</th><th>Sjanger</th><th>Utgivelsesår</th>\n"
             . "</tr>\n"
             . "</thead>\n"
             . "<tbody>\n";
        foreach($cdList as $cd) {
            $res .= "<tr>\n"
                  . "<td>" . htmlspecialchars($cd->getTitle()) . "</td>"
                  . "<td>" . htmlspecialchars($cd->getArtist()) . "</td>"
                  . "<td>" . htmlspecialchars($cd->getGenre()) . "</td>"
                  . "<td>" . htmlspecialchars($cd->getCreationYear()) . "</td>\n"
                  . "</tr>\n";
        }
        $res .=  "</tbody>\n"
                . "</table>\n";
        return $res;
    }
}
?>
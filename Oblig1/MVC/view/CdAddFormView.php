<?php
/**
 * This view creates an HTML form for entering information about CDs to be
 * added to the sample database.
 *
 * @author  Rune Hjelsvold
 * @version 1.2
 */
class CdAddFormView
{
    /**
     * Generates a Cd object based on the form data returned from the user.
     
     * @param string[] $inputArray The array of input elements returned from
     *        the user. The keys are the names of the various input elements.
     * @return Cd The object created.
     */
    public function createCdFromInput($inputArray)
    {
        // Replace empty strings with null for proper database handling
        $title = $this->formatInput($inputArray['title']);
        $artist = $this->formatInput($inputArray['artist']);
        $genre = $this->formatInput($inputArray['genre']);
        $year = $this->formatInput($inputArray['creationYear']);

        return new Cd(-1, $title, $artist, $genre, $year);
    }
    
    /**
     * Generates the HTML code for the form page and writes it to the output stream.
     *
     * @param string $targetScript The url of the script to receive the form when
     *        submitted
     * @param string $method The HTTP method to be used for the response
     * @param string $errorMessage An optional error message passed from previous
     *        request.
     */
    public function writeDocument($errorMessage = null)
    {
        // Make sure that HTTP shows that the document is in UTF-8
        header('Content-type: text/html; charset=utf-8');
        $res = "<!DOCTYPE html>\n"
             . "<html>\n"
             . $this->generateHead('Opprette ny CD')
             . $this->generateBody('Opprette ny CD', $errorMessage)
             . '</html>';
        echo $res;
    }

    /**
     * Generates the HTML header information
     *
     * @param string $title The title of the HTML form document
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
     * Generates the HTML body information, which mainly consists of the form for
     * entering CD information. The function also displays any error messages passed
     * through the $_GET[ERROR_ATTR_NAME] element.
     *
     * @param string $title The title of the HTML form document
     * @param string $targetScript The url of the script to receive the form when
     *        submitted
     * @param string $method The HTTP method to be used for the response
     * @param string $errorMessage An optional error message passed from previous
     *        request.
     * @return The HTML code defining the document body
     */
    protected function generateBody($title, $errorMessage)
    {
        $res = "<body>\n";
        if ($errorMessage) {
            $res .= "<p>$errorMessage</p>\n";
        }
        $res .= '<h1>' . $title . "</h1>\n"
             . "<form action='CdAddForm.php' method='post'>\n"
             . "Tittel: <input type='text' name = 'title' size = '32'><br>\n"
             . "Artist: <input type='text' name = 'artist' size = '32'><br>\n"
             . "Produksjonsår: <input type='number' name = 'creationYear' size = '4'><br>\n"
             . "Sjanger: <input type='text' name = 'genre' size = '32'><br>\n"
             . "<input type = 'submit'>\n"
             . "</form>\n";
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
}
?>
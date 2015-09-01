<?php
require_once('Cd.php');

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
        // Set template variables
        $MSG = $errorMessage;
        require('CdAddFormView.tpl');
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
<?php

require_once('CdRowListView.php');

/**
 * This view list the CDs in the sample database in a tabular form.
 *
 * @author  Rune Hjelsvold
 * @version 1.1
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
        // Set template parameters
        $COUNT = count($cdList);
        $CD_TABLE = new CdRowListView($cdList);
        require('CdListView.tpl');
   }
}
?>
<?php

/**
 * Class CdRowListView Used to generate a list of a collection of CDs.
 *
 * @author Rune Hjelsvold
 * @version 1.0
 */
class CdRowListView
{
    private $cdList;

    /**
     * Create a new view for a list of CD's.
     * @param $cdList Array of CD's that will be displayed.
     */
    public function __construct($cdList)
    {
        $this->cdList = $cdList;
    }

    /**
     * Overrides the standard toString method to have the content
     * being printed out when the object is converted to a string.
     */
    public function __toString()
    {
        foreach ($this->cdList as $cd)
        {
            // Set template parameters
            $TITLE = htmlspecialchars($cd->getTitle());
            $ARTIST = htmlspecialchars($cd->getArtist());
            $GENRE = htmlspecialchars($cd->getGenre());
            $CREATION_YEAR = htmlspecialchars($cd->getCreationYear());
            require('CdView.tpl');
        }
        // The toString function should return a string ...
        return '';
    }
}
?>
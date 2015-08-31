<?php
require_once('model/CdModel.php');
require_once('view/CdAddFormView.php');

/**
 * A demo program showing how to create a web form that will enter data
 * into a PDO database.  The application is using the MVC pattern using
 * the CdModel for accessing information about CDs and the CdListView
 * for formatting the display of information. Information is exchanged
 * in the form of Cd objects.
 *
 * The program checks whether POST or GET data is received from the client
 * and behaviour depends on this:
 *
 * 1. No GET or POST data received: a blank HTML form is generated for
 *    the user to complete
 *
 * 2. POST data is received: the user has submitted a form containing data
 *    to be inserted in the database. The response is redirected to the
 *    CdLibrary script if data is successfully added to the database.
 *    Otherwise, an error message is included as GET data to the script 
 *
 * @todo Reinsert user-values in the form upon failed database operation.
 *
 * @uses CdModel
 * @uses CdAddFormView
 * @uses Cd
 *
 * @author  Rune Hjelsvold
 * @version 1.2
 */
$view = new CdAddFormView();
$dbErrMsg = 'Databaseoperasjon feilet - kontakt systemansvarlig.';
$fieldErrMsg = 'Oppdateringen feilet! Husk å fylle ut alle feltene med gyldige verdier.';
if (!empty($_POST['title']) && !empty($_POST['artist'])
    && !empty($_POST['genre']) && is_numeric($_POST['creationYear'])) {
    // The user has completed the form and here comes the entered data
    $cd = $view->createCdFromInput($_POST);
    $model = new CdModel();
    if ($model->addCd($cd) > 0) {
        // Redirect the response to the page displaying the library
        header('Location: CdLibrary.php');
    } else {
        // Database operation failed
        echo $view->writeDocument($dbErrMsg);
    }
} else {
    if (count($_POST) == 0) {
        // The form to be displayed to the user for the first time
        echo $view->writeDocument();
    } else {
        // Some fields were not entered
        echo $view->writeDocument($fieldErrMsg);
    }
}
?>
<?php
require_once('model/CdModel.php');
require_once('view/CdListView.php');
/**
 * A demo program showing how to generate an HTML document from data stored
 * in a PDO/MySQL database. The application is using the MVC
 * patterns using the CdModel for accessing information about CDs and the
 * CdListView for formatting the display of information. Information is
 * exchanged in the form of Cd objects.
 *
 * @author  Rune Hjelsvold
 * @version 1.1
 * @uses CdModel
 * @uses CdListView
 */
$model = new CdModel();
$cdList = $model->getCdList();
$view = new CdListView();

echo $view->generateDocument($cdList);
?>
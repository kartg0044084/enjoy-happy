<?php
require_once('../../connection/database.php');
$sth=$db->query("DELETE FROM attractions WHERE attractionsID=".$_GET['attractionsID']);
 header('Location: list.php');
 ?>

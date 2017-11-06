<?php
require_once('../../connection/database.php');
$sth=$db->query("DELETE FROM room_no WHERE room_noID=".$_GET['room_noID']);
 header('Location: list.php');
 ?>

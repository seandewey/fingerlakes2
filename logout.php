<!DOCTYPE html>
<html>
<?php
session_start();
session_destroy();
header('Location:index.php');
?>
</html>

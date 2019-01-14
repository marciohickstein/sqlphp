<?php

    require_once("classes/sql.php");

    $sql = new Sql();

    $sql->select("SELECT * FROM employee", array());

?>
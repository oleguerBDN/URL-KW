<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//include("conectar.php");
session_start();

//Conecto amb la bbdd
$conn = mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD);

//Selecciono la bbdd 
mysql_select_db(DBSCHEMA, $conn);

?>

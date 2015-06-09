<?php

include '../../includes/general_settings.php';

session_start();

//Agafo las dades que he pasat del index.html al login.js
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

//echo $username;
//echo $password;


//print_r($_REQUEST);
//Conecto amb la bbdd
$conn = mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD);

//Selecciono la bbdd 
mysql_select_db(DBSCHEMA, $conn);

//Busco un usuaris amb las dades que li he passat. 
$ssql = "SELECT * FROM usuarios WHERE correo_electronico='$username' and password='$password'";

//Executo la sentencia
$rs = mysql_query($ssql, $conn);


//Cogemos el nombre del usuario registrado
$nom = mysql_query("SELECT nombre FROM usuarios WHERE correo_electronico='$username'");
$row = mysql_fetch_array($nom);
$nombre = $row['nombre'];



//Comprobem... si ens dona algun resultat es que l'usuari i contrasenya es correcte. 


if (mysql_num_rows($rs) != 0) {
    //Fecha y hora de inicio de sesion 
    $_SESSION["public_user"]['hora_sesion'] = date("H:i  j-n-Y ");

    //Correcte, creo la sesio i envio a index
    $_SESSION['public_user']['username'] = $username;
    $_SESSION['public_user']['nombre'] = $nombre;
    echo("OK");
    return ("OK");
} 

//else {

    //No existeix l'usuari-contrasenya, el deixo al login un altre cop. 
    //echo("Usuario y/o contraseña incorrecto. ");
//}
    
mysql_free_result($rs);
mysql_close($conn);
?> 
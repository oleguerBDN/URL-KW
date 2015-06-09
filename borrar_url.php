<?php

include("../includes/general_settings.php");
include(BASE_PATH . "admin/conectar.php");

////Conecto amb la bbdd
//$conn = mysql_connect(DBSERVER, DBUSERNAME, DBPASSWORD);
//
////Selecciono la bbdd 
//mysql_select_db(DBSCHEMA, $conn);

// Variables del formulario 

 $num = $_GET['num'];

if (isset($num)) {
 $query = "SELECT url FROM url";
 $result = mysql_query($query);
 $numero = 0; 
  
 while ($row = mysql_fetch_array($result)) {
    
    $res = $row["url"];
    
    if ($num==$numero)
    {
        echo "<br>Num: " . $num; 
        echo "<br>Numero: " . $numero; 
        echo "<br>Url: " . $res . "<br>";
        //$insertar = mysql_query("INSERT INTO url (url) values ('funca')", $conn);
        $borrar = mysql_query("DELETE FROM url WHERE url='$res'", $conn);
        header("location:". BASE_URL . "admin/index.php"); 
        //header("location:". BASE_URL . "admin/index.php");
    }
    
    $numero++;
}
}







// Insertar campos en la Base de Datos  


//$insertar = mysql_query ("UPDATE general SET tit1 = '$titulo1', tit2 = '$titulo2', tit3 = '$titulo3', tit4 = '$titulo4', text1 = '$texto1', text2 = '$texto2', text3 = '$texto3', text4 = '$texto4', nombre = '$nombre', email = '$email', telefono = '$telefono' WHERE id=1" , $conn);




if (!$borrar) {
    die("Fallo en la insercion de registro en la Base de Datos: " . mysql_error());
}

// Cerrar conexión a la Base de Datos 

header("location:". BASE_URL . "admin/index.php"); 
?>

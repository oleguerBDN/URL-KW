<?php
include("../includes/general_settings.php");
include("../includes/funciones.php");
include(BASE_PATH . "admin/conectar.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="ACME Dashboard Bootstrap Admin Template.">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="ACME, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->
        <!-- start: CSS -->
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->




    </head>

    <body>

        <?php
        if (!isset($_SESSION['public_user'])) {
            echo "No hay sesion abierta.";
            header("location: " . BASE_URL . "admin/login.php");
        }
        ?>   

        <!-- start: Header -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php BASE_URL . "admin/index.php" ?>"><span>Página de administración | URL-KW</span></a>

                    <!-- start: Header Menu -->
                    <div class="nav-no-collapse header-nav">
                        <ul class="nav pull-right">

                            <!-- start: User Dropdown -->
                            <li class="dropdown">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="halflings-icon white user"></i> <?php echo "  -  " . $_SESSION['public_user']['nombre'] ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo BASE_URL . "admin/login.php" ?>"><i class="halflings-icon white off"></i> Logout</a></li>
                                </ul>
                            </li>
                            <!-- end: User Dropdown -->
                        </ul>
                    </div>
                    <!-- end: Header Menu -->

                </div>
            </div>
        </div>
        <!-- start: Header -->

        <div class="container-fluid">
            <div class="row-fluid">

                <!-- start: Main Menu -->
                <div id="sidebar-left" class="span1">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="index.php"><i class="fa-icon-bar-chart"></i><span class="hidden-tablet"> URL</span></a></li>	
                            <li  class="active"><a href="buscador.php"><i class="fa-icon-hdd"></i><span class="hidden-tablet"> Buscador</span></a></li>

                            <li><a href="login.php"><i class="fa-icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end: Main Menu -->

                <!-- start: Content -->
                <div id="content" class="span11">

                    <div class="row-fluid" >
                        <div class="box span11">

                                <fieldset>
                                    <!-- Form Name -->
                                    <tr>
                                        <legend>Buscador</legend>

                                    <!-- Button -->
                                    <form class="" action="buscador.php" method="post">
                                        <table>
                                            
                                            <div class="controls"> 
                                                <label class="control-label" for="url"><b>URL</b></label>
                                                <input id="url" name="url" type="text" class="input-large" value="" placeholder="Url..."> 
                                                <br>
                                                <label class="control-label" for="keyword"><b>Keyword</b></label>
                                                <input id="url" name="keyword" type="text" class="input-large" value="" placeholder="Keyword..."> 
                                            </div>

                                            <div class="controls">
                                                <button type="submit" id="submit" name="Submit" class="btn btn-default">Buscar</button>
                                            </div>
                                            
                                        </table>
                                    </form>
                                    
                                    <table border='1' cellpadding="4">
                                        <thead>
                                            <tr>
                                                <th>URL</th>
                                                <th>Keyword</th>
                                                <th>Posición</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                   <?php 
                                   //echo "Url  " . $_POST["url"]; 
                                   //echo "<br> Kw  " . $_POST["keyword"]; 
                                                                     
                                   if (isset($_POST["url"]))
                                   {                                   
                                        $url= $_POST["url"];
                                   }
                                   else 
                                   {
                                        $url="";
                                   }
                                   
                                   if (isset($_POST["keyword"]))
                                   {     
                                   $keyword= $_POST["keyword"];
                                   }
                                   else
                                   {
                                        $keyword="";
                                   }
                                   
                                    $query = "SELECT url, keyword, posicion, fecha FROM urlkw WHERE url like '%$url%' AND keyword like '%$keyword%' ORDER BY fecha DESC";
                                    $result = mysql_query($query);
                                    $numero = 0; 
                                    
                                    echo "<br><b> Consulta: </b>" . $query . "<br><br>";
                                    
                                    while($row = mysql_fetch_array($result))
                                    {
                              
                                        echo "<tr><td align='center'><font face=\"verdana\">" . 
                                            $row["url"] . "</font></td>";
                                    echo "<td align='center'><font face=\"verdana\">" . 
                                            $row["keyword"] . "</font></td>";
                                    echo "<td align='center'><font face=\"verdana\">" . 
                                            $row["posicion"] . "</font></td>";
                                    echo "<td align='center'><font face=\"verdana\">" . 
                                            $row["fecha"] . "</font></td></tr>";
                                        
                                    $numero++;
                                    }
                                    ?>
                                    </table>
                                    
                                    
                                </fieldset>


                        </div>
                    </div>



                </div><!--/#content.span10-->
                <!-- end: Content -->

             

            </div><!--/.fluid-container-->

            <!-- start: JavaScript-->

            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="js/jquery-migrate-1.0.0.min.js"></script>

            <script src="js/jquery-ui-1.10.0.custom.min.js"></script>

            <script src="js/jquery.ui.touch-punch.js"></script>

            <script src="js/modernizr.js"></script>

            <script src="js/bootstrap.min.js"></script>

            <script src="js/jquery.cookie.js"></script>

            <script src='js/fullcalendar.min.js'></script>

            <script src='js/jquery.dataTables.min.js'></script>

            <script src="js/excanvas.js"></script>
            <script src="js/jquery.flot.js"></script>
            <script src="js/jquery.flot.pie.js"></script>
            <script src="js/jquery.flot.stack.js"></script>
            <script src="js/jquery.flot.resize.min.js"></script>

            <script src="js/jquery.chosen.min.js"></script>

            <script src="js/jquery.uniform.min.js"></script>

            <script src="js/jquery.cleditor.min.js"></script>

            <script src="js/jquery.noty.js"></script>

            <script src="js/jquery.elfinder.min.js"></script>

            <script src="js/jquery.raty.min.js"></script>

            <script src="js/jquery.iphone.toggle.js"></script>

            <script src="js/jquery.uploadify-3.1.min.js"></script>

            <script src="js/jquery.gritter.min.js"></script>

            <script src="js/jquery.imagesloaded.js"></script>

            <script src="js/jquery.masonry.min.js"></script>

            <script src="js/jquery.knob.modified.js"></script>

            <script src="js/jquery.sparkline.min.js"></script>

            <script src="js/counter.js"></script>

            <script src="js/retina.js"></script>

            <script src="js/custom.js"></script>
            <!-- end: JavaScript-->

    </body>
</html>

<?php
//iniciar a sessao
session_start();
//mostrar todos os erros
ini_set("display_error", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
//incluir  banco e funções
include "config/conexao.php";
include "config/funcoes.php";

$porta = $_SERVER["SERVER_PORT"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>TCC Me Leva</title>
    <meta charset="UTF-8">
    <base href="http://<?=$_SERVER['SERVER_NAME']. ":$porta" . $_SERVER['SCRIPT_NAME']?>">
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
     <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/fonts/flat-icon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
 
      <!-- Javascript -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/jasny-bootstrap.min.js"></script>
 



   
</head>
  <body>
    <?php      

        $pagina = "paginas/home";
        if (isset($_GET["param"])) {
            $pagina = trim($_GET["param"]);
        }
        $p = explode("/", $pagina);
        //posiçao 0 é pasta
        //posição 1 é aquivo
        //posição 2 é id 
        $pasta = $p[0];
        $aquivo = $p[1];

        $pagina = "$pasta/$aquivo.php";
        //pagina .=".php";
        include "main.php";           
    ?>    
   
  </body>
</html>
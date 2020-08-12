<?php
//$RutaAbsoluta = "\Proyecto-ABC\views\index.php"; //https://www.php.net/manual/es/regexp.reference.escape.php
//$RutaRelativa = "../index.php";
//Carga las librerias importadas del composer
require(_DIR_ .'/../../vendor/autoload.php');
//_DIR_ => D:\laragon\www\Proyecto-ABC\views\partials
?>
<?php
$dotenv = Dotenv\Dotenv::create(_DIR_ ."../../../"); //Cargamos el archivo .env de la raiz del sitio
$dotenv->load(); //Carga las variables del archivo .env

$baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".getenv('ROOT_FOLDER');
//https://localhost/Proyecto-ABC/
$adminlteURL = $baseURL."/vendor/almasaeed2010/adminlte";
//https://localhost/Proyecto-ABC/vendor/almasaeed2010/adminlte
?>
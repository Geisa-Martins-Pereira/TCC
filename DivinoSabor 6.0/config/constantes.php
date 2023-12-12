<?php
/*
 * Created by PhpStorm.
 * User: Luciano
 * Date: 19/10/2019
 * Time: 14:31
 */


//-------------configuração banco de dados

// configura o horário brasileiro pro site/xampp/banco
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR');

// inicia as sessions no projeto
session_start();

// define('URLBASEPATH', __DIR__ . '/../');
// define('BASEPATH', __DIR__ . DIRECTORY_SEPARATOR);
// define('BASEPATHFILE', __FILE__);
// define('BASEPATHVIRTUAL', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);
// define('DOMINIO', $_SERVER['SERVER_NAME']);
// define('TITULOSITE', 'NÚCLEO INVESTIGACION INTERNACIONAL EN CIENCIAS MEDICAS');

// configura uma trava caso haja muitas falhas no login (exemplo)
define('TEMPOFALHA', '15');
define('TENTATIVAFALHA', '3');

// define o horário e data atual
define('DATATIMEATUAL', date("Y-m-d H:i:s"));


//----------------------------------------------------------------


$servidorLocal = false;
if ($servidorLocal) {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DBNAME', 'db_divinosabor');
} else {
    define('HOST', '15.235.55.95');
    define('USER', 'asieg');
    define('PASS', '@424344@Love@');
    define('DBNAME', 'asieg_com_br_');
}



<?php
    //Definindo as constantes.
    define('DS', DIRECTORY_SEPARATOR);
    define('BSPH', dirname(dirname(__FILE__)));
    define('URLPH', 'http://localhost/projects/Artifice');
    define('CONTROLLERPH', DS.'controllers');
    define('MODELPH', DS.'model');
    define('VWPH', DS.'view');
    define('LIBPH', DS.'lib');
    define('UTILPH', DS.'util');
    
    //Constantes dentro da view.
    define('CSSPH', DS.'css');
    define('JSPH', DS.'js');
    define('IMGPH', DS.'img');
    define('LAYOUTSPH', DS.'layouts');
    
    //Constantes dentro do layout.
    define('ARTISTAPH', DS.'artista');
    define('COMPANHIAPH', DS.'companhia');
    define('CADASTROPH', DS.'cadastro');
    define('ESTRUTURAPH', DS.'estrutura');
    define('LOGINPH', DS.'login');
    define('USUSPH', DS.'usuario');
    define('PORTFOLIOPH', DS.'portfolio');
    define('EXPH', DS. 'expro');
    define('HOMEPH', DS. 'home');
    define('BUSCAPH', DS. 'busca');
    
    //Constantes do banco.
    define('BDHOST', 'localhost');
    define('BDNAME', 'artifice');
    define('BDUSU', 'root');
    define('BDPASS', 'adminusr');
?>

<?php
session_start();//INICIALIZOU
session_unset();//LIMPOU
session_destroy();//DESTRUIU
header('location: index.php');//REENCAMINHOU
?>
<?php
session_start();//start of hervat de sessie 
session_unset();//verwijderd alle sessie variabelen 
session_destroy();//vernietigd de sessie

header("Location: inloggen.php");//omleiden naar de inlog pagina 
exit();
?>
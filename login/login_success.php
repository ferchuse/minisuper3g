<?php 	if($_SERVER["SERVER_NAME"] == "localhost"){		$url = "location:/minisuper3g/login/index.php?retorno=".$_SERVER['PHP_SELF'];	}	else{		$url = "location:https://minisuper3g.micrositio.mx/login/main_login.php?retorno=".$_SERVER['PHP_SELF'];	}	if (!isset($_COOKIE['id_usuarios'])) {		header($url);	}	?>
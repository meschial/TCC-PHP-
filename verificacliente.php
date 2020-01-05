<?php
	
if ( !isset ( $_SESSION["tcc"]["id"] )) {
	 $msg = "faça o login";
            mensagem( $msg );
}else if("1" <> $_SESSION["tcc"]["tipo"]) {
	$msg = "Vc não é cliente";
            mensagem( $msg );
}
	

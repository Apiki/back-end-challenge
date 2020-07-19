<?php
	
	header('Content-Type: application/json; charset=utf-8');

	require_once 'API/APIKI/Apiki.php';

	if (isset($_REQUEST)) {		echo REST_API_APIKI::abrir($_REQUEST);		}


?>
<?php
//By using helper scripts, the users don't get annoying pop ups asking if
//they want to resend forms or not. This script removes this annoyance when a
//page is turned in the marketplace or suite.
	
	$page = $_POST["page"];
	$where = $_GET["from"];
	
	//return to the interaction page
	header("location: ../webpages/$where.php?page=$page");
?>
<?php
	include_once("../../Util/UtilLogin.php");

	session_start();

	if(!empty($_POST)){
		$dbL = new UtilLogin();

		if($u = $dbL->getUser($_POST["username"], $_POST["password"])){
			$_SESSION["ruolo"] = $u["ruolo"];
			$_SESSION["id"] = $u["id"];
			$dbL->close();
			header("location: index.html");
		}else{
			$dbL->close();
			$a = new Array("result" => "invalidLogin");
		}//if-else
	}//if
?>

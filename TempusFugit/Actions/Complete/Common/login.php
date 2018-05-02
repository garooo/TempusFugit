<?php
	include "../../Util/UtilLogin.php";
	session_start();
	if((isset($_POST['username']))&&(isset($_POST['password']))){
		$uL = new UtilLogin();

		echo $_POST['username'], $_POST['password'];

		$utente = $uL->getUser($_POST['username'], $_POST['password']);

		if($utente){
			$_SESSION['ruolo'] = $utente['ruolo'];
			$_SESSION['id'] = $utentet['idAccount'];
			if($utente['ruolo']=='s'){
			    header("Location: https://giornale.annoiato.net/TempusFugit/TempusFugit/html/studente/");
		        }else if($utente['ruolo']=='p'){    
		            header("Location: https://giornale.annoiato.net/professore.html");
                        }else if($utente['ruolo']=='g'){
		            header("Location: https://giornale.annoiato.net/genitore.html");
                        }else if($utente['ruolo']=='a'){
		            header("Location: https://giornale.annoiato.net/admin.html");
                       }// if-else
                }else{
			header("Location: https://giornale.annoiato.net/TempusFugit/TempusFugit/html/login.php");
		}
		
	}
?>
